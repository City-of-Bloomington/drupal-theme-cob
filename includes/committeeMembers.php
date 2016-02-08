<?php
/**
 * @copyright 2015-2016 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['committee'] The committee object from the webservice call
 */
?>
<section class="cob-boardsCommissions-members">
    <h1>Members</h1>
    <?php
        if (isset(   $data['committee']->seats)) {
            foreach ($data['committee']->seats as $seat) {
                $member = $seat->currentMember;

                if ($member) {
                    // Stylesheet expects name in multiple spans,
                    // and applies bold font to last span inside
                    // the <dt> where we render $memberName - DH 2/8/2016
                    $memberName = '';
                    foreach(explode(' ', $member->name) as $n){
                        $memberName .= "<span>$n</span> ";
                    }

                    echo "
                    <dl class=\"cob-boardsCommissions-member\">
                        <dt>$memberName</dt>
                    ";
                    if ($seat->appointedBy) {
                        echo "<dd>Appointed by: {$seat->appointedBy}</dd>";
                    }
                    if (!empty($member->termEndDate)) {
                        echo "<dd>Term expires: {$member->termEndDate}</dd>";
                    }
                    else {
                        echo "<dd>Member since: {$member->startDate}</dd>";
                    }
                    echo "
                    </dl>
                    ";
                }
            }
        }

        if ($data['committee']->info->vacancy) {
            echo "
            <div   class=\"cob-boardsCommissions-apply\">
                <a class=\"cob-btn-cta\" href=\"https://docs.google.com/a/bloomington.in.gov/forms/d/1Q3H008RerQj0UKXd1ohtKm_XVZyAeqBp_lFkT6eR6Z8/viewform\">
                    Apply to fill a vacancy on this board
                </a>
            </div>
            ";
        }
    ?>
</section>
