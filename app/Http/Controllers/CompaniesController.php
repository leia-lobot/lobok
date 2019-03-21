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

    public function store(Request $request)
    {
        // Validate
        // Store
        Company::create(request(['name']));
        // Redirect
        return redirect('/companies');
    }
}
