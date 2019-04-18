<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\Google;

class SynchronizeGoogleCalendars extends SynchronizeGoogleResource implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $googleAcccount;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($googleAccount)
    {
        $this->googleAcccount = $googleAccount;   
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }

    public function getGoogleService()
    {
        return app(Google::class)
            ->connectUsing($this->googleAcccount->token)
            ->service('Calendar');
    }

    public function getGoogleRequest($service, $options)
    {
        return $service->calendarList->listCalendarList($options);
    }

    public function syncItem($googleCalendar)
    {
        if($googleCalendar->deleted) {
            return $this->googleAcccount->calendars()
                ->where('google_id', $googleCalendar->id)
                ->get()->each->delete();
        }

        $this->googleAcccount->calendars()->updateOrCreate(
            [
                'google_id' => $googleCalendar->id,
            ],
            [
            'name' => $googleCalendar->summary,
            'color' => $googleCalendar->backgroundColor,
            'timezone' => $googleCalendar->timeZone
            ]
        );
    }
}
