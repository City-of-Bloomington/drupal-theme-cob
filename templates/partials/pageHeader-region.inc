<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
echo '<div class="cob-pageHeader-container">';
echo render($title_prefix);
echo "<h1>$title</h1>";
echo render($page['header_page']);
echo render($title_suffix);
echo '</div>';
