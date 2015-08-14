<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
?>
<header class="cob-siteHeader">
    <div class="cob-siteHeader-container">
        <?php
            if (!empty($page['header_site'])) { echo render($page['header_site']); }
            echo cob_http_get(variable_get('cob_assets').'/html/cob-siteHeader-menu.html');
            echo cob_http_get(variable_get('cob_assets').'/html/cob-siteHeader-logo.html');
        ?>
    </div>
</header>
