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
			 * This is when content types other than locations point to a location node.
			 * ie. a  Program node that has a location_field that points to a Location node.
			 * When displaying (Program)Pilates we grab the information from (Location)Twin Lakes
			 */
			if (isset(               $vars['node']['field_location']['#object'])) {
				$vars['location'] = &$vars['node']['field_location']['#object']->field_location['und'][0]['entity'];
			}

			/**
			 * Pulls the location coordinates for actual Location nodes
			 * So, when displaying a Location node, we can display the map for that location
			 * ie. When displaying Twin Lakes, we show a map to Twin Lakes.
			 */
			if (isset(                  $vars['node']['locations']['#locations'][0])) {
				$vars['coordinates'] = &$vars['node']['locations']['#locations'][0];
			}

			if ($bundle == 'program' || $bundle == 'location') {
				$vars['siblings'] = cob_node_siblings($vars['node']);
			}

			if (   $bundle == 'location'
				|| $bundle == 'department'
				|| $bundle == 'board_or_commission') {
				$vars['programs'] = cob_node_references($vars['node'], 'program', true);
			}

			$vars['news']        = cob_node_references($vars['node'], 'news');
			$vars['pages']       = cob_node_references($vars['node'], 'page');
			$vars['services']    = cob_node_references($vars['node'], 'service');
			$vars['departments'] = cob_node_references($vars['node'], 'department');

			switch ($bundle) {
				case 'page':
					$vars['related']['pages']    = cob_nodes_related_by_topics($vars['node'], 'page');
					$vars['related']['services'] = cob_nodes_related_by_topics($vars['node'], 'service');
					$vars['related']['programs'] = cob_nodes_related_by_topics($vars['node'], 'program');
					$vars['related']['news']     = cob_nodes_related_by_topics($vars['node'], 'news');
				break;

				case 'service':
					$vars['related']['services'] = cob_nodes_related_by_topics($vars['node'], 'service');
					$vars['related']['programs'] = cob_nodes_related_by_topics($vars['node'], 'program');
				break;

				case 'news':
					$vars['related']['pages']    = cob_nodes_related_by_topics($vars['node'], 'page');
					$vars['related']['news']     = cob_nodes_related_by_topics($vars['node'], 'news');
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
