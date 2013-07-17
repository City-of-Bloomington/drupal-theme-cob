<?php
if (!empty($locations)) {
	echo "<div class=\"location-locations-wrapper\">";
	foreach ($locations as $location) {
		echo $location;
	}
	echo "</div>";
}
