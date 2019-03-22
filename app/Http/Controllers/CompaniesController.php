<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Company::all();

        return view('companies.index', compact('companies'));
    }

    public function store()
    {
        // Validate
        $attributes = request()->validate(['name' => 'required']);

        // Store
        Company::create($attributes);
        // Redirect
        return redirect('/companies');
    }
}
