<?php

namespace App\Services\Google\Contracts;

interface Client
{
    public function createAndReturnCalendar($title);
}
