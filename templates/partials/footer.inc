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
            <div class="cob-siteFooter-sitemap-col1">
                <h2>Residents</h2>

                <h2>Students</h2>
            </div>
            <div class="cob-siteFooter-sitemap-col2">
                <h2>Business</h2>

                <h2>Visitors</h2>
            </div>
            <div class="cob-siteFooter-sitemap-col3">
                <?php
                    # echo $feed_icons;
                    echo render($page['footer']);
                ?>
            </div>
        </div>
    </div>
    <div class="cob-siteFooter-details">
        <div class="cob-siteFooter-details-container">
            <nav class="cob-siteFooter-legalNav">
                <a href="/alpha/accessibility">Accessibility</a>
                <a href="/alpha/privacy">Privacy</a>
                <a href="/alpha/webpolicy">Web Policy</a>
            </nav>
            <div class="cob-siteFooter-copyright">Copyright &copy; <?= date("Y") ?> City of Bloomington, Indiana</div>
        </div>
    </div>
</footer>
