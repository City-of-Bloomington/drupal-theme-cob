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
});
