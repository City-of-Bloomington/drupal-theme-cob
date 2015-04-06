<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
?>
<nav class="breadcrumbs">
<?php
    $crumbs = array_reverse(taxonomy_get_parents_all($node->field_category['und'][0]['tid']));
    foreach ($crumbs as $term) {
        echo l($term->name, 'taxonomy/term/'.$term->tid);
    }
?>
</nav>
