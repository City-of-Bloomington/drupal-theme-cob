
$(document).ready(function(){
			$(".nav-button").click(function () {
			$(".nav-button,.primary-nav").toggleClass("open");
			});    
		});

$(function() {
    var $mainNav = $('#menuBar'),
	    navWidth = $mainNav.width();
		
	$(document).ready(function(){
		var ua = navigator.userAgent;
		function is_touch_device(){
			try {
				document.createEvent("TouchEvent");
				return true;
			} catch (e) {
				return false;
			}
		}
	
		if (is_touch_device() == false) {
				$mainNav.children('.main-nav-item').hover(function(ev) {
					var $this = $(this),
					$dd = $this.find('.megadropdown-region');
			
				   
					// get the width of the dropdown
					var ddWidth = $dd.width(),
					leftMax = navWidth - ddWidth;
			
					// show the dropdown
					$this.addClass('main-nav-item-active');
				}, function(ev) {
					// hide the dropdown
					$(this).removeClass('main-nav-item-active');
				});
		}
	});

});



 // get the left position of this tab
    //    var leftPos = $this.find('.main-nav-item').position().left;
		// position the dropdown
//        $dd.css('left', Math.min(leftPos, leftMax));