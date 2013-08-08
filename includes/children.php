<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['children']
 * @param string $data['title']
 */
if (empty($data['title'])) {
	$c = reset($data['children']);
	$data['title'] = 'Child '.ucfirst($c->type).'s';
}
echo "
<div class=\"block\">
	<h2>$data[title]</h2>
	<ul>
";
	foreach ($data['children'] as $c) {
		echo '<li>'.l($c->title, "node/{$c->nid}").'</li>';
	}
echo "
	</ul>
</div>
";
