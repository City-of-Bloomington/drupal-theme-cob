<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @param array $data['calendarId' => '', 'type' => '']
 */
$service  = cob_calendar_service();
$calendar = $service->calendars->get($data['calendarId']);
$events   = cob_calendar_events($data['calendarId'], new \DateTime(), null, true, 4);
if ($calendar) {
    echo "
        <h2 class=\"cob-homeAnnouncements-heading\">Upcoming Events</h2>
    ";

    if (count($events)) {
        foreach ($events as $e) {
            echo '<article class="cob-mainText">';
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
                $dayTime  = $allDay ? '' : $start->format('D, g:ia').'&ndash;'.$end->format('g:ia');
            }
            else {
                // Event spans more than one day
                $monthDay = ($start->format('m') === $end->format('m'))
                    ? $start->format('F j').' - '.$end->format('j')
                    : $start->format('F j').' - '.$end->format('F j'); // Event crosses month boundary

                $dayTime = $allDay ? '' : $start->format('D, g:ia').'&ndash;'.$end->format('D, g:ia');
            }

            $location = $e->getLocation();
            echo '<time>';
            foreach (['monthDay', 'dayTime', 'location'] as $f) {
                if ($$f) { echo "<span class=\"cob-homeAnnouncements-$f\">{$$f}</span>"; }
            }
            echo '</time>';
            echo "<h1>$e->summary</h1>";
            echo '</article>';
        }
    }
    $url   = cob_calendar_url($data['calendarId']);
    echo "<a href=\"$url\" target=\"_blank\" class=\"cob-homeAnnouncements-cta\">View Google Calendar</a>";
}
