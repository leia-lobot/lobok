<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Company;
use App\Resource;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companies = Company::all();
        $resources = Resource::all();
        //dd($reservations);
        return view('home', compact(['companies', 'resources']));
    }
}
