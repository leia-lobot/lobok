<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\GoogleClient;

class GoogleClientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_connect_to_google_calendar()
    {
        $gc = new GoogleClient();
        $service = $gc->service("Calendar");
    }

    private function createCalendar($service, $client)
    {
        $google_calendar = new \Google_Service_Calendar_Calendar($client);
        $google_calendar->setSummary('Fiesta');
        $google_calendar->setTimeZone('Europe/Stockholm');

        $callback = $service->calendars->insert($google_calendar);
        var_dump($callback);
        return $callback;
    }

    private function listCalendars($service)
    {
        $calendars = $service->calendarList->listCalendarList();
        var_dump($calendars);
        return $calendars;
    }

    private function deleteCalendar($service, $id)
    {
        return $service->calendars->delete($id);
    }

    private function getCalendar($service, $id)
    {
        $calendar = $service->calendars->get($id);

        var_dump($calendar);
        return $calendar;
    }
}
