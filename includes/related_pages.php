<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $pages
 */
echo "
<div class=\"block\">
	<h3>Related Resources</h3>
	<ul>
";
	foreach ($pages as $r) {
		echo '<li>'.l($r->title, "node/{$r->nid}").'</li>';
	}
echo "
	</ul>
</div>
";
