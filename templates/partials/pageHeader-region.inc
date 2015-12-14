<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
if (isset($node->type) && $node->type == 'news_release') {
    $title = 'News Release';
    if (!empty($node->created)) {
        $old   = strtotime('-30 days');
        if ($node->created < $old) {
            $title = 'News Archive';
        }
    }
}
elseif (!empty($bookInfo->title)) {
    $title = $bookInfo->title;
}

echo render($title_prefix);
echo "<h1>$title</h1>";
echo render($title_suffix);
echo render($page['header_page']);
