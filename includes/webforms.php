<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['webforms']
 */
echo "
<div class=\"block\">
	<h3>Forms</h3>
";
	foreach ($data['webforms'] as $node) {
		$n = node_view($node, 'teaser');
		echo render($n);
	}
echo "
</div>
";
