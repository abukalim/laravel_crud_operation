<?php

namespace App\Http\Controllers;

use Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DemoController extends Controller
{
    public function show()
    {
        return view('demo');
    }

    public function loginConfirm(Request $request)
    {



        $cred =   $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);



        if (Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ])) {

            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Email Or password invalid');
        }
    }
    public function registerConfirm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:users',
            'password' => 'required|min:8|max:12'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $result = $user->save();
        if ($result) {
            return back()->with('success', 'You have registered successfully.');
        } else {
            return back()->with('fail', 'Something wrong!');
        }
    }

    public function dashboard(Request $request)
    {
        $details=DB::table('product')
        ->select('id','product_name','product_description','product_image','product_price')
        ->orderBy('created_at','ASC')
        ->paginate(1);


        // $details=DB::table('product')
        // ->select('id','product_name','product_description','product_image','product_price')
        // ->where('id',$request->product_id)
        //  ->first();
      //  return view('dashboard',compact('details'));
        return view("dashboard", ["viewdetails"=>$details]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('demo');
    }
}
