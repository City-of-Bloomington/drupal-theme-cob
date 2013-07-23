<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $pages
 */
echo "
<div class=\"block\">
	<h3>Resources</h3>
	<ul>
";
	foreach ($pages as $p) {
		echo '<li>'.l($p->title, "node/{$p->nid}").'</li>';
	}
echo "
	</ul>
</div>
";
