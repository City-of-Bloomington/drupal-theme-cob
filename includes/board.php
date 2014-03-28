<?php
/**
 * Display a single board or commission
 *
 * Usually for nodes that have a board or commission field.
 * This will display the board information of
 * the current node's board
 *
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param object $data['board_or_commission']
 */
$title = l($data['board']->title, 'node/'.$data['board']->nid);
echo "
<div class=\"block\">
	<h2>$title</h2>
";


	
echo "
</div>
";
