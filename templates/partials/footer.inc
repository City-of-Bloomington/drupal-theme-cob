<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
?>
<footer class="cob-siteFooter">
    <div class="cob-siteFooter-sitemap">
        <div class="cob-siteFooter-sitemap-container">
        </div>
    </div>
    <div class="cob-siteFooter-details">
        <div class="cob-siteFooter-details-container">
    <?php
        echo $feed_icons;
        echo render($page['footer']);
    ?>
    </div>
</footer>
