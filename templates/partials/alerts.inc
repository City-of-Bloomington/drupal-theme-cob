<?php
/**
 * @copyright 2016 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 */
$alerts = cob_alert_nodes();
if ($alerts) {
    echo '
        <section class="alertsHeader">
            <div class="alertsHeader-container">
    ';
    foreach ($alerts as $alert) {
        echo '<!--';
        print_r($alert);
        echo '-->';
        echo "<h1>$alert->title</h1>";
        echo '<article>';
        print $alert->body['und'][0]['safe_value'];
        echo '</article>';

//        $n = node_view($node, 'teaser');
//        echo render($n);
    }
    echo '
            </div>
        </section>
    ';
}
