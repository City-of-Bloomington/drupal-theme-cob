<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @param array ['calendarId' => ]
 */
$service  = cob_calendar_service();
$calendar = $service->calendars->get($data['calendarId']);
$events   = cob_calendar_events($data['calendarId'], new \DateTime(), null, true, 4);
if ($calendar && count($events)) {
    $title = $calendar->summary;
    $url   = cob_calendar_url($data['calendarId']);
    echo "
    <section class=\"cob-upcomingEvents\">
        <header class=\"cob-upcomingEvents-header\">
            <h1>$title</h1>
            <a href=\"$url\">View Google Calendar</a>
        </header>
    ";
    if (count($events)) {
        echo '<ol class="cob-upcomingEvents-list">';
        foreach ($events as $e) {
            if ($e->start->dateTime) {
                $allDay = false;
                $start = new \DateTime($e->start->dateTime);
                $end   = new \DateTime($e->end  ->dateTime);
            }
            else {
                # All day event
                $allDay = true;
                $start = new \DateTime($e->start->date);
                $end   = new \DateTime($e->end  ->date);
            }

            if ($start->format('Y-m-d') === $end->format('Y-m-d')) {
                // Event starts and ends on the same day
                $monthDay = $start->format('F j');
                $dayTime  = $allDay ? '' : $start->format('D, g:ia').'&ndash;'.$end->format('G:ia');
            }
            else {
                // Event spans more than one day
                $monthDay = ($start->format('m') === $end->format('m'))
                    ? $start->format('F j').' - '.$end->format('j')
                    : $start->format('F j').' - '.$end->format('F j'); // Event crosses month boundary

                $dayTime = $allDay ? '' : $start->format('D, g:ia').'&ndash;'.$end->format('D, G:ia');
            }

            $location = $e->getLocation();
            echo '<li>';
            foreach (['monthDay', 'dayTime', 'location'] as $f) {
                if ($$f) { echo "<span class=\"cob-upcomingEvents-$f\">{$$f}</span>"; }
            }
            echo '</li>';
        }
        echo '</ol>';
    }
    echo '</section>';
}
