<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['location_groups']
 */
echo "
<div class=\"block\">
	<h2>Locations</h2>
	<ul>
";
	foreach ($data['location_groups'] as $g) {
		echo '<li>'.l($g->title, "node/{$g->nid}").'</li>';
	}
echo "
	</ul>
</div>
";
