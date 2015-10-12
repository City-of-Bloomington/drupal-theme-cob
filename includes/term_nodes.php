<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['term']
 */

/**
 * If desired, you can add additional content items to be displayed to this
 * $external_term_links array.  The index of the array should be the TID for the
 * term you want to add content to.
 *
 * Items in this array will get merged and sorted into the list that's displayed.
 */
$external_term_links = [
    5 => [ // Getting Around Bloomington
        [
            'url'     => 'http://rogue.bloomington.in.gov/myCity',
            'title'   => 'MyBloomington',
            'summary' => 'Provides information about City services available to addresses in the vicinity of Bloomington, IN.'
        ],
    ],
    12 => [ // Residents -> Getting Around (Production)
        [
            'url'     => 'http://bloomington.in.gov/inroads',
            'title'   => 'inRoads',
            'summary' => 'inRoads is used to manage and publish road, sidewalk and parking status information including closings, lane reductions, noise permits and parking reservations.'
        ],
    ],
    22 => [ // Visitors -> History and Tourism (Production)
        [
            'url'     => 'http://www.visitbloomington.com',
            'title'   => 'Visit Bloomington',
            'summary' => 'Proud to promote the area as a tourist destination and strives to provide excellent service and up-to-date information to visitors.'
        ],
    ],
    39 => [ // Government -> Operations -> Code
        [
            'url'     => 'http://bloomington.in.gov/code',
            'title'   => 'Municipal Code',
            'summary' => 'The Municipal Code is intended to make the laws of the city as accessible as possible to city officials, city employees and private citizens.'
        ],
    ]
];
?>
<div    class="cob-portalContent">
    <h2 class="cob-portalContent-heading"><?= $data['term']->name ?></h2>
    <?php
        $tid = $data['term']->tid;

        // Buffer the nodes so we can merge in additional content later
        $items = [];
        $nodes = cob_taxonomy_nodes($tid);
        if ($nodes) {
            foreach($nodes as $node) {
                $n = node_view($node, 'teaser');
                $items[$node->title] = render($n);
            }
        }

        // Lookup RecTrac types and add them, as content nodes, to the current term listing.
        if (!empty( $data['term']->field_rectrac_category)) {
            $types = cob_rectrac_types($data['term']->field_rectrac_category['und'][0]['value']);
            foreach ($types as $t) {
                $external_term_links[$tid][] = [
                    'url'     => 'https://bloomington.in.gov/webtrac/cgi-bin/wspd_cgi.sh/wbsearch.html?xxtype='.$t->Type,
                    'title'   => $t->Descript,
                    'summary' => ''
                ];
            }
        }

        // Merge in any content from $external_term_links
        if (!empty(  $external_term_links[$tid])) {
            foreach ($external_term_links[$tid] as $link) {
                $items[$link['title']] = "
                <article class=\"cob-mainText\">
                    <h1><a href=\"$link[url]\" target=\"_blank\">$link[title] <span class=\"cob-indicator-externalLink\">(external link)</span></a></h1>
                    <p>$link[summary]</p>
                </article>
                ";
            }
        }
        ksort($items);
        foreach ($items as $html) { echo $html; }
    ?>
</div>
