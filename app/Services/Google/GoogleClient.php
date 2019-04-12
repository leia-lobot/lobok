<?php

namespace App\Services\Google;

use App\Services\Google\Contracts\Client;
use Google_Client;
use Google_Service_Calendar;

class GoogleClient implements Client
{
    public $config;

    public $client;

    public $args;

    public function __construct(array $config)
    {
        $this->config = $config;

        //$this->setupClient();
    }

    public function getCalendars()
    {
        return [];
    }

    private function getClient()
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

        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.

        return $client;
    }

    public function getService()
    {
        // Get the API client and construct the service object.
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);

        // Print the next 10 events on the user's calendar.
        $calendarId = 'primary';

        $results = $service->events->listEvents($calendarId);
        $events = $results->getItems();

        if (empty($events)) {
            echo "No upcoming events found.\n";
        } else {
            echo "Upcoming events:\n";
            foreach ($events as $event) {
                $start = $event->start->dateTime;
                if (empty($start)) {
                    $start = $event->start->date;
                }
                printf("%s (%s)\n", $event->getSummary(), $start);
            }
        }
    }
}

    /*
     * 'service' => [

        | Enable service account auth or not.

        'enable' => env('GOOGLE_SERVICE_ENABLED', false),

        | Path to service account json file

        'file' => env('GOOGLE_SERVICE_ACCOUNT_JSON_LOCATION', ''),
    ],
     */
