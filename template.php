<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
function cob_preprocess_html(&$vars)
{
	$p = $_SERVER['SERVER_PORT']==443 ? 'https' : 'http';
	drupal_add_css("$p://$_SERVER[SERVER_NAME]/Font-Awesome/css/font-awesome.css", ['type'=>'external']);
}

function cob_preprocess_page(&$vars)
{
	if (arg(0) == 'node') {
		$nid = arg(1);

		if (isset(   $vars['page']['content']['system_main']['nodes'][$nid])) {
			$node = &$vars['page']['content']['system_main']['nodes'][$nid];
			$bundle = &$node['#bundle'];

			if (isset(               $node['field_sponsors']['#items'])) {
				$vars['sponsors'] = &$node['field_sponsors']['#items'];
			}
			if (isset(                 $node['field_department']['#object']->field_department['und'])) {
				$vars['department'] = &$node['field_department']['#object']->field_department['und'][0]['entity'];
			}
			if (isset(            $node['field_board_or_commission']['#object']->field_board_or_commission['und'])) {
				$vars['board'] = &$node['field_board_or_commission']['#object']->field_board_or_commission['und'][0]['entity'];
				if (!empty($vars['board']->field_committee_id['und'][0]['value'])) {
					$vars['board']->field_committee_id['data'] = cob_committee_data($vars['board']->field_committee_id['und'][0]['value']);
				}
			}
			if (isset(               $node['field_division']['#object']->field_division['und'])) {
				$vars['division'] = &$node['field_division']['#object']->field_division['und'][0]['entity'];
			}
			/**
			 * Loads committee information from Committee Manager
			 */
			if (isset($node['field_committee_id']['#items'][0]['value'])) {
				$id = $node['field_committee_id']['#items'][0]['value'];
				$vars['committee_data'] = cob_committee_data($id);
			}

			/**
			 * Pulls the location coordinates from nodes that are referenced to the current node.
			 * This is when nodes point to a location node.
			 * ie. a  Program node that has a location_field that points to a Location node.
			 * When displaying (Program)Pilates we grab the information from (Location)Twin Lakes
			 *
			 * Keep in mind that Location nodes also have a field_location that points to their
			 * parent location.
			 */
			if (isset(                     $node['field_location']['#object'])) {
				$vars['field_location'] = &$node['field_location']['#object']->field_location['und'][0]['entity'];
			}

			if ($bundle == 'program') {
				$vars['siblings'] = cob_node_siblings($node);
				$vars['children'] = cob_node_references($node, $bundle);
			}
			if ($bundle == 'location') {
				/**
				 * Pulls the location coordinates for actual Location nodes
				 * So, when displaying a Location node, we can display the map for that location
				 * ie. When displaying Twin Lakes, we show a map to Twin Lakes.
				 */
				if (isset(               $node['locations']['#locations'][0])) {
					$vars['location'] = &$node['locations']['#locations'][0];
				}
				$vars['siblings'] = cob_node_siblings($node);
			}
			if ($bundle == 'location_group') {
				$vars['children'] = cob_node_references($node, 'location');
			}

			if (   $bundle == 'location'
				|| $bundle == 'department'
				|| $bundle == 'board_or_commission'
				|| $bundle == 'topic'
				|| $bundle == 'sponsor') {
				$vars['programs'] = cob_node_references($node, 'program', true);
			}

			$vars['news']            = cob_node_references($node, 'news'               , false, 'chronological', 10);
			$vars['pages']           = cob_node_references($node, 'page'               );
			$vars['services']        = cob_node_references($node, 'service'            );
			$vars['park_shelters']   = cob_node_references($node, 'park_shelter'       );
			$vars['projects']        = cob_node_references($node, 'project'            );
			$vars['departments']     = cob_node_references($node, 'department'         );
			$vars['webforms']        = cob_node_references($node, 'webform'            );
			$vars['boards']          = cob_node_references($node, 'board_or_commission');
			$vars['location_groups'] = cob_node_references($node, 'location_group'     );
			$vars['divisions']       = cob_node_references($node, 'division'           );

			if ($bundle == 'page' || $bundle == 'service' || $bundle == 'project') {
				$vars['related']['pages']    = cob_nodes_related_by_topics($node, 'page');
				$vars['related']['services'] = cob_nodes_related_by_topics($node, 'service');
				$vars['related']['programs'] = cob_nodes_related_by_topics($node, 'program');
				$vars['related']['projects'] = cob_nodes_related_by_topics($node, 'project');
				$vars['related']['webforms'] = cob_nodes_related_by_topics($node, 'webform');
			}
		}
	}
}

function cob_preprocess_node(&$variables)
{
	$variables['submitted'] = t('@date', ['@date'=>date('m/j/Y', $variables['created'])]);
}

