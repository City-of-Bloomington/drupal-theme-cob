<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
?>
<footer class="cob-siteFooter">
    <div class="cob-siteFooter-container">
        <div class="cob-siteFooter-sitemap">
            <?= cob_footer_links() ?>
        </div>
        <div class="cob-siteFooter-alphaNotice">
            <h1>Public Alpha Website</h1>
            <p>This site is still a work in progress. You can help us make it better!</p>
            <a href="https://docs.google.com/a/bloomington.in.gov/forms/d/1ydyb7gHV4x7SUnguHcQILDDWHKTkZ7K-u6bewn6GNp0/viewform" class="cob-btn-cta">Send feedback</a>
            <?php
                echo render($page['footer']);
            ?>
        </div>
    </div>
    <div class="cob-siteFooter-details">
        <div class="cob-siteFooter-container">
            <nav class="cob-siteFooter-legalNav">
                <a href="<?= $base_path; ?>accessibility">Accessibility</a>
                <a href="<?= $base_path; ?>privacy">Privacy</a>
                <a href="<?= $base_path; ?>webpolicy">Web Policy</a>
                <a rel="license"
                   href="http://creativecommons.org/publicdomain/zero/1.0/">
                  <img src="//i.creativecommons.org/p/zero/1.0/88x31.png" style="border-style: none;" alt="CC0" />
                </a>
            </nav>
            <p xmlns:dct="http://purl.org/dc/terms/" xmlns:vcard="http://www.w3.org/2001/vcard-rdf/3.0#" class="cob-siteFooter-copyrightNotice">
              To the extent possible under law,
              <a rel="dct:publisher"
                 href="http://bloomington.in.gov">
                <span property="dct:title">City of Bloomington</span></a>
              has waived all copyright and related or neighboring rights to
              <span property="dct:title">City of Bloomington Website</span>.
            This work is published from:
            <span property="vcard:Country" datatype="dct:ISO3166"
                  content="US" about="http://bloomington.in.gov">
              United States</span>.
            </p>
        </div>
    </div>
</footer>
