<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
?>
<div class="cob-pageHeader-navigation">
    <nav class="cob-pageHeader-navigation-container">
    <?php
        $class_current = ['attributes'=>['class'=>['cob-ext-current']]];

        if (!empty($node->field_cmis_documents['und'][0]['folder'])) {
            $p    = current_path();
            $attr = count(explode('/', $p))==2 ? $class_current : [];
            echo l('About', "node/{$node->nid}", $attr);

            foreach ($node->field_cmis_documents['und'][0] as $key=>$value) {
                if ($key != 'folder' && !empty($value)) {
                    $label = substr($key, 9);
                    $url = "node/{$node->nid}/$label";
                    $attr = strpos($p, $label) ? $class_current : [];
                    echo l(ucfirst($label), $url, $attr);
                }
            }
        }
        elseif (!empty($node->book['bid'])) {
            // Only display this block when the user is browsing a book.
            $select = db_select('node', 'n')
                    ->fields('n', array('title'))
                    ->condition('n.nid', $node->book['bid'])
                    ->addTag('node_access');
            $title = $select->execute()->fetchField();
            // Only show the block if the user has view access for the top-level node.
            if ($title) {
                $tree = book_get_flat_menu($node->book);
                foreach ($tree as $mlid => $menu_item) {
                    $attr = !empty($menu_item['in_active_trail']) ? $class_current : [];
                    echo l($menu_item['link_title'], $menu_item['link_path'], $attr);
                }
            }
        }
    ?>
    </nav>
</div>