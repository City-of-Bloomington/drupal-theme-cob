<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
$tid = null;
// Normally, the breadcrumbs will be based on the category assigned to the node
if (!empty($node->field_category['und'][0]['tid'])) {
    $tid = $node->field_category['und'][0]['tid'];
}
// For book pages, we use the book's category for the breadcrumbs
if (!empty($bookInfo->field_category_tid)) {
    $tid = $bookInfo->field_category_tid;
}

if ($tid) {
    echo '<nav class="breadcrumbs">';
    echo l('Home', '/');
    $crumbs = array_reverse(taxonomy_get_parents_all($tid));
    foreach ($crumbs as $term) {
        echo l($term->name, 'taxonomy/term/'.$term->tid);
    }
    echo '</nav>';
}
