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
        $companies = Company::all();
        $resources = Resource::all();
        //dd($reservations);
        return Inertia::render('Dashboard/Index', compact(['companies', 'resources']));
    }

    public function welcome()
    {
        return Inertia::render('Welcome');
    }
}
