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
$items = '';
if ($view_mode == 'full') {
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
	$children = taxonomy_get_children($term->tid, $vid);
	if (count($children)) {
		$items .= "
		<div class=\"sidebar-item\">
			<h2>$term_name</h2>
			<ul>
		";
			foreach ($children as $t) {
				$sidebar_second .= "<li>".l($t->name, "taxonomy/term/{$t->tid}")."</li>";
			}
		$items .= "
			</ul>
		</div>
		";
	}
}

if ($items) {
	$sidebar_second = "
		<div id=\"sidebar-second\" class=\"sidebar\">
			$items
		</div>
	";
}
