<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
?>
<footer class="cob-siteFooter">
    <div class="cob-siteFooter-sitemap">
        <h1>Navigate this site</h1>
        <div class="cob-siteFooter-sitemap-container">
            <div class="cob-siteFooter-sitemap-region">
                <h2>Residents</h2>
                <?= cob_footer_links(2); ?>
            </div>
            <div class="cob-siteFooter-sitemap-region">
                <h2>Business</h2>
                <?= cob_footer_links(3); ?>
            </div>
            <div class="cob-siteFooter-sitemap-region">
                <h2>Visitors</h2>
                <?= cob_footer_links(4); ?>
            </div>
            <div class="cob-siteFooter-sitemap-region">
                <h2>Students</h2>
                <?= cob_footer_links(5); ?>
            </div>
            <div class="cob-siteFooter-sitemap-region">
                <h2>Government</h2>
                <?= cob_footer_links(1); ?>
            </div>
            <div class="cob-siteFooter-sitemap-region">
                <p>This site is still a work in progress. You can help identify opportunities for improvement!</p>
                <a href="https://docs.google.com/a/bloomington.in.gov/forms/d/1ydyb7gHV4x7SUnguHcQILDDWHKTkZ7K-u6bewn6GNp0/viewform" class="cob-btn-cta">Send feedback</a>
                <?php
                    # echo $feed_icons;
                    echo render($page['footer']);
                ?>
            </div>
        </div>
<!--        <pre><?php print_r(taxonomy_get_children(1)); ?></pre>  -->
    </div>
    <div class="cob-siteFooter-details">
        <div class="cob-siteFooter-details-container">
            <nav class="cob-siteFooter-legalNav">
                <a href="/alpha/accessibility">Accessibility</a>
                <a href="/alpha/privacy">Privacy</a>
                <a href="/alpha/webpolicy">Web Policy</a>
            </nav>
        </div>
    </div>
</footer>
