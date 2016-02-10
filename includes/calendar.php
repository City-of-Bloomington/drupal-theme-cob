<?php
/**
 * @copyright 2015 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 * @param array ['calendarId' => '', 'type' => '']
 */
$service  = cob_calendar_service();
$calendar = $service->calendars->get($data['calendarId']);
$events   = cob_calendar_events($data['calendarId'], new \DateTime(), null, true, 30);
if ($calendar) {
    module_load_include('php', 'markdown', 'markdown');

    $eventData = [];

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

        $ymd = $start->format('Y-m-d');
        if (!isset($eventData[$ymd])) {
            $eventData[$ymd] = [
                'weekday'  => $start->format('l'),
                'month'    => $start->format('F'),
                'monthDate'=> $start->format('d'),
                'events'   => []
            ];
        }

        // There will be many events for each given calendar.
        // We want to cache the calendar URL so we don't have to
        // hit the database to generate the URL each time.
        $cid = $e->organizer->email;
        if ($cid) {
            $nid = cob_calendar_node_id($cid);
            if (empty($calendarUrls[$cid])) {
                $calendarUrls[$cid] = l($e->summary, "node/$nid");
            }
            $title = $calendarUrls[$cid];
        }
        else {
            $title = $e->summary;
        }

        $description = Markdown($e->description);

        $eventData[$ymd]['events'][] = [
            'title'       => $title,
            'location'    => $e->location,
            'description' => $description,
            'url'         => $e->htmlLink,
            'allDay'      => $allDay,
            'start'       => $start
        ];
    }
    echo '<section class="cob-fsCal-container">';
    foreach ($eventData as $ymd) {
        echo "
        <section class=\"cob-fsCal\">
            <h1       class=\"cob-dateHeader\">
                <span class=\"cob-dateHeader-weekday\">$ymd[weekday]</span>
                <span class=\"cob-dateHeader-month\">$ymd[month]</span>
                <span class=\"cob-dateHeader-monthDate\">$ymd[monthDate]</span>
            </h1>
        ";
        foreach ($ymd['events'] as $e) {
            $time = !$e['allDay'] ? '<time>'.$e['start']->format('g:ia').'</time>' : '';
            echo "
            <article class=\"cob-event\">
                <h1  class=\"cob-event-title\">$e[title]</h1>
                $time
                <a href=\"$e[url]\" class=\"cob-icon-calendar\" title=\"View on Google Calendar\">
                    View on Google Calendar
                </a>
                <div     class=\"cob-event-meta\">
                    <div class=\"cob-event-location\">$e[location]</div>
                </div>
                <div     class=\"cob-event-description\">$e[description]</div>
            </article>
            ";
        }
        echo "
        </section>
        ";
    }
    echo '</section>';
}
