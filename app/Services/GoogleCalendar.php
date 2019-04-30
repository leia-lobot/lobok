<?php

namespace App\Services;

use Google_Service_Calendar_Calendar;
use App\Services\Contracts\GoogleClientContract;

class GoogleCalendar implements GoogleCalendarContract
{
    public $service;

    public function __construct(GoogleClientContract $client)
    {
        $this->service = $client->service('Calendar');
    }

    public function createAndReturnCalendar($title)
    {
        $calendar = new Google_Service_Calendar_Calendar();
        $calendar->setSummary($title);
        $calendar->setTimeZone('Europe/Stockholm');

        $createdCalendar = $this->service->calendars->insert($calendar);

        return $createdCalendar->getId();
    }

    public function listCalendars()
    {
        return $this->service->calendarList->listCalendarList();
    }

    public function getCalendarById($id)
    {
        return $this->service->calendars->get($id);
    }

    public function updateCalendar($id, $newtitle)
    {
        $calendar = $this->service->calendars->get($id);
        $calendar->setSummary($newtitle);

        $updatedCalendar = $this->service->calendars->update($id, $calendar);
    }

    public function clearCalendar($id)
    {
        $this->service->calendars->clear($id);
    }

    public function deleteCalendar($id)
    {
        $this->service->calendars->delete($id);
    }
}
