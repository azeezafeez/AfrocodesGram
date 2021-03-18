<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function getUser($user){


        $Searched_User=User::where('username', 'like', "%{$user}%")->orWhere('name', 'like', "%{$user}%")->with('profile')->get();


        if ($Searched_User=='') {
            return "";
        }
        return $Searched_User;
    }
}
