<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 */
if (   !empty($node->field_cmis_documents['und'][0]['folder'])
    || !empty($node->book['bid'])) {
    $class_current = ['attributes'=>['class'=>['cob-ext-current']]];
    echo "
    <div     class=\"cob-pageHeader-navigation\">
        <nav class=\"cob-pageHeader-navigation-container\">
    ";

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
        else {
            echo theme('book_navigation', ['book_link' => $node->book]);
        }
    echo "
        </nav>
    </div>
    ";
}
