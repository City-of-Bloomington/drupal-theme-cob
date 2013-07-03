jQuery(document).ready(function($) {
	$(".nav-button").click(function () {
		$(".nav-button,.primary-nav").toggleClass("open");
	});

	$('#menubar .main-nav-item').bind('mouseover', function() {
		$(this).addClass('main-nav-item-active');
	});

	$('#menubar .main-nav-item').bind('mouseleave', function() {
		$(this).removeClass('main-nav-item-active');
	});
});
