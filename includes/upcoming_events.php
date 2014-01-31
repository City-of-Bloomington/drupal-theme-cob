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

";

	foreach ($data['events'] as $row) {
		$date = new DateTime($row->date);
		$s = $date->format('D, F j, Y g:ia');
		print_r($s);
		echo "
		<h4>{$row->title}</h4>
		<div>$row-></div>
		<div>$s</div>
		<div>".l("More Info", "node/{$row->event_node_id}")."</div>
		";
	}
echo "

</div>
";
