<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartsList;
use App\Keranjang;
use App\Products;
use App\Ukuran;
use App\Harga;
use App\AddonKain;
use App\AddonLogo;
use Auth;

class KeranjangController extends Controller
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
        if(null!=(CartsList::where('id_user',$user->id)->where('status',1)->first())){

        }    
        else{
            $newUserCart=new CartsList();
            $newUserCart->id_user=$user->id;
            $newUserCart->status=1;
            $newUserCart->save();
        }
        $userCart = CartsList::where('id_user',$user->id)->where('status',1)->first();
        $cart = Keranjang::where('id_carts_list',$userCart->id)->get();
        //dd($cart);
        return view('cart')->with(compact('cart'));
        //return view('orders')->with(compact('cart'));
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
        $user = Auth::user();
        if(null!=(CartsList::where('id_user',$user->id)->where('status',1)->first())){

        }    
        else{
            $newUserCart=new CartsList();
            $newUserCart->id_user=$user->id;
            $newUserCart->status=1;
            $newUserCart->save();
        }
        $userCart = CartsList::where('id_user',$user->id)->where('status',1)->first();
        
        $keranjang = new Keranjang();
        //id keranjang ambil dari yang aktif, belum ada caranya
        $keranjang->id_carts_list =$userCart->id;
        $keranjang->id_products = $request->idBarang;
        $keranjang->jumlah = $request->jumlah;
        $keranjang->id_harga = $request->ukuran;
        $keranjang->id_kain = $request->rdoAddonKain;
        if(isset($request->cbkLogo)){
            $keranjang->id_logo = $request->cbkLogo;
            if($request->cbkLogo==1){
                $keranjang->desain=$request->fileToUpload;
            }
            $hargaLogo = AddonLogo::find($request->cbkLogo)->harga;
        }
        else{
            $hargaLogo = 0;
        }
        $hargaBarang = Harga::find($request->ukuran)->harga;
        $hargaKain = AddonKain::find($request->rdoAddonKain)->harga;
        $totalHarga = $hargaBarang+$hargaKain+$hargaLogo;
        $totalHarga = $totalHarga*$request->jumlah;
        $keranjang->harga = $totalHarga;
        //dd($totalHarga);
        $keranjang->save();
        //dd($keranjang);
        return redirect('/cart');
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
        $keranjang = Keranjang::find($id);
        $keranjang->delete();
        return redirect()->back();
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
}
