<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect('catalogue');
    }

    public function showProfile(){
        $user = Auth::user();
        //dd($user);
        return view('profile')->with(compact('user'));
    }

    public function editProfile(Request $request){
        //dd($request->input());
        $user=Auth::user();
        $user->name=$request->name;
        $user->telp=$request->phone;
        $user->alamat=$request->address;
        $user->save();
        Session::flash('message', "Profile Telah Berhasil Disimpan");
        return Redirect::back();
    }
}
