<?php
/**
 * @copyright 2014 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param JSON $data[committee] The JSON response from committee manager
 */
if (count($data['committee']->seats)) {
	echo "
	<h3>Members</h3>
	<table>
		<thead>
			<tr><th>Appointee</th>
				<th>Appointed By</th>
				<th>Term End Date</th>
			</tr>
		</thead>
		<tbody>
	";
	foreach ($data['committee']->seats as $seat) {
		$c = 0;
		foreach ($seat->currentMembers as $member) {
			$c++;
			echo "
			<tr><td>{$member->name}</td>
				<td>{$seat->appointedBy}</td>
				<td>{$member->termEnd}</td>
			</tr>
			";
		}
		while ($c < $seat->maxCurrentTerms) {
			echo "
			<tr><td>Vacancy</td>
				<td>{$seat->appointedBy}</td>
				<td></td>
			</tr>
			";
			$c++;
		}

	}
	echo "
		</tbody>
	</table>
	";
}
