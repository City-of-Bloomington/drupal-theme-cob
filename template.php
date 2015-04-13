<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
function cob_preprocess_html(&$vars)
{
	#$p = $_SERVER['SERVER_PORT']==443 ? 'https' : 'http';
	#drupal_add_css("$p://$_SERVER[SERVER_NAME]/Font-Awesome/css/font-awesome.css", ['type'=>'external']);
}

function cob_preprocess_page(&$vars)
{
	if (arg(0) == 'node') {
		$nid = arg(1);

		if (isset(   $vars['page']['content']['system_main']['nodes'][$nid])) {
			$node = &$vars['page']['content']['system_main']['nodes'][$nid];
			$bundle = &$node['#bundle'];

			if ($bundle == 'book' && empty($node['field_category'])) {
                $vars['bookInfo'] = cob_book_info($node['#node']->book);
			}

		}

	}
	elseif (arg(0) == 'taxonomy') {
        $t = &$vars['page']['content']['system_main']['term_heading']['term']['#term'];
        $parents = taxonomy_get_parents($t->tid);
        if (count($parents)) {
            $t = (array)$t;
            $t['parent'] = current($parents);
            $t = (object)$t;
        }
    }
}

function cob_preprocess_node(&$vars)
{
    $vars['press_releases']     = cob_node_references($vars, 'press_release',    false, 'chronological', 2);
	$vars['boards_commissions'] = cob_node_references($vars, 'board_commission', false, 'alphabetical');

	if (!empty($vars['field_directory_dn'][0]['value'])) {
        $vars['contactInfo'] = cob_department_info($vars['field_directory_dn'][0]['value']);
	}

	if (!empty($vars['field_committee'][0]['value'])) {
        $vars['committee'] = civiclegislation_committee_info($vars['field_committee'][0]['value']);
        $vars['contactInfo'] = (object)[
            'name'    => $vars['committee']->info->name,
            'email'   => $vars['committee']->info->email,
            'office'  => $vars['committee']->info->phone,
            'address' => $vars['committee']->info->address,
            'city'    => $vars['committee']->info->city,
            'state'   => $vars['committee']->info->state,
            'zip'     => $vars['committee']->info->zip
        ];
	}
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


function cob_form_alter(&$form, &$form_state, $form_id) {
	if ($form_id == 'search_block_form') {
		// HTML5 placeholder attribute
		$form['search_block_form']['#attributes']['placeholder'] = t('Search Bloomington.in.gov');
		$form['actions']['#attributes']['class'][] = 'element-invisible';
	}
}
