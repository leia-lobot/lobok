<?php

namespace App\Services\Contracts;

interface GoogleClientContract
{
    public function service($service);

    public function connectUsing($token);
}
