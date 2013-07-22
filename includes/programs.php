<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $programs
 */
echo "
<div class=\"programsTeaser block\">
	<h2>Programs</h2>
";
	foreach ($programs as $p) {
		$n = node_view($p, 'teaser');
		echo render($n);
	}
echo "
</div>
";
