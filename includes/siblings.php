<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $siblings
 */
echo "
<div class=\"block\">
	<h2>Related Programs</h2>
	<ul>
";
	foreach ($siblings as $s) {
		echo l($s->title, "node/{$s->nid}");
	}
echo "
	</ul>
</div>
";
