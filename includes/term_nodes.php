<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['term']
 */
$external_term_links = [
    5 => [ // Getting Around Bloomington
        [
            'url'     => 'http://rogue.bloomington.in.gov/myCity',
            'title'   => 'MyBloomington',
            'summary' => 'Provides information about City services available to addresses in the vicinity of Bloomington, IN.'
        ],
    ]
];
?>
<div    class="cob-portalContent">
    <h2 class="cob-portalContent-heading"><?= $data['term']->name ?></h2>
    <?php
        $items = [];
        $nodes = cob_taxonomy_nodes($data['term']->tid);
        if ($nodes) {
            foreach($nodes as $node) {
                $n = node_view($node, 'teaser');
                $items[$node->title] = render($n);
            }
        }
        if (!empty($external_term_links[$data['term']->tid])) {
            foreach ($external_term_links[$data['term']->tid] as $link) {
                $items[$link['title']] = "
                <article class=\"cob-main-content\">
                    <h2><a href=\"$link[url]\">$link[title]</a></h2>
                    <div><p>$link[summary]</p></div>
                </article>
                ";
            }
        }
        ksort($items);
        foreach ($items as $html) { echo $html; }
    ?>
</div>
