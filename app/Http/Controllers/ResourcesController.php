<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;

class ResourcesController extends Controller
{
    public function store() {
        
        // Auth

        // Validate
        request()->validate([
            'name' => 'required'
        ]);

        // Store
        $resource = Resource::create(request(['name']));

        // Redirect
        return redirect('/resources');
    }

    public function index() {
        $resources = Resource::all();

        return view('resources.index', compact('resources'));
    }
}
