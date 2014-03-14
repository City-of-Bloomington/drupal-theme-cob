<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['park_shelters']
 */
echo "
<div class=\"park_shelters teaserView block\">
	<h2>Reservable Park Amenities</h2>
";
	foreach ($data['park_shelters'] as $p) {
		$n = node_view($p, 'teaser');
		echo render($n);
	}
echo "
</div>
";
