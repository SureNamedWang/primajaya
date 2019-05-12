<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembayaran;
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
            Session::flash('message', "Tipe file salah. Tipe file yang diterima hanya png/jpg/jpeg");
            return Redirect::back();
        }
        else{
            $path = $request->file('fileToUpload')->store('pembayaran', 'public');
            //dd($path);
            $pembayaran->bukti=$path;
        }
        $pembayaran->jumlah = 0;
        $pembayaran->approval = 0;
        $pembayaran->save();
        return back();
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

        $data=Pembayaran::find($id);
        if($request->approval="Approved"){
            $data->approval = 1;
        }
        $data->jumlah = $request->jumlah;

        $order=Orders::find($data->id_orders);
        $order->total_pembayaran+=$request->jumlah;
        //dd($order->total_pembayaran);

        $data->save();
        $order->save();
        return redirect('/pembayaran');
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
