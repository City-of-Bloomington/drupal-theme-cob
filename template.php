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
