<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
if ($tabs || $action_links) {
    echo "<div class=\"cob-siteAdminBar\">";
        if ($tabs)         { echo render($tabs); }
        if ($action_links) { echo "<ul class=\"action-links\">".render($action_links)."</ul>"; }
    echo "</div>";
}
