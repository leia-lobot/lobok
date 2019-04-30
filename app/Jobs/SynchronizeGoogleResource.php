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
        // Delegate service instantiation to sub class.
        $service = $this->getGoogleService();

        $list = $this->getGoogleRequest($service, null);

        foreach ($list->getItems() as $item) {
            // The sub class is responsible for mappting the data into our database
            $this->syncItem($item);
        }
    }

    abstract public function getGoogleService();
    abstract public function getGoogleRequest($service, $options);
    abstract public function syncItem($item);
}
