<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['webforms']
 */
echo "
<div class=\"block\">
	<h2>Forms</h2>
	<ul>
";
	foreach ($data['webforms'] as $w) {
		echo '<li>'.l($w->title, "node/{$w->nid}").'</li>';
	}
echo "
</ul>
</div>
";
