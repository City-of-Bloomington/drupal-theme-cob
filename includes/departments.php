<?php
/**
 * Displays a list of departments that point to the current node
 *
 * For instance, departments point to locations.  So, we can
 * use this block when viewing a location.  This will show all the
 * departments that point to the current location.
 *
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $departments
 */
echo "
<div class=\"block\">
	<h2>Departments</h2>
	<ul>
";
	foreach ($departments as $d) {
		echo '<li>'.l($d->title, "node/{$d->nid}").'</li>';
	}
echo "
	</ul>
</div>
";
