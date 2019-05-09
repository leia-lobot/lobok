<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Invite;
use App\Mail\InviteCreated;
use Illuminate\Support\Facades\Mail;
use Validator;
use Hash;
use App\Company;

class InviteController extends Controller
{
    // show the user a form with an email field to invite a new user
    public function invite()
    {

        return view('invite');
    }

    // process the form submission and send the invite by email
    public function process(Request $request)
    {
        do {
            $token = str_random();
        } while (Invite::where('token', $token)->first());

        /*
            Add Permission Logic
        */

        $invite = Invite::create([
            'email' => $request->get('email'),
            'token' => $token,
            'company' => $request->get('company'),
            'role' => $request->get('role')
        ]);

        Mail::to($request->get('email'))->send(new InviteCreated($invite));

        return redirect()->back();
    }

    // here we'll look up the user by the token sent provided in the URL
    public function accept($token)
    {
        // Look up the invite
        if (!$invite = Invite::where('token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }

        return view('invite.accept', compact('token'));
    }

    public function store()
    {
        // Look up the invite

        if (!$invite = Invite::where('token', request()->only('token'))->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }

        $this->validator(request()->all())->validate();

        $user = $this->create(request()->all());

        $user->assignRole($invite->role);
        $user->company_id = $invite->company;
        $user->save();

        // delete the invite so it can't be used again
        $invite->delete();

        // here you would probably log the user in and show them the dashboard, but we'll just prove it worked
        auth()->login($user);

        return redirect('/home');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'token' => ['required', 'string', 'max:16'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
