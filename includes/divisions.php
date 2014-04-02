<?php
/**
 * Displays a list of divisions that point to the current node
 *
 * For instance, divisions point to locations.  So, we can
 * use this block when viewing a location.  This will show all the
 * divisions that point to the current location.
 *
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['divisions']
 */
echo "
<div class=\"block\">
	<h2>City Divisions</h2>
	<ul>
";
	foreach ($data['divisions'] as $d) {
		echo '<li>'.l($d->title, "node/{$d->nid}").'</li>';
	}
echo "
	</ul>
</div>
";
