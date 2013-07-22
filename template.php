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

			if (isset(               $vars['node']['field_sponsors']['#items'])) {
				$vars['sponsors'] = &$vars['node']['field_sponsors']['#items'];
			}
			if (isset(                 $vars['node']['field_department']['#object']->field_department['und'])) {
				$vars['department'] = &$vars['node']['field_department']['#object']->field_department['und'][0]['entity'];
			}

			if (isset($vars['node']['field_location']['#object'])) {
				$vars['location'] = &$vars['node']['field_location']['#object']->field_location['und'][0]['entity'];
			}

			if (   $vars['node']['#bundle'] == 'program'
				|| $vars['node']['#bundle'] == 'location') {
				$vars['siblings'] = cob_node_siblings($vars['node']);
			}

			if (   $vars['node']['#bundle'] == 'location'
				|| $vars['node']['#bundle'] == 'department'
				|| $vars['node']['#bundle'] == 'board_or_commission') {
				$vars['programs'] = cob_node_references($vars['node'], 'program', true);
			}

			$vars['news'] = cob_node_references($vars['node'], 'news');

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
