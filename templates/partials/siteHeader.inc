<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
?>
<header  class="cob-siteHeader">
    <div class="cob-siteHeader-container">
    <?php
        if (!empty($page['header_site'])) { echo render($page['header_site']); }
        $ASSETS = variable_get('cob_assets_path');
        include $ASSETS.'/html/cob-siteHeader-logo.html';
    ?>
    </div>
</header>
