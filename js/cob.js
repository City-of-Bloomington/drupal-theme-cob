"use strict";
jQuery(document).ready(function($) {
	var menuItems = $('.megadropdown .main-nav-tab'),
		active    = 'main-nav-item-active';

	menuItems.bind('click', function() {
		var li   = $(this).parent(),
			show = true;

		if (li.hasClass(active)) { show = false; }
		// Hide all the menu items
		menuItems.each(function () { $(this).parent().removeClass(active); });
		// Open the current clicked item
		if (show) { li.addClass(active); }
		// Make the a href do nothing
		return false;
	});

	// Close the menus when you click outside
	$(document).bind('click', function () {
		menuItems.each(function () { $(this).parent().removeClass(active); });
	});



	$('.hcards').each(function () {
		var locations = $(this).find('.geo'),
			div = $('<div class="map" />'),
			map    = {},
			bounds = {},
			infoWindow = {};
		if (locations.length) {
			$(this).append(div);
			map = new google.maps.Map($(this).find('.map')[0], {
				zoom:15,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			bounds     = new google.maps.LatLngBounds(),
			infoWindow = new google.maps.InfoWindow();

			locations.each(function (i,v) {
				var p = new google.maps.LatLng(
						parseFloat($(this).find('.latitude').html()),
						parseFloat($(this).find('.longitude').html())
					),
					fn = $(this).find('.fn')[0],
					markers = [];
				markers[i] = new google.maps.Marker({position:p, map:map });
				if (fn) {
					google.maps.event.addListener(markers[i], 'click', function() {
						infoWindow.setContent(fn.innerHTML);
						infoWindow.open(map, markers[i]);
					});
				}
				bounds.extend(p);
			});
			google.maps.event.addListenerOnce(map, 'bounds_changed', function() {
				if (map.getZoom() > 15) {
					map.setZoom(15);
				}
			});
			map.fitBounds(bounds);
		}
	});
});
