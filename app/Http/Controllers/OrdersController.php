<?php

namespace App\Http\Controllers;

use App\Notifications\notifikasiPengiriman;
use App\Notifications\notifikasiPenerimaan;
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
use Log;

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
        return view('orders')->with(compact('orders','user'));
    }

    public function expiredOrder(){
        $orders=Orders::all();
        $expired=0;
        foreach($orders as $order){
            $tglBeli=Carbon::parse($order->created_at);
            $tglExp=$tglBeli->addDay();
            $tglSkrg=Carbon::now();
            if($tglSkrg>=$tglExp&&$order->status=="Pending"){
                $order->status="Expired";
                $expired++;
                $order->save();
            }
        }
        Log::info('Ada '.$expired.' order yang expired');
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
        //cek quality control udah selesai atau belum
        $order=Orders::find($id);
        $barangs=Keranjang::where('id_orders',$order->id)->get();
        $pendingQC=0;
        foreach($barangs as $barang){
            if($barang->quality_control=="Denied"||$barang->quality_control=="Pending"){
                $pendingQC++;
            }
        }
        if($pendingQC==0){
            if($order->status=="Quality Control"){
                $order->status="Menunggu Pelunasan Pembayaran";
                $order->save();
            }
        }
        else{
            Session::flash('alert', "Proses Quality Control pesanan belum selesai, silahkan menunggu sampai proses Quality Control semua barang selesai!");
            return redirect('/orders');
        }

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

        if(isset($request->kode)){
            if(isset($request->buktiPengiriman)){
                $data->kode=$request->kode;
            }
            else{
                Session::flash('alert', "Kode Surat Jalan/Ekspedisi Harus Disertai Bukti Gambar");
                return Redirect::back();
            }
        }
        
        if(isset($request->buktiPengiriman)&&$request->buktiPengiriman!=""){
            $path = $request->file('buktiPengiriman')->extension();
            //dd($path);
            if($path!='png' and $path!='jpg' and $path!='jpeg'){
                Session::flash('alert', "Tipe file salah. Tipe file yang diterima hanya png/jpg/jpeg");
                return Redirect::back();
            }
            else{
                $path = $request->file('buktiPengiriman')->store('pengiriman', 'public');
                $data->bukti_pengiriman=$path;
            }
        }
        if(isset($request->buktiPenerimaan)&&$request->buktiPenerimaan!=""){
            $path = $request->file('buktiPenerimaan')->extension();
            //dd($path);
            if($path!='png' and $path!='jpg' and $path!='jpeg'){
                Session::flash('alert', "Tipe file salah. Tipe file yang diterima hanya png/jpg/jpeg");
                return Redirect::back();
            }
            else{
                $path = $request->file('buktiPenerimaan')->store('penerimaan', 'public');
                $data->bukti_penerimaan=$path;
                $data->save();
                
                $data->email=$user->email;
                $data->nama=$user->nama;
                $pembeli=User::where('id',$order->id_user)->first();
                $pembeli->notify(new notifikasiPenerimaan($data));

                $order->status="Selesai";
                $order->save();
                Session::flash('message', "Bukti Penerimaan telah berhasil diupload!");
                return redirect('/orders');
            }
        }
        $data->orders_id=$id;
        if(isset($request->pengirim)){
            $data->pengirim=$request->pengirim;
        }
        if(isset($request->eta)){
            $data->eta=$request->eta;
        }

        $data->save();

        $data2=Orders::find($id);
        if(isset($request->biaya)){
            $data2->total=$data2->total-$data2->biaya_kirim;
            $data2->biaya_kirim = $request->biaya;
            $data2->total=$data2->total+$request->biaya;
            //dd($data2->total);
            $data2->save();
        }
        if(isset($request->kode)){
            if($data->kode!=""&&$data->kode!=null){
                $data2->status="Pengiriman";
            }
            $data2->save();
        }

        
        $data->email=$user->email;
        $data->nama=$user->nama;
        $data->biaya=$data2->biaya_kirim;
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
        $this->middleware('auth', ['except' => array('expiredOrder')]);
    }
}
