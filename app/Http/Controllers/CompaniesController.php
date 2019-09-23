<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use Inertia\Inertia;

class CompaniesController extends Controller
{
    public function index()
    {
        /*
        $companies = Company::all();

        return view('company.index', compact('companies'));
        */

        return Inertia::render('Welcome', [
            'companies' => Company::all()
        ]);
    }

    public function view($id)
    {
        $company = Company::where('id', $id)->first();

        return Inertia::render('Company/Show', [
            'companies' => $company
        ]);
    }

    public function store()
    {
        // Validate
        $attributes = request()->validate([
            'name' => 'required',
        ]);

        // Store
        Company::create($attributes);
        // Redirect
        return redirect('/companies');
    }

    public function show($slug)
    {
        $company = Company::where('slug', $slug)->first();

        return Inertia::render('Company/Show', [
            'companies' => $company
        ]);
    }
}
