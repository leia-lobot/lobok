<?php

namespace App\Jobs;

abstract class SynchronizeGoogleResource
{

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Start with an empty page token
        $pageToken = null;

        // Delegate service instantiation to sub class.
        $service = $this->getGoogleService();

        do {
            // Ask the sub class to perform an API call with this pageToken
            $list = $this->getGoogleRequest($service, compact('pageToken'));

            foreach ($list->getItems() as $item) {
                // The sub class is responsible for mappting the data into our database
                $this->syncItem($item);
            }

            $pageToken = $list->getNextPageToken();


        } while ($pageToken);
    }

    abstract public function getGoogleService();
    abstract public function getGoogleRequest($service, $options);
    abstract public function syncItem($item);
}
