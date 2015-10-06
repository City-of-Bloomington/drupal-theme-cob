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
        $numberType = ucFirst($f);
        echo "<div class=\"cob-ext-$f\" title=\"$numberType Number\">{$data['contactInfo']->$f}</div>";
        unset($numberType);
    }
}
if (!empty($data['contactInfo']->email)) {
    echo "<a href=\"mailto:{$data['contactInfo']->email}\" class=\"cob-ext-email\">{$data['contactInfo']->email}</a>";
}
