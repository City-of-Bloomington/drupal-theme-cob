(function() {
	"use strict";
	var closeMenus = function() {
		var openLaunchers = document.querySelectorAll('.dropdown [aria-expanded="true"]'),
			openMenus = document.querySelectorAll('.dropdown [aria-expanded="true"] + .links'),
			len = openLaunchers.length;
		for (i = 0; i < len; i++) {
			openLaunchers[i].setAttribute("aria-expanded", "");
			openLaunchers[i].parentElement.focus();
			openLaunchers[i].setAttribute("aria-expanded", "false");
			hideMenu(openMenus[i]);
		}
		document.removeEventListener('click', closeMenus);
	},

	hideMenu = function(m) {
		m.setAttribute('hidden', 'hidden');
	},

	launcherClick = function(e) {
		var launcher = e.target,
			container = launcher.parentElement,
			menu = launcher.parentElement.querySelector('.dropdown .links');
		launcher.blur();
		closeMenus();
		menu.removeAttribute("hidden");
		launcher.setAttribute('aria-expanded', 'true');
		document.addEventListener('click', closeMenus);
		e.stopPropagation();
		e.preventDefault();
		menu.focus();
	},

	launchers = document.querySelectorAll('.dropdown .launcher'),
	len = launchers.length,
	i = 0;
	for (i = 0; i < len; i++) {
		launchers[i].addEventListener('click', launcherClick);
	};

	function truncateViaEllipses(text, max) {
    return text.substr(0, max-1) + (text.length > max ? '...' : '');
  };

  /* Truncate News Titles
	 * locations at: / & /news
	 */
  var newsTitleTextElm  = document.querySelectorAll('.news header h3 span'), i;
  for (i = 0; i < newsTitleTextElm.length; ++i) {
    var newTitleTexts = newsTitleTextElm[i].innerHTML;
    newsTitleTextElm[i].innerHTML = truncateViaEllipses(newTitleTexts, 50);
  };

  /* Truncate News Summaries
	 * locations at: / & /news
	 */
  var newsSummaryTextElm  = document.querySelectorAll('.news .summary'), i;
  for (i = 0; i < newsSummaryTextElm.length; ++i) {
    var newsSummaryTexts = newsSummaryTextElm[i].innerHTML;
    newsSummaryTextElm[i].innerHTML = truncateViaEllipses(newsSummaryTexts, 120);
  };

  function socialSharer(e){
    var urlBase     = this.getAttribute("data-href");
    var urlParams   = this.getAttribute("data-params");
    window.open(urlBase + urlParams, "popup", "width=600,height=450");
  }

  // Twitter Setter & Listener
  var socialTwitterElement = document.getElementsByClassName('item twitter');
  socialTwitterElement[0].addEventListener("click", socialSharer);

  // Facebook Setter & Listener
  var socialFacebookElement = document.getElementsByClassName('item facebook');
  socialFacebookElement[0].addEventListener("click", socialSharer);
})();