<?php
/**
 * @copyright 2015-2016 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 */
$current_path = current_path();

if (   !empty($node->field_onboard_links)
    || !empty($node->field_cmisro_listing)
    || !empty($node->book['bid'])
    || $current_path === 'contact/directory') {

    echo "
    <div     class=\"cob-pageHeader-navigation\">
        <nav class=\"cob-pageHeader-navigation-container\">
    ";

    $class_current = ['attributes' => ['class' => ['current']]];

    if (!empty($node->field_onboard_links) || !empty($node->field_cmisro_listing)) {
        $attr = (count(explode('/', $current_path)) === 2) ? $class_current : [];
        echo l('About', "node/{$node->nid}", $attr);

        foreach (['field_onboard_links', 'field_cmisro_listing'] as $field) {
            if (!empty($node->$field)) {
                foreach (field_get_items ('node', $node, $field) as $item) {
                    $f = field_view_value('node', $node, $field, $item);
                    echo render($f);
                }
            }
        }
    }

    if (!empty($node->book['bid'])) {
        echo theme('book_navigation', ['book_link' => $node->book]);
    }
    elseif ($current_path === 'contact/directory') {
        echo theme('book_navigation', ['book_link' => book_link_load(330)]);
    }
    echo "
        </nav>
    </div>
    ";
}
