<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
if (isset($department)) {
	include $directory.'/includes/department.php';
}
if (isset($siblings)) {
	include $directory.'/includes/siblings.php';
}
if (isset($sponsors)) {
	include $directory.'/includes/sponsors.php';
}
if (isset($location)) {
	include $directory.'/includes/location.php';
}
