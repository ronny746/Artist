<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return 'ok';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {    
        $request->validate([
            'email'=>'required',
            'password'=>'required|confirmed'
        ]);

        $admin = Admin::create([
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        $token = $admin->createToken('myToken')->plainTextToken;
        return response([
            'admin'=>$admin,
            'token'=>$token
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
           
       $admin = Admin::where('email',$request->email)->first();
       if(!$admin || !Hash::check($request->password, $admin->password)){
        return response([
            'message'=>"Invalid Credentials."
        ]);
       }else{
        $token = $admin->createToken('myToken')->plainTextToken;
        return response([
            'admin'=>$admin,
            'token'=>$token
        ]);
       }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Auth::user()->tokens()->delete();
        return response([
            'message' => 'succefully Logged Out!!'
        ]);
    }
}