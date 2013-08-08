<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param object $data['coordinates']
 */
echo "
<div class=\"block\">
";
	// "Geo" microformat, see http://microformats.org/wiki/geo
	if (isset($data['coordinates']['latitude']) && isset($data['coordinates']['longitude'])) {
		// Assume that 0, 0 is invalid.
		if ($data['coordinates']['latitude'] != 0 || $data['coordinates']['longitude'] != 0) {
			echo gmap_simple_map($data['coordinates']['latitude'], $data['coordinates']['longitude'], '', '', '14');
		}
	}
echo "
</div>
";
