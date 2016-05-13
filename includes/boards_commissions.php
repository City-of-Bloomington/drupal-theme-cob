<?php
/**
 * Displays a list of boards or commissions that point to the current node
 *
 * For instance, boards point to locations.  So, we can
 * use this block when viewing a location.  This will show all the
 * departments that point to the current location.
 *
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Dan Hiester <hiesterd@bloomington.in.gov>
 * @param array $data['boards_commissions'=>[], 'title'=>'']
 */
?>
<section class="cob-boardsCommissionsWidget uiBlock" id="boards_commissions">
	<h1><?= $data['title']; ?></h1>
	<div class="cob-boardsCommissionsWidget-listing">
    <?php
        foreach ($data['boards_commissions'] as $node) {
            $n = node_view($node, 'teaser');
            echo render($n);
        }
    ?>
	</div>
</section>
