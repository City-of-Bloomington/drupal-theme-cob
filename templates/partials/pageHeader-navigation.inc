<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
if (   !empty($node->field_civiclegislation_links)
    || !empty($node->book['bid'])) {
    $class_current = ['attributes'=>['class'=>['cob-ext-current']]];
    echo "
    <div     class=\"cob-pageHeader-navigation\">
        <nav class=\"cob-pageHeader-navigation-container\">
    ";
        if (!empty($node->field_civiclegislation_links['und'][0]['folder'])) {
            $p    = current_path();
            $attr = count(explode('/', $p))==2 ? $class_current : [];
            echo l('About', "node/{$node->nid}", $attr);

            foreach (field_get_items ('node', $node, 'field_civiclegislation_links') as $item) {
                $f = field_view_value('node', $node, 'field_civiclegislation_links', $item);
                echo render($f);
            }
        }
        else {
            echo theme('book_navigation', ['book_link' => $node->book]);
        }
    echo "
        </nav>
    </div>
    ";
}
