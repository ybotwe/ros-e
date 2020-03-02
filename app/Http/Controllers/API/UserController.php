<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }


    public function search(){

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
            'firstname'       => 'required|string|max:191',
            'lastname'       => 'required|string|max:191',
            'email'      => 'required|email|max:191|unique:users',
            'password'   => 'required|min:6',
        ]);
        return User::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
    }


    public function profile()
    {
        return auth('api')->user();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'firstname'       => 'required|string|max:191',
            'lastname'       => 'required|string|max:191',
            'email'      => 'required|email|max:191|unique:users',
            'password'   => 'required|min:6',
        ]);
        $user->update($request->all());
        return ['message' => $user->name . ' Updated'];
    }

    public function updateProfile(Request $request)
    {
        $user_id = auth('api')->user()->id;
        $user = User::findOrFail($user_id);
        $this->validate($request, [
            'firstname'       => 'required|string|max:191',
            'lastname'       => 'required|string|max:191',
            'email'      => 'required|email|max:191|unique:users',
            'password'   => 'required|min:6',
        ]);
        $request['password'] = Hash::make($request['password']);
        $user->update($request->all());
        return ['message' => $user->name . ' Updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $user = User::findOrFail($id);
        $user->delete();

        return ['message' => 'deleted'];
    }
}
