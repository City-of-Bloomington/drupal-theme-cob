<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['news_releases'=>[], 'title'=>'']
 */
?>
<section class="cob-latestNewsWidget uiBlock" id="news_releases">
    <h2  class="cob-latestNewsWidget-heading"><?= $data['title']; ?></h2>
    <div class="cob-latestNewsWidget-container">
    <?php
        foreach ($data['news_releases'] as $node) {
            $n = node_view($node, 'teaser');
            echo render($n);
        }
    ?>
    </div>
    <?php echo l('City Newsroom', 'newsroom'); ?>
</section>
