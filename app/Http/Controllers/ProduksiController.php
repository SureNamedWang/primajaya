<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Keranjang;
use App\Produksi;
use App\Orders;
use App\User;
use Mail;
use Auth;
use Session;
use Redirect;

class ProduksiController extends Controller
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
        $produksi=new Produksi();
        $produksi->id_orders = $request->OrderID;
        $produksi->id_karyawan = $request->karyawan;
        $path = $request->file('fileToUpload')->extension();
        //dd($path);
        if($path!='png' and $path!='jpg' and $path!='jpeg'){
            Session::flash('message', "Tipe file salah. Tipe file yang diterima hanya png/jpg/jpeg");
            return Redirect::back();
        }
        else{
            $path = $request->file('fileToUpload')->store('produksi', 'public');
            //dd($path);
            $produksi->foto = $path;
        }
        $produksi->waktu = $request->waktu;
        $produksi->detail_kegiatan = $request->detail;
        $produksi->progress=$request->progress;
        $produksi->id_admin=$request->admin;
        //dd($produksi);
        $produksi->save();

        $Orders = Orders::find($request->OrderID);
        $pembeli = User::find($Orders->id_user);

        Mail::send('email', [], function ($m) use ($path,$pembeli) {
            $m->from('noreply@primajaya.com', 'Prima Jaya');

            $m->to($pembeli->email)->subject('Pesanan Anda');

            $m->attach(asset('storage/'.$path));
        });

        return redirect('/produksi/'.$request->OrderID);
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
        //dd($id);
        $barang = Keranjang::with('keranjangProduksi')->where('id_orders',$id)->get();
        //dd($barang);
        return view('produksi')->with(compact('barang','user','id'));
    }

    public function showDetailProduksi($id,$idBrg){
        $user = Auth::user();
        //dd($id);
        $barang=Produksi::where('id_keranjang',$idBrg)->get();
        //dd($barang);
        return view('detailProduksi')->with(compact('barang','user','idBrg', 'id'));
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
