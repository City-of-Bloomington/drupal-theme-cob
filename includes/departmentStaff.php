<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['contactInfo']
 */
?>
<section class="cob-staffListingWidget uiBlock">
    <h2>Staff</h2>
    <table class="table">
        <thead>
            <tr>
                <tr><th>Name and title</th>
                    <th>Email address</th>
                    <th>Phone Number</th>
                </tr>
            </th>
        </thead>
        <tbody>
        <?php
            echo theme('cob_directory_peopleContactInfo', ['department'=>$data['contactInfo']]);
        ?>
        </tbody>
    </table>
</section>
