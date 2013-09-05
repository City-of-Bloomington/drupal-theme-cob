<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param object $data['location']
 */
$title = l($data['location']->title, 'node/'.$data['location']->nid);
echo "
<div class=\"block\">
	<h2>$title</h2>
";
	cob_include('map', ['location'=> &$data['location']->location]);

	$contact_info = field_view_field('node', $data['location'], 'field_contact_info', array('label'=>'hidden'));
	echo render($contact_info);
echo "
</div>
";
