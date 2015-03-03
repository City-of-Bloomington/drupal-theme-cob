<?php
/**
 * @copyright 2013 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['press_releases']
 */
echo "
<section class=\"block cob-latestNewsWidget\">
    <h2 class=\"cob-latestNewsWidget-heading\">Latest News</h2>
    <div class=\"cob-latestNewsWidget-container\">
";
    foreach ($data['press_releases'] as $node) {
        $n = node_view($node, 'teaser');
        echo render($n);
    }
echo "
    </div>
    <a href=\"/newsroom\" class=\"cob-latestNewsWidget-moreNews\">More News</a>
</section>
";
