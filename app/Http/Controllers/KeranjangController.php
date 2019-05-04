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
        $cart = Keranjang::all();
        //$addonKain = AddonKain::all();
        //$addonLogo = AddonLogo::all();
        //$products = Products::all();
        //dd($cart->first()->keranjangProducts->gambar);
        //return view('cart')->with(compact('cart','products','addonKain','addonLogo'));
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
        $keranjang = new Keranjang();
        //id keranjang ambil dari yang aktif, belum ada caranya
        $keranjang->id_carts_list =1;
        $keranjang->id_products = $request->idBarang;
        $keranjang->jumlah = $request->jumlah;
        $keranjang->id_harga = $request->ukuran;
        $keranjang->id_kain = $request->rdoAddonKain;
        if(isset($request->cbkLogo)){
            $keranjang->id_logo = $request->cbkLogo;
            $hargaLogo = AddonLogo::find($request->cbkLogo)->harga;
        }
        else{
            $hargaLogo = 0;
        }
        $hargaBarang = Harga::find($request->ukuran)->harga;
        $hargaKain = AddonKain::find($request->rdoAddonKain)->harga;
        $totalHarga = $hargaBarang+$hargaKain+$hargaLogo;
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
    }
}
