"use strict";
const debounce = (f, d) => {
    let timer = null;

    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            f(...args);
        }, d);
    }
};

const hover_menus = {
    services_link: 'services-dropdown',
    info_link:     'info-dropdown',
    news_link:     'news-dropdown',
    meetings_link: 'meetings-dropdown',
    city_link:     'city-dropdown'};


function toggleMenu(id) {
    const e = document.getElementById(id);
    if (e.classList.contains('visually-hidden')) {
        for (const k in hover_menus) {
            document.getElementById(hover_menus[k]).classList.add('visually-hidden');
        }
        e.classList.remove('visually-hidden');
    }
    else {
        e.classList.add('visually-hidden');
    }
}

for (const k in hover_menus) {
    const link = document.getElementById(k);
    link.addEventListener('mouseover', debounce((e)=>{
        toggleMenu(hover_menus[e.target.getAttribute('id')]);
    }, 200));
}

(function() {


	function truncateViaEllipses(text, max) {
        return text.substr(0, max-1) + (text.length > max ? '...' : '');
    };

    /**
     * Truncate News Titles
     * locations at: / & /news
     */
    let newsTitleTextElm  = document.querySelectorAll('.news header h3 span');
    newsTitleTextElm.forEach(function(title, i) {
        if (i == 0) { title.innerHTML = truncateViaEllipses(title.innerHTML, 200); }
        title.innerHTML = truncateViaEllipses(title.innerHTML, 100);
    });

    /**
     * Truncate News Summaries
     * locations at: / & /news
     */
    let newsSummaryTextElm  = document.querySelectorAll('.news .summary');
    newsSummaryTextElm.forEach(function(summary) {
        summary.innerHTML = truncateViaEllipses(summary.innerHTML, 300);
    });

    function socialSharer (e) {
        let urlBase     = this.getAttribute("data-href"),
            urlParams   = this.getAttribute("data-params");
        window.open(urlBase + urlParams, "popup", "width=600,height=450");
    }

    // Twitter Setter & Listener
    var socialTwitterElement = document.getElementsByClassName('item twitter');
    socialTwitterElement[0].addEventListener("click", socialSharer);

    // Facebook Setter & Listener
    var socialFacebookElement = document.getElementsByClassName('item facebook');
    socialFacebookElement[0].addEventListener("click", socialSharer);
})();