/**
 * Override of theme_breadcrumb().
 */
function cob_breadcrumb($variables) {
	$breadcrumb = $variables['breadcrumb'];

	array_shift($breadcrumb); // Remove the Home link

	if (!empty($breadcrumb)) {
		$output = '<div class="breadcrumb">' . implode('', $breadcrumb) . '</div>';
		return $output;
	}
}

/**
 * Includes a named file allowing data to be passed to the include
 *
 * By passing data to a function that does the include, we prevent
 * variables from getting clobbered in the global scope.
 * Include files can each refer to their own variables without
 * worrying about whether that variable exists in the global scope or not.
 *
 * @param string $name The filename inside of /includes/
 * @param array $data Local variables to be used inside the include
 */
function cob_include($name, array $data=null)
{
	include __DIR__."/includes/$name.php";
}


function cob_renderGeoForLocation(&$l)
{
	$title = '';
	if (isset($l->title)) {
		$title = '<span class="fn">'.l($l->title, "node/{$l->nid}").'</span>';
	}
	$location = isset($l->location) ? $l->location : $l;

	// "Geo" microformat, see http://microformats.org/wiki/geo
	if (isset($location['latitude']) && isset($location['longitude'])) {
		// Assume that 0, 0 is invalid.
		if ($location['latitude'] != 0 || $location['longitude'] != 0) {
			echo "
			<div class=\"geo\">
				$title
				<span class=\"latitude\">$location[latitude]</span>
				<span class=\"longitude\">$location[longitude]</span>
			</div>
			";
		}
	}
}

function cob_webform_element(&$variables)
{
	// Ensure defaults.
	$variables['element'] += ['#title_display' => 'before'];

	$element = $variables['element'];

	// All elements using this for display only are given the "display" type.
	if (isset($element['#format']) && $element['#format'] == 'html') {
		$type = 'display';
	}
	else {
		$type = ($element['#webform_component']['type'] == 'select' && isset($element['#type']))
			? $element['#type']
			: $element['#webform_component']['type'];
	}

	// Convert the parents array into a string, excluding the "submitted" wrapper.
	$nested_level = $element['#parents'][0] == 'submitted' ? 1 : 0;
	$parents = str_replace('_', '-', implode('--', array_slice($element['#parents'], $nested_level)));

	$wrapper_attributes = isset($element['#wrapper_attributes'])
		? $element['#wrapper_attributes']
		: ['class' => []];
	$wrapper_classes = [
		'form-item',
		'webform-component',
		'webform-component-' . str_replace('_', '-', $type),
		'webform-component--' . $parents
	];

	if (isset($element['#title_display']) && strcmp($element['#title_display'], 'inline') === 0) {
		$wrapper_classes[] = 'webform-container-inline';
	}
	$wrapper_attributes['class'] = array_merge($wrapper_classes, $wrapper_attributes['class']);
	$output = '<div ' . drupal_attributes($wrapper_attributes) . '>' . "\n";

	// If #title_display is none, set it to invisible instead - none only used if
	// we have no title at all to use.
	if ($element['#title_display'] == 'none') {
		$variables['element']['#title_display'] = 'invisible';
		$element['#title_display'] = 'invisible';
		if (empty($element['#attributes']['title']) && !empty($element['#title'])) {
			$element['#attributes']['title'] = $element['#title'];
		}
	}
	// If #title is not set, we don't display any label or required marker.
	if (!isset($element['#title'])) {
		$element['#title_display'] = 'none';
	}
	$prefix = isset($element['#field_prefix']) ? '<span class="field-prefix">' . webform_filter_xss($element['#field_prefix']) . '</span> ' : '';
	$suffix = isset($element['#field_suffix']) ? '<span class="field-suffix">' . webform_filter_xss($element['#field_suffix']) . '</span>'  : '';

	// We want to render the description before the element, not after
	$description = (!empty($element['#description']))
		? '<div class="description">' . $element['#description'] . "</div>\n"
		: '';

	switch ($element['#title_display']) {
	case 'inline':
	case 'before':
	case 'invisible':
		$output .= theme('form_element_label', $variables);
		$output .= $description;
		$output .= $prefix . $element['#children'] . $suffix . "\n";
		break;

	case 'after':
		$output .= $description;
		$output .= $prefix . $element['#children'] . $suffix;
		$output .= theme('form_element_label', $variables) . "\n";
		break;

	case 'none':
	case 'attribute':
		// Output no label and no required marker, only the children.
		$output .= $description;
		$output .= $prefix . $element['#children'] . $suffix . "\n";
		break;
	}

	$output .= "</div>\n";

	return $output;
}
