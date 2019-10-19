<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Divisi;
use App\karyawan;
use App\Keranjang;
use App\Produksi;
use App\Orders;
use App\User;
use Carbon\Carbon;
use Mail;
use Auth;
use Session;
use Redirect;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $karyawan=karyawan::all();
        $user=Auth::user();
        $divisi=Divisi::all();
        //dd($user);
        if($user->admin!='Pemilik'){
            Session::flash('alert', "Anda tidak mempunyai hak akses halaman");
            return redirect('catalogue');
        }
        return view('karyawan')->with(compact('karyawan','user','divisi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $karyawan=new karyawan();
        $karyawan->nama=$request->nama;
        $karyawan->sex=$request->sex;
        $karyawan->divisis_id=$request->divisi;
        $karyawan->gaji=$request->gaji;
        //dd($karyawan);
        $karyawan->save();
        return Redirect::back();
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
        $karyawan=karyawan::where('id',$id)->first();
        $karyawan->nama=$request->nama;
        $karyawan->sex=$request->sex;
        $karyawan->divisis_id=$request->divisi;
        $karyawan->gaji=$request->gaji;
        //dd($karyawan);
        $karyawan->save();
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
}
