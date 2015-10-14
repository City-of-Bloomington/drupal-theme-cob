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
                <th>Name</th>
                <th>Office</th>
                <th>Email Address</th>
            </th>
        </thead>
        <tbody>
            <?php
                foreach ($data['contactInfo']->people as $person) {
                    echo '<tr>';
                    $names = !empty($person->displayName)
                        ? $person->displayName
                        : "{$person->firstname} {$person->lastname}";

                    $name = '';
                    foreach (explode(' ', $names) as $n) { $name.= "<span>$n</span> "; }

                    echo "<td>$name</td>";

                $phoneNumberFields = ['office', /*'fax', 'cell', 'other', 'pager'*/];
                    foreach ($phoneNumberFields as $f) {
                        echo '<td>';
                        if (!empty($person->$f)) {
                            echo "{$person->$f}";
                        }
                        echo '</td>';
                    }
                    if (!empty($person->email)) {
                        echo "<td><a href=\"mailto:{$person->email}\" class=\"cob-ext-email\">{$person->email}</a></td>";
                    }
                    echo '</tr>';
                }
            ?>

        </tbody>
    </table>
</section>
