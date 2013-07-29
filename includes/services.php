<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['services']
 */
echo "
<div class=\"block\">
	<h2>Services</h2>
	<ul>
";
	foreach ($data['services'] as $s) {
		echo '<li>'.l($s->title, "node/{$s->nid}").'</li>';
	}
echo "
	</ul>
</div>
";
