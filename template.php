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

			if ($vars['node']['#bundle'] == 'program'
				&& isset( $vars['node']['field_program']['#items'][0]['target_id'])) {
				$pid   = &$vars['node']['field_program']['#items'][0]['target_id'];
				$query = new EntityFieldQuery();
				$type  = 'node';

				$query->entityCondition('entity_type', $type)
					  ->entityCondition('bundle', 'program')
					  ->propertyCondition('status', 1)
					  ->propertyCondition('nid', $nid, '<>')
					  ->fieldCondition('field_program', 'target_id', $pid);
				$results = $query->execute();
				if (!empty($results[$type])) {
					$vars['siblings'] = node_load_multiple(array_keys($results[$type]));
				}
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
