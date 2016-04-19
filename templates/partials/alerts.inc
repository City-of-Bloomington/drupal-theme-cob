<?php
/**
 * @copyright 2016 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 */
$alerts = cob_alert_nodes();
if ($alerts) {
    echo '<section class="alerts">';
    foreach ($alerts as $node) {
        $n = node_view($node, 'teaser');
        echo render($n);
    }
    echo '</section>';
}
