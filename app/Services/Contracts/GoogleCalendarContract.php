<?php

namespace App\Services;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Calendar;
use App\Services\Contracts\GoogleClientContract;

interface GoogleCalendarContract
{
    public function createAndReturnCalendar($title);
    public function listCalendars();
    public function getCalendarById($id);
    public function updateCalendar($id, $newtitle);
    public function clearCalendar($id);
    public function deleteCalendar($id);
}
