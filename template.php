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

		if (isset(           $vars['page']['content']['system_main']['nodes'][$nid])) {
			$vars['node'] = &$vars['page']['content']['system_main']['nodes'][$nid];
			$bundle = &$vars['node']['#bundle'];

			if (isset(               $vars['node']['field_sponsors']['#items'])) {
				$vars['sponsors'] = &$vars['node']['field_sponsors']['#items'];
			}
			if (isset(                 $vars['node']['field_department']['#object']->field_department['und'])) {
				$vars['department'] = &$vars['node']['field_department']['#object']->field_department['und'][0]['entity'];
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
			if (isset(                     $vars['node']['field_location']['#object'])) {
				$vars['field_location'] = &$vars['node']['field_location']['#object']->field_location['und'][0]['entity'];
			}


			if ($bundle == 'program') {
				$vars['siblings'] = cob_node_siblings($vars['node']);
				$vars['children'] = cob_node_references($vars['node'], $bundle);
			}
			if ($bundle == 'location') {
				/**
				 * Pulls the location coordinates for actual Location nodes
				 * So, when displaying a Location node, we can display the map for that location
				 * ie. When displaying Twin Lakes, we show a map to Twin Lakes.
				 */
				if (isset(               $vars['node']['locations']['#locations'][0])) {
					$vars['location'] = &$vars['node']['locations']['#locations'][0];
				}
				$vars['siblings'] = cob_node_siblings($vars['node']);
			}
			if ($bundle == 'location_group') {
				$vars['children'] = cob_node_references($vars['node'], 'location');
			}

			if (   $bundle == 'location'
				|| $bundle == 'department'
				|| $bundle == 'board_or_commission'
				|| $bundle == 'topic'
				|| $bundle == 'sponsor') {
				$vars['programs'] = cob_node_references($vars['node'], 'program', true);
			}

			$vars['news']            = cob_node_references($vars['node'], 'news'               , false, 'chronological', 10);
			$vars['pages']           = cob_node_references($vars['node'], 'page'               );
			$vars['services']        = cob_node_references($vars['node'], 'service'            );
			$vars['projects']        = cob_node_references($vars['node'], 'project'            );
			$vars['departments']     = cob_node_references($vars['node'], 'department'         );
			$vars['webforms']        = cob_node_references($vars['node'], 'webform'            );
			$vars['boards']          = cob_node_references($vars['node'], 'board_or_commission');
			$vars['location_groups'] = cob_node_references($vars['node'], 'location_group'     );

			switch ($bundle) {
				case 'page':
					$vars['related']['pages']    = cob_nodes_related_by_topics($vars['node'], 'page');
					$vars['related']['services'] = cob_nodes_related_by_topics($vars['node'], 'service');
					$vars['related']['programs'] = cob_nodes_related_by_topics($vars['node'], 'program');
					$vars['related']['projects'] = cob_nodes_related_by_topics($vars['node'], 'project');
					$vars['related']['webforms'] = cob_nodes_related_by_topics($vars['node'], 'webform');

				break;

				case 'service':
					$vars['related']['pages']    = cob_nodes_related_by_topics($vars['node'], 'page');
					$vars['related']['services'] = cob_nodes_related_by_topics($vars['node'], 'service');
					$vars['related']['programs'] = cob_nodes_related_by_topics($vars['node'], 'program');
					$vars['related']['projects'] = cob_nodes_related_by_topics($vars['node'], 'project');
					$vars['related']['webforms'] = cob_nodes_related_by_topics($vars['node'], 'webform');
				break;

			case 'project':
					$vars['related']['pages']    = cob_nodes_related_by_topics($vars['node'], 'page');
					$vars['related']['services'] = cob_nodes_related_by_topics($vars['node'], 'service');
					$vars['related']['programs'] = cob_nodes_related_by_topics($vars['node'], 'program');
					$vars['related']['projects'] = cob_nodes_related_by_topics($vars['node'], 'project');
					$vars['related']['webforms'] = cob_nodes_related_by_topics($vars['node'], 'webform');
				break;
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
