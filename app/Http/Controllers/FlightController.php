<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;
use App\Models\User;
class FlightController extends Controller
{
    public function users(){
        // $phone = User::with(['phone'])->get();
        // dd($phone);
    //   return view('home');
    // $phone = Phone::with(['user'])->get();
    // dd($phone);
    $phone = DB::table('users')->get();
    dd($phone);
    }
}
