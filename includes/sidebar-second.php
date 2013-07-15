<?php
/**
 * Code to populate the sidebar-second div from inside a node or term
 *
 * The node or term template will have created a $sidebar_second variable.
 * This code should write all the necessary HTML into that variable to
 * create the sidebar-second div.
 *
 * Variables from the Drupal environment are available depending on
 * whether this is being included from a node or taxonomy term template.
 *
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
/*
$parents = taxonomy_get_parents($term->tid);
if ($parents) {
	foreach ($parents as $parent) {
		taxonomy_term_build_content($parent);
		echo render($parent->content);
	}
}
*/

/*
$locations = location_load_locations("taxonomy:{$term->tid}", 'genid');
if ($locations) {
	$l = $locations[0];
	if (isset($l['latitude']) && isset($l['longitude'])
		&& ($l['latitude']!=0 || $l['longitude']!=0)) {
		echo gmap_simple_map($l['latitude'], $l['longitude'], '', '', '14');
	}
}
*/
if (isset($node) && $node['#view_mode'] == 'full') {
	if (isset($node['field_sidebar_image'])) {
		echo render($node['field_sidebar_image']);
	}

	if (   isset($node['field_running_from'])
		|| isset($node['field_cost'])
		|| isset($node['field_ages'])
		|| isset($node['field_registration'])
		|| isset($node['field_instructor'])) {

		echo '<div class="sidebar-item">';
		if (isset($node['field_running_from'])) { echo render($node['field_running_from']); }
		if (isset($node['field_cost']))         { echo render($node['field_cost']); }
		if (isset($node['field_ages']))         { echo render($node['field_ages']); }
		if (isset($node['field_registration'])) { echo render($node['field_registration']); }
		if (isset($node['field_instructor']))   { echo render($node['field_instructor']); }
		echo '</div>';
	}

	if (isset($node['field_contact_info'])) {
		echo '<div class="sidebar-item">';
		echo render($node['field_contact_info']);
		echo '</div>';
	}
}
