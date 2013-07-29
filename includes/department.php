<?php
/**
 * Display a single department
 *
 * Usually for nodes that have a department field.
 * This will display the deprtment information of
 * the current node's department
 *
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param object $data['department']
 */
$title = l($data['department']->title, 'node/'.$data['department']->nid);
echo "
<div class=\"block\">
	<h2>$title</h2>
";
	$contact_info = field_view_field('node', $data['department'], 'field_contact_info', array('label'=>'hidden'));
	echo render($contact_info);

echo "
</div>
";
