<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param object $data['location']
 */
$title = l($data['location']->title, 'node/'.$data['location']->nid);
echo "
<div class=\"block\">
	<h2>$title</h2>
";
	// "Geo" microformat, see http://microformats.org/wiki/geo
	if (isset($data['location']->location['latitude']) && isset($data['location']->location['longitude'])) {
		// Assume that 0, 0 is invalid.
		if ($data['location']->location['latitude'] != 0 || $data['location']->location['longitude'] != 0) {
			echo gmap_simple_map($data['location']->location['latitude'], $data['location']->location['longitude'], '', '', '14');
		}
	}
	
	$contact_info = field_view_field('node', $data['location'], 'field_contact_info', array('label'=>'hidden'));
	echo render($contact_info);
echo "
</div>
";
