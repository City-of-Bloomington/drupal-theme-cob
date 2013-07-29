<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['pages']
 */
echo "
<div class=\"block\">
	<h2>Resources</h2>
	<ul>
";
	foreach ($data['pages'] as $p) {
		echo '<li>'.l($p->title, "node/{$p->nid}").'</li>';
	}
echo "
	</ul>
</div>
";
