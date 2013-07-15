<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param object $department
 */
echo "
<div class=\"block\">
	<h2>{$department->title}</h2>
";
	$contact_info = field_view_field('node', $department, 'field_contact_info', array('label'=>'hidden'));
	echo render($contact_info);

echo "
</div>
";
