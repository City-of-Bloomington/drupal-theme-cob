<?php
/**
 * Displays a list of boards or commissions that point to the current node
 *
 * For instance, boards point to locations.  So, we can
 * use this block when viewing a location.  This will show all the
 * departments that point to the current location.
 *
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['boards']
 */
echo "
<div class=\"block\">
	<h2>Boards</h2>
	<ul>
";
	foreach ($data['boards'] as $b) {
		echo '<li>'.l($b->title, "node/{$b->nid}").'</li>';
	}
echo "
	</ul>
</div>
";
