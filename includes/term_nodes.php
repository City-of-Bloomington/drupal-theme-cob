<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['term']
 */
?>
<div    class="cob-portalContent">
    <h2 class="cob-portalContent-heading"><?= $data['term']->name ?></h2>
    <?php
        $nodes = node_load_multiple(taxonomy_select_nodes($data['term']->tid));
        foreach($nodes as $node) {
            $n = node_view($node, 'teaser');
            echo render($n);
        }
    ?>
</div>
