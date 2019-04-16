<?php

namespace App\Services\Google;

use App\Services\Google\Contracts\Client;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Calendar;

class GoogleClient implements Client
{
    public $config;

    public $client;
    public $service;

    public $args;

    public function __construct(array $config)
    {
        $this->config = $config;

        $this->setupClient();
        $this->setupService();

        dd($this->getCalendarById('4nb5hnc0704u1lk70i3fmjasg8@group.calendar.google.com'));
    }

    private function setupClient()
    {
        $client = new Google_Client();
        $client->setApplicationName('Google Calendar API PHP Quickstart');
        $client->setScopes(Google_Service_Calendar::CALENDAR);

        if ($credentials_file = 'service-account.json') {
            // set the location manually
            $client->setAuthConfig($credentials_file);
        } elseif (getenv('GOOGLE_APPLICATION_CREDENTIALS')) {
            // use the application default credentials
            $client->useApplicationDefaultCredentials();
        } else {
            echo missingServiceAccountDetailsWarning();

            return;
        }

        $client->setAuthConfig('credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $this->client = $client;
    }

    public function setupService()
    {
        // Get the API client and construct the service object.
        $service = new Google_Service_Calendar($this->client);

        $this->service = $service;
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
