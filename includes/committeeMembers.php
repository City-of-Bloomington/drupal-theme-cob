<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['committee'] The committee object from the webservice call
 */
?>
<section class="cob-boardsCommissions-members">
    <h1>Members</h1>
    <?php
        foreach ($data['committee']->seats as $seat) {
            foreach ($seat->currentMembers as $member) {
                $memberName = '';
                $names = explode(' ', $member->name);
                foreach($names as $n){
                    $memberName .= "<span>$n</span> ";
                }
                echo "
                <dl class=\"cob-boardsCommissions-member\">
                    <dt>$memberName</dt>
                    <dd>Appointed by: {$seat->appointedBy}</dd>
                    <dd>Term expires: {$member->termEnd}</dd>
                </dl>
                ";
            }
        }
    ?>
</section>
