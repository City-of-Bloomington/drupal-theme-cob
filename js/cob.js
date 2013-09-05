jQuery(document).ready(function($) {
	$(".nav-button").click(function () {
		$(".nav-button,.primary-nav").toggleClass("open");
	});

	$('.megadropdown .main-nav-item').bind('mouseover', function() {
		$(this).addClass('main-nav-item-active');
	});

	$('.megadropdown .main-nav-item').bind('mouseleave', function() {
		$(this).removeClass('main-nav-item-active');
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
