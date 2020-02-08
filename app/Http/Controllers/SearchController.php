<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function getUser($user){
        $Searched_User=User::where('name', 'like', "%{$user}%")->first();

        if ($Searched_User=='') {
            
        }
        else{
            $id= $Searched_User->id;

        $data= DB::table('users')
                    ->join('profiles','profiles.user_id','=','users.id')
                    ->where('profiles.user_id','=',$id)
                    ->get();
        return $data;


        }
    }
}
