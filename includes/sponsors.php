<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $sponsors
 */
echo "
<div class=\"block sponsors teaserView\">
	<h2>Sponsors</h2>
";
	foreach ($sponsors as $s) {
		$n = entity_view('node', [$s['entity']], 'sidebar');
		echo render($n);
	}
echo "
</div>
";
