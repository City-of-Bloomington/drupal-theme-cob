<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param object $location
 */
$title = l($location->title, 'node/'.$location->nid);
echo "
<div class=\"block\">
	<h2>$title</h2>
";
	$contact_info = field_view_field('node', $location, 'field_contact_info', array('label'=>'hidden'));
	echo render($contact_info);

	// "Geo" microformat, see http://microformats.org/wiki/geo
	if (isset($location->location['latitude']) && isset($location->location['longitude'])) {
		// Assume that 0, 0 is invalid.
		if ($location->location['latitude'] != 0 || $location->location['longitude'] != 0) {
			echo gmap_simple_map($location->location['latitude'], $location->location['longitude'], '', '', '14');
		}
	}
echo "
</div>
";
