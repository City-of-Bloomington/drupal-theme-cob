<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
if (isset($node->type) && $node->type == 'press_release') {
    $title = 'News Release';
}
elseif (!empty($bookInfo->title)) {
    $title = $bookInfo->title;
}

echo render($title_prefix);
echo "<h1>$title</h1>";
echo render($title_suffix);
echo render($page['header_page']);
