<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
/**
 * Display a single department
 *
 * Usually for nodes that have a department field.
 * This will display the deprtment information of
 * the current node's department
 */
if (!empty($department)) {
	include $directory.'/includes/department.php';
}
if (!empty($siblings)) {
	include $directory.'/includes/siblings.php';
}
if (!empty($sponsors)) {
	include $directory.'/includes/sponsors.php';
}
if (!empty($location)) {
	include $directory.'/includes/location.php';
}
if (!empty($news)) {
		include $directory.'/includes/news.php';
}
