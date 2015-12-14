<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
if (   !empty($node->field_civiclegislation_links)
    || !empty($node->field_cmisro_listing)
    || !empty($node->book['bid'])) {

    $class_current = ['attributes' => ['class' => ['current']]];
    $attr = (count(explode('/', current_path())) === 2) ? $class_current : [];

    echo "
    <div     class=\"cob-pageHeader-navigation\">
        <nav class=\"cob-pageHeader-navigation-container\">
    ";
    echo l('About', "node/{$node->nid}", $attr);

    foreach (['field_civiclegislation_links', 'field_cmisro_listing'] as $field) {
        if (!empty($node->$field)) {
            foreach (field_get_items ('node', $node, $field) as $item) {
                $f = field_view_value('node', $node, $field, $item);
                echo render($f);
            }
        }
    }
    if (!empty($node->book['bid'])) {
        echo theme('book_navigation', ['book_link' => $node->book]);
    }
    echo "
        </nav>
    </div>
    ";
}
