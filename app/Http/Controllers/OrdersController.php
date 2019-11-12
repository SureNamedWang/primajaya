<?php

namespace App\Http\Controllers;

use App\Notifications\notifikasiPengiriman;
use Illuminate\Http\Request;
use App\Keranjang;
use App\Orders;
use App\pengiriman;
use App\User;
use Auth;
use Carbon\Carbon;
use Mail;
use Session;
use Redirect;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        //dd($user);
        if($user->admin=='User'){
            $orders = Orders::where('id_user',$user->id)->orderBy('created_at','desc')->get();   
        }
        else{
            $orders=Orders::orderBy('created_at','desc')->get();
        }
        //dd($pengiriman);
        return view('orders')->with(compact('orders','user'));
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
        $user=Auth::user();
        $perubahan=0;
        //pengiriman
        $data=pengiriman::where('orders_id',$id)->first();
        if(isset($data)){
            if($data->pengirim!=$request->pengirim){
                $perubahan++;
            }
            if($data->kode!=$request->kode){
                $perubahan++;
            }
            if($data->eta!=$request->eta){
                $perubahan++;
            }
            if($perubahan<1){
                Session::flash('alert', "Tidak ada perbedaan dengan data pengiriman di database, Data Gagal di Upload!");
                return redirect('/orders');
            }
        }
        else{
            $data=new pengiriman();
        }
        $data->orders_id=$id;
        $data->pengirim=$request->pengirim;
        $data->kode=$request->kode;
        $data->eta=$request->eta;
        $data->save();
        
        $data2=Orders::find($id);
        $data2->total=$data2->total-$data2->biaya_kirim;
        $data2->biaya_kirim = $request->biaya;
        $data2->total=$data2->total+$request->biaya;
        //dd($data2->total);
        if($data->kode!=""&&$data->kode!=null){
            $data2->status="Pengiriman";
        }
        else{
            $data2->status="Quality Control";
        }
        $data2->save();

        $data->email=$user->email;
        $data->nama=$user->nama;
        $data->biaya=$request->biaya;
        $pembeli=User::where('id',$data2->id_user)->first();
        $pembeli->notify(new notifikasiPengiriman($data));
        Session::flash('message', "Detail Pengiriman telah berhasil diupload!");
        return redirect('/orders');
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
