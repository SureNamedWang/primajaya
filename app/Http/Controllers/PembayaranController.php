<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembayaran;
use App\log_pembayaran;
use App\Orders;
use Auth;
use Session;
use Redirect;
use Carbon\Carbon;

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

    public function showLogPembayaran(Request $request){
        $user=Auth::user();
        //$logs=log_pembayaran::with('logPembayaran')->get();
        $logs=log_pembayaran::all();
        //dd($logs);
        return view('log_pembayaran')->with(compact('user','logs'));
    }

    public function showLaporanPemasukan(Request $request){
        $user=Auth::user();
        $start=$request->periode_awal.' 0:00:00';
        $fin=$request->periode_akhir.' 23:59:59';
        $pembayaran=Pembayaran::whereBetween('tanggal_bayar',[$start,$fin])->where('approval','Approved')->get();
        //dd($pembayaran);

        $pembayaran->transform(function ($bayar,$key){
            $bayar->tanggal_bayar=Carbon::parse($bayar->tanggal_bayar);
            return $bayar;
        });

        $awal=Carbon::parse($start);
        $akhir=Carbon::parse($fin);
        return view('laporanPemasukan')->with(compact('user','pembayaran','awal','akhir'));
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
        $pembayaran->tanggal_bayar=Carbon::now('Asia/Jakarta');
        //dd($pembayaran);
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
        if($request->bank==""||$request->bank==null){
            Session::flash('alert', "Anda belum memilih Bank, silahkan pilih terlebih dahulu");
            return Redirect::back();
        }
        $user=Auth::user();
        $data=Pembayaran::find($id);
        
        if($data->approval!=$request->approval){
            
            $logPembayaran=new log_pembayaran();
            $logPembayaran->kategori='Approval';
            $logPembayaran->data_awal=$data->approval;
            $logPembayaran->data_baru=$request->approval;
            $logPembayaran->admin=$user->id;
            $logPembayaran->id_pembayaran=$id;
            $logPembayaran->save();
            $data->approval=$request->approval;

            $logPembayaran=new log_pembayaran();
            $logPembayaran->kategori='tanggal_approval';
            $logPembayaran->data_awal=$data->tanggal_approval;
            $logPembayaran->data_baru=Carbon::now()->timezone('Asia/Jakarta');
            $logPembayaran->admin=$user->id;
            $logPembayaran->id_pembayaran=$id;
            $logPembayaran->save();
            $data->tanggal_approval=Carbon::now()->timezone('Asia/Jakarta');

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
        if($data->jumlah!=$request->jumlah){
            //$data->jumlah = $request->jumlah;
            $order=Orders::find($data->id_orders);
            $order->total_pembayaran=$order->total_pembayaran-$data->jumlah;
            if($order->total_pembayaran<0){
                $order->total_pembayaran=0;
            }
            $order->total_pembayaran+=$request->jumlah;
            
            //log
            $logPembayaran=new log_pembayaran();
            $logPembayaran->kategori='Jumlah';
            $logPembayaran->data_awal=$data->jumlah;
            $logPembayaran->data_baru=$request->jumlah;
            $logPembayaran->admin=$user->id;
            $logPembayaran->id_pembayaran=$id;
            $logPembayaran->save();
            $data->jumlah=$request->jumlah;

        }

        $logPembayaran=new log_pembayaran();
        $logPembayaran->kategori='Bank';
        $logPembayaran->data_awal=$data->bank;
        $logPembayaran->data_baru=$request->bank;
        $logPembayaran->admin=$user->id;
        $logPembayaran->id_pembayaran=$id;
        $logPembayaran->save();
        $data->bank=$request->bank;

        if(isset($order)){   
            if($order->total_pembayaran>=$order->dp){
                if($order->status=="Pending"){
                    $order->status="Produksi";
                }
            }
            else if($order->total_pembayaran<$order->dp){
                $order->status="Pending";
            }
        }
        

        if($data->tanggal_bayar!=$request->tanggal_pembayaran){
            $data->tanggal_bayar=$request->tanggal_pembayaran;
            $logPembayaran=new log_pembayaran();
            $logPembayaran->kategori='tanggal_bayar';
            $logPembayaran->data_awal=$data->tanggal_bayar;
            $logPembayaran->data_baru=$request->tanggal_pembayaran;
            $logPembayaran->admin=$user->id;
            $logPembayaran->id_pembayaran=$id;
            $logPembayaran->save();
        }
        if(isset($order)){
            $order->save();
        }
        
        $data->save();

        return redirect('/pembayaran/'.$data->pembayaranOrders->id);
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
