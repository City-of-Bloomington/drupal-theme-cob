<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
function cob_preprocess_page(&$vars)
{
	if (isset(           $vars['page']['content']['system_main']['term_heading']['term'])) {
		$vars['term'] = &$vars['page']['content']['system_main']['term_heading']['term'];

		if (isset(               $vars['term']['field_sponsors']['#items'])) {
			$vars['sponsors'] = &$vars['term']['field_sponsors']['#items'];
		}
	}
	/*
	if (!empty($vars['page']['content']['system_main']['term_heading']['term']['field_location_term'])) {
		$tid = $vars['page']['content']['system_main']['term_heading']['term']['field_location_term']['#items'][0]['tid'];
		$locations = location_load_locations("taxonomy:$tid", 'genid');
		if ($locations) {
			$vars['location'] = $locations[0];
		}
	}
	*/
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
