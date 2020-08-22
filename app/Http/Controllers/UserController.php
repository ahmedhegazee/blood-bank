<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = User::paginate(10);
        return view('users.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'password' => 'required|string|confirmed',
            'email' => 'required|email',
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        User::create($request->all());
        flash('User is added', 'success')->important();
        return redirect(route('user.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param    User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'password' => 'required|string|confirmed',
            'email' => 'required|email',
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        $user->update($request->all());
        flash('User is updated', 'success')->important();
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        flash('User is updated', 'success')->important();
        return redirect(route('user.index'));
    }
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|string',
            'new_password' => 'required|string|confirmed',
        ]);
        if (Hash::check($request->old_password, auth()->user()->password)) {
            auth()->user()->update([
                'password' => bcrypt($request->new_password)
            ]);
            flash('password is changed successfully', 'success')->important();
            return back();
        } else {
            return back()->withErrors(['old_password' => 'The old password is not correct']);
        }
    }
    public function showPasswordForm()
    {
        return view('auth.change-password');
    }
}