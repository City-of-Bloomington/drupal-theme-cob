<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param object $data['location'] The main location for the map
 * @param arary $data['locations'] Any additional locations to display
 */
echo "
<div class=\"hcards\">
";
	if (isset($data['location'])) {
		cob_renderGeoForLocation($data['location']);
	}
	if (isset($data['locations'])) {
		foreach ($data['locations'] as $l) {
			cob_renderGeoForLocation($l);
		}
	}
echo "
</div>
";
drupal_add_js('https://maps.googleapis.com/maps/api/js?sensor=false','external');
