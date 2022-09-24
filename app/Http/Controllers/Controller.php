<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    
    public function register(Request $req){


        $imagename = "";
        if ($req->hasFile('image')) {
            $image = $req->image;
            $image->move('profileimage/', $image->getClientOriginalName());

        	$imagename = $req->image->getClientOriginalName();
            
        }
            $user = new User;
            $user->f_name=$req->f_name;
            $user->l_name=$req->l_name;
            $user->email=$req->email;
            $user->password=$req->password;
            $user->image=$imagename;
            $result = $user->save();
            if($result){
                return[
                    'message'=>'success'
                ];
            }else{
                return[
                    'message'=>'faild'
                ];
            }

    }

    public function loginwithemail(Request $req) {
        
        $user= User::where(['email'=>$req->email])->first();
      

        if($user != null){
            if($req->password != $user->password){
                return ["Result"=>"Wrong credentials please try again"];
            }else{
                $user= User::where(['email'=>$req->email])->first();
               
                return ["Result"=>$user]; 
            }
        
        }else{
            return ["Result"=>"Something Wrong please try again"];
        }
     
    }
    public function createPin(Request $req){


        $imagename = "";
        if ($req->hasFile('image')) {
            $image = $req->image;
            $image->move('profileimage/', $image->getClientOriginalName());

        	$imagename = $req->image->getClientOriginalName();
            
        }
            $user = User::find($req->id);
            $user->f_name=$req->f_name;
            $user->l_name=$req->l_name;
           // $user->email=$req->email;
            $user->password=$req->password;
            $user->image=$imagename;
             $user->pin=$req->pin;
            $result = $user->save();
            if($user){
                return[
                    'message'=>$user
                ];
            }else{
                return[
                    'message'=>'faild'
                ];
            }

    }
}
