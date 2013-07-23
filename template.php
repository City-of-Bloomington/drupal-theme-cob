<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
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

			if (isset($vars['node']['field_location']['#object'])) {
				$vars['location'] = &$vars['node']['field_location']['#object']->field_location['und'][0]['entity'];
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
	$variables['submitted'] = t('!date', array('!date'=>$variables['date']));
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
