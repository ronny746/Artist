<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $people = People::create([
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        $token = $people->createToken('myToken')->plainTextToken;
        return response([
            $people,
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
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
           
        $people = People::where('email',$request->email)->first();
       if(!$people || !Hash::check($request->password, $people->password)){
        return response([
            'message'=>"Invalid Credentials."
        ]);
       }else{
        $token = $people->createToken('myToken')->plainTextToken;
        return response([
            'user'=> $people,
            'token'=>$token
        ]);
       }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit(People $people)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, People $people)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy(People $people)
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'succefully Logged Out!!'
        ]);
    }
}
