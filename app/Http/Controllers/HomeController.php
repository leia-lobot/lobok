<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Company;
use App\Resource;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return Inertia::render('Dashboard/Index');
    }

    public function welcome()
    {
        return Inertia::render('Welcome');
    }

    public function overview()
    {
        $resources = Resource::all();
        $events = Reservation::all();
        return Inertia::render('Dashboard/Overview', compact(['resources', 'events']));
    }

    public function reservation()
    {
        $companies = Company::all();
        $resources = Resource::all();

        return Inertia::render('Dashboard/Reservation', compact(['companies', 'resources']));
    }
}
