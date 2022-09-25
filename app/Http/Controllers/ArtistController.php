<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ArtistController extends Controller
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

        $artist = Artist::create([
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        $token = $artist->createToken('myToken')->plainTextToken;
        return response([
           'artist'=>$artist,
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
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
           
       $artist = Artist::where('email',$request->email)->first();
       if(!$artist || !Hash::check($request->password, $artist->password)){
        return response([
            'message'=>"Invalid Credentials."
        ]);
       }else{
        $token = $artist->createToken('myToken')->plainTextToken;
        return response([
             $artist,
            'token'=>$token
        ]);
       }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'succefully Logged Out!!'
        ]);
    }
}
