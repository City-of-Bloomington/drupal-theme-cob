<?php
/**
 * @copyright 2014 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param JSON $data[committee] The JSON response from committee manager
 */
if (!empty($data['committee']->info->meetingSchedule)) {
	echo "
	<div class=\"block\">
		<h2>Meetings</h2>
		<p>{$data['committee']->info->meetingSchedule}</p>
	</div>
	";
}

if (!empty($data['committee']->info->contactInfo)) {
	echo "
	<div class=\"block\">
		<h2>Contact Information</h2>
		<p>{$data['committee']->info->contactInfo}</p>
	</div>
	";
}
