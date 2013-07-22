<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $news
 */
echo "
<div class=\"block\">
	<h2>News</h2>
";
	foreach ($news as $node) {
		$n = node_view($node, 'sidebar');
		echo render($n);
	}
echo "
</div>
";
