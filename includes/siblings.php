<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['siblings']
 */
$title = ucfirst($node['#bundle'])."s";
echo "
<div class=\"block\">
	<h2>Related $title</h2>
	<ul>
";
	foreach ($data['siblings'] as $s) {
		echo l($s->title, "node/{$s->nid}");
	}
echo "
	</ul>
</div>
";
