<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $news
 */
echo "
<div class=\"block\">
	<h3>Related News</h3>
	<ul>
";
	foreach ($news as $node) {
		$n = node_view($node, 'sidebar');
		echo render($n);
	}
echo "
	</ul>
</div>
";
