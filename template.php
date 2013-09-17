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
			$vars['departments']     = cob_node_references($vars['node'], 'department'         );
			$vars['webforms']        = cob_node_references($vars['node'], 'webform'            );
			$vars['boards']          = cob_node_references($vars['node'], 'board_or_commission');
			$vars['location_groups'] = cob_node_references($vars['node'], 'location_group'     );

			switch ($bundle) {
				case 'page':
					$vars['related']['pages']    = cob_nodes_related_by_topics($vars['node'], 'page');
					$vars['related']['services'] = cob_nodes_related_by_topics($vars['node'], 'service');
					$vars['related']['programs'] = cob_nodes_related_by_topics($vars['node'], 'program');
					$vars['related']['webforms'] = cob_nodes_related_by_topics($vars['node'], 'webform');

				break;

				case 'service':
					$vars['related']['pages']    = cob_nodes_related_by_topics($vars['node'], 'page');
					$vars['related']['services'] = cob_nodes_related_by_topics($vars['node'], 'service');
					$vars['related']['programs'] = cob_nodes_related_by_topics($vars['node'], 'program');
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
