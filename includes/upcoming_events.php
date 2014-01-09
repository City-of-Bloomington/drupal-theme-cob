<?php
/**
 * Renders results from the COB module function: cob_upcoming_events
 *
 * @copyright 2014 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['events']
 *
 * Each row in the data is a db_result object.
 * $row->event_node_id
 *     ->date
 *     ->title
 *     ->program_node_id
 */
echo "
<div class=\"block\">
	<h2>Upcoming Events</h2>
	<ul>
";
	foreach ($data['events'] as $row) {
		echo '<li>'.l("{$row->title} {$row->date}", "node/{$row->event_node_id}").'</li>';
	}
echo "
	</ul>
</div>
";
