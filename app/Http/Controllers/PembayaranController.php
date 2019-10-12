<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembayaran;
use App\log_pembayaran;
use App\Orders;
use Auth;
use Session;
use Redirect;

class PembayaranController extends Controller
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
        //dd($request->file('fileToUpload'));
        $pembayaran=new Pembayaran();
        $pembayaran->id_orders = $request->OrderID;
        $path = $request->file('fileToUpload')->extension();
        //dd($path);
        if($path!='png' and $path!='jpg' and $path!='jpeg'){
            Session::flash('alert', "Tipe file salah. Tipe file yang diterima hanya png/jpg/jpeg");
            return Redirect::back();
        }
        else{
            $path = $request->file('fileToUpload')->store('pembayaran', 'public');
            //dd($path);
            $pembayaran->bukti=$path;
        }
        $pembayaran->jumlah = 0;
        $pembayaran->approval = 'Pending';
        $pembayaran->save();
        Session::flash('message', "Bukti Pembayaran telah berhasil dimasukkan!");
        return redirect('/pembayaran/'.$request->OrderID);
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
        $user = Auth::user();
        $pembayaran = Pembayaran::where('id_orders',$id)->get();
        //dd($pembayaran);
        return view('pembayaran')->with(compact('pembayaran','user','id'));
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
        //dd($request->input());
        $user=Auth::user();
        $data=Pembayaran::find($id);
        $logPembayaran=new log_pembayaran();
        if($data->approval!=$request->approval){
            $logPembayaran=new log_pembayaran();
            $logPembayaran->kategori='Approval';
            $logPembayaran->data_awal=$data->approval;
            $logPembayaran->data_baru=$request->approval;
            $logPembayaran->admin=$user->id;
            $logPembayaran->id_pembayaran=$id;
            $logPembayaran->save();
        }
        $data->approval=$request->approval;
        $order=Orders::find($data->id_orders);
        if($data->jumlah!=$request->jumlah){
            $logPembayaran=new log_pembayaran();
            $logPembayaran->kategori='jumlah';
            $logPembayaran->data_awal=$data->jumlah;
            $logPembayaran->data_baru=$request->jumlah;
            $logPembayaran->admin=$user->id;
            $logPembayaran->id_pembayaran=$id;
            $logPembayaran->save();
        }
        $order->total_pembayaran=$order->total_pembayaran-$data->jumlah;
        $order->total_pembayaran+=$request->jumlah;

        if($order->total_pembayaran>=$order->dp){
            $order->status="Produksi";
        }
        if(isset($request->keterangan)){
            if($data->keterangan!=$request->keterangan){
                $logPembayaran=new log_pembayaran();
                $logPembayaran->kategori='keterangan';
                $logPembayaran->data_awal=$data->keterangan;
                if($logPembayaran->data_awal==null){
                    $logPembayaran->data_awal="null";
                }
                $logPembayaran->data_baru=$request->keterangan;
                $logPembayaran->admin=$user->id;
                $logPembayaran->id_pembayaran=$id;
                $logPembayaran->save();
            }
            $data->keterangan=$request->keterangan;
        }
        $data->jumlah = $request->jumlah;
        $data->save();
        $order->save();

        return redirect('/pembayaran/'.$order->id);
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
