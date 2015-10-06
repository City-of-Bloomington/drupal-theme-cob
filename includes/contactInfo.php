<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['contactInfo']
 */
$phoneNumberFields = ['office', 'fax'];
foreach ($phoneNumberFields as $f) {
    if (!empty($data['contactInfo']->$f)) {
        echo "<div class=\"cob-ext-phone_number\">{$data['contactInfo']->$f}</div>";
    }
}
if (!empty($data['contactInfo']->email)) {
    echo "<a href=\"mailto:{$data['contactInfo']->email}\" class=\"cob-ext-email\">{$data['contactInfo']->email}</a>";
}
