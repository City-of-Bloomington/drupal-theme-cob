<?php
/**
 * @copyright 2016 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 */
$alerts = cob_alert_nodes();
if ($alerts) {
    echo '
        <section class="cob-alertHeader">
            <article class="cob-alertHeader-container">
    ';
    foreach ($alerts as $alert) {
        echo '<!--';
        print_r($alert);
        echo '-->';
        echo "<h1 class=\"cob-alertHeader-title\">$alert->title</h1>";
        echo '<div class="cob-alertHeader-content">';
        if ($alert->body['und'][0]['safe_summary']) {
            print $alert->body['und'][0]['safe_summary'];
        } else {
            print $alert->body['und'][0]['safe_value'];
        };
        echo '</div>';
        echo '<div class="cob-btn-container">';
        print l('Details', 'node/'.$alert->nid, ['attributes' => ['class' => 'cob-btn-cta', 'data-test' => 'foo']]);
        echo '</div>';
    };
    echo '
            </article>
        </section>
    ';
}
