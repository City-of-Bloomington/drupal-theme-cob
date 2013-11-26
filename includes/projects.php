<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['projects']
 */
echo "
<div class=\"projects teaserView block\">
	<h2>Projects</h2>
";
	foreach ($data['projects'] as $p) {
		$n = node_view($p, 'teaser');
		echo render($n);
	}
echo "
</div>
";
