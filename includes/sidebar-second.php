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
if (isset($term) && $term['#view_mode'] == 'full') {
	$children = taxonomy_get_children($term['#term']->tid, $term['#term']->vid);
	if (count($children)) {
		echo "
		<div class=\"sidebar-item\">
			<h2>{$term['#term']->name}</h2>
			<ul>
		";
			foreach ($children as $t) {
				echo "<li>".l($t->name, "taxonomy/term/{$t->tid}")."</li>";
			}
		echo "
			</ul>
		</div>
		";

	}
	
	if (isset($term['field_contact_info'])) {
		echo '<div class="sidebar-item">';
		echo render($term['field_contact_info']);
		echo '</div>';
	}
	
	if (isset($term['field_sidebar_image'])) {
		echo '<div class="sidebar-item">';
		echo render($term['field_sidebar_image']);
		echo '</div>';
	}

	if (   isset($term['field_running_from'])
		|| isset($term['field_cost'])
		|| isset($term['field_ages'])
		|| isset($term['field_instructor'])
		|| isset($term['field_registration'])) {

		echo '<div class="sidebar-item">';
		if (isset($term['field_running_from'])) { echo render($term['field_running_from']); }
		if (isset($term['field_cost']))         { echo render($term['field_cost']); }
		if (isset($term['field_ages']))         { echo render($term['field_ages']); }
		if (isset($term['field_instructor']))	{ echo render($term['field_instructor']); }
		if (isset($term['field_registration'])) { echo render($term['field_registration']); }
		echo '</div>';
	}

	
}
