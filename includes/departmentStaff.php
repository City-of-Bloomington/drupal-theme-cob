<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>
 * @param array $data['contactInfo']
 */
?>
<h2>Staff</h2>
<dl class="cob-boardsCommissions-members">
<?php
    foreach ($data['contactInfo']->people as $person) {
        $names = !empty($person->displayName)
            ? $person->displayName
            : "{$person->firstname} {$person->lastname}";
            
        $name = '';
        foreach (explode(' ', $names) as $n) { $name.= "<span>$n</span> "; }

        echo "<dt>$name</dt>";

        $phoneNumberFields = ['office', 'fax', 'cell', 'other', 'pager'];
        foreach ($phoneNumberFields as $f) {
            if (!empty($person->$f)) {
                echo "<dd class=\"cob-ext-phone_number\">$f: {$person->$f}</dd>";
            }
        }
        if (!empty($person->email)) {
            echo "<dd><a href=\"mailto:{$person->email}\" class=\"cob-ext-email\">{$person->email}</a></dd>";
        }
    }
?>
</dl>