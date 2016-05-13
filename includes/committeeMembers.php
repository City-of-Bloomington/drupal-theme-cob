<?php
/**
 * @copyright 2015-2016 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['committee'] The committee object from the webservice call
 */
?>
<section class="uiBlock">
    <header class="uiBlock-header">
        <h1 class="uiBlock-title">Members</h1>
    </header>
    <div class="uiBlock-content">
        <div class="personList">
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
                            <dl class=\"personListing\">
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
            ?>
        </div>
        <?php
            if ($data['committee']->info->vacancy) {
                $url = '/onboard/applicants/apply?committee_id='.$data['committee']->info->id;
                echo "
                <div   class=\"btn-container\">
                    <a class=\"btn-featuredAction\" href=\"$url\">
                        Apply to fill a vacancy on this board
                    </a>
                </div>
                ";
            }
        ?>
    </div>
</section>
