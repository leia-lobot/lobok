<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;

class ResourcesController extends Controller
{
    public function index()
    {
        $resources = Resource::all();

        return view('resources.index', compact('resources'));
    }

    public function show($rs)
    {
        $resource = Resource::where('slug', $rs)->firstOrFail();
        $extras = $resource->extras()->get();

        return view('resources.show', compact(['resource', 'extras']));
    }

    public function store()
    {
        // Auth

        // Validate
        request()->validate([
            'name' => 'required',
        ]);

        // Store
        $resource = Resource::create(request(['name']));

        // Redirect
        return redirect('/resources');
    }

    public function update($rs)
    {
        $rs = Resource::where('slug', $rs)->firstOrFail();
        // Validate
        request()->validate([
            'name' => 'required',
        ]);

        // Update
        if (request('name') != $rs->name) {
            $rs->slug = null;
            $rs->update(request(['name']));
        }

        // Redirect
        return redirect('/resources');
    }

    public function destroy($rs)
    {
        $rs = Resource::where('slug', $rs)->firstOrFail();

        $rs->delete();

        return redirect('/resources');
    }
}
