<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['press_releases']
 */
?>
<section class="cob-latestNewsWidget block">
    <h2  class="cob-latestNewsWidget-heading">Latest News</h2>
    <div class="cob-latestNewsWidget-container">
    <?php
        foreach ($data['press_releases'] as $node) {
            $n = node_view($node, 'teaser');
            echo render($n);
        }
    ?>
    </div>
    <?php echo l('More News', 'newsroom'); ?>
</section>
