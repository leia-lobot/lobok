<?php

namespace App\Http\Controllers;

use App\Services\Google\Contracts\Client;

class GoogleController extends Controller
{
    private $gService;

    public function __construct(Client $gService)
    {
        $this->gService = $gService;
    }

    public function index()
    {
        $calendars = $this->gService->getCalendars();

        return view('google.index', compact('calendars'));
    }
}
