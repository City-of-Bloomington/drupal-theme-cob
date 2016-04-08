<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['contactInfo']
 */
?>
<section class="cob-staffListingWidget">
    <h2>Staff</h2>
    <table class="cob-boardsCommissions-members">
        <thead>
            <tr>
                <tr><td>Name and title</td>
                    <td>Email address</td>
                    <td>Phone Number</td>
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
