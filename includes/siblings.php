<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['siblings']
 */
$title = '';
$list  = '';
$c = 0;
foreach ($data['siblings'] as $s) {
	$list.= '<li>'.l($s->title, "node/{$s->nid}").'</li>';

	if ($c == 0) { $title = ucfirst($s->type).'s'; }
	$c++;
}
echo "
<div class=\"block\">
	<h2>Related $title</h2>
	<ul>
		$list
	</ul>
</div>
";
