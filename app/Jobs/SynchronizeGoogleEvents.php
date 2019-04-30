<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\Google;
use Carbon\Carbon;

class SynchronizeGoogleEvents extends SynchronizeGoogleResource implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $calendar;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($calendar)
    {
        $this->calendar = $calendar;
    }

    public function getGoogleService()
    {
        return app(Google::class)
            ->service('Calendar');
    }

    public function getGoogleRequest($service, $options)
    {
        return $service->events->listEvents(
            // We provide the Google ID of the calendar from whicch we want the events.
            $this->calendar->google_id,
            $options
        );
    }

    public function syncItem($googleEvent)
    {
        if ($googleEvent->status === 'cancelled') {
            return $this->calendar->events()
                ->where('google_id', $googleEvent->id)
                ->delete();
        }

        $this->calendar->events()->updateOrCreate(
            [
                'google_id' => $googleEvent->id
            ],
            [
                'name' => $googleEvent->summary,
                'description' => $googleEvent->description,
                'allday' => $this->isAllDayEvent($googleEvent),
                'started_at' => $this->parseDatetime($googleEvent->start),
                'started_at' => $this->parseDatetime($googleEvent->end),
            ]
        );
    }

    protected function isAllDayEvent($googleEvent)
    {
        return !$googleEvent->start->dateTime && !$googleEvent->end->dateTime;
    }

    protected function parseDatetime($googleDatetime)
    {
        $rawDateTime = $googleDatetime->dateTime ?: $googleDatetime->date;

        return Carbon::parse($rawDateTime)->setTimezone(config('app.timezone'));
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
}
