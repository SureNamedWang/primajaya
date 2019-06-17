<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Gambar;
use App\Harga;
use App\Ukuran;
use App\AddonKain;
use App\AddonLogo;
use App\masterUkuran;
use App\tipeUkuran;
use Auth;
use Session;
use Redirect;
use Collect;

class BarangController extends Controller
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
        $products = Products::all();
        return view('barang')->with(compact('products','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user= Auth::user();
        $ukuran=masterUkuran::all();
        $tipe=tipeUkuran::all();
        return view('tambahbarang')->with(compact('user','ukuran','tipe'));
    }

    public function tipe($id){
        //dd($id);
        $user= Auth::user();
        $ukuran=Ukuran::where('id_products',$id)->get();
        $tipe=tipeUkuran::all();
        return view('tambahtipe')->with(compact('user','ukuran','tipe'));
    }

    public function ukuran(){

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
        //dd($request->input());

    }

    public function storeBarang(Request $request){
        //Dari Tambah Barang
        if($request->asal=="tambahBarang"){

            $barang = new Products();
            $barang->detail=$request->detail;
            $barang->nama=$request->nama;
            //dd($barang);
            $barang->save();

            $barang=Products::where('detail',$request->detail)->where('nama',$request->nama)->first();
            //dd($barang);

            $gambarBarang = new Gambar();

            $path = $request->file('fileToUpload')->extension();
                //dd($path);
            if($path!='png' and $path!='jpg' and $path!='jpeg'){
                Session::flash('message', "Tipe file salah. Tipe file yang diterima hanya png/jpg/jpeg");
                return Redirect::back();
            }
            else{
                $path = $request->file('fileToUpload')->store('barang', 'public');
                $gambarBarang->id_products=$barang->id;
                $gambarBarang->gambar=$path;
                $gambarBarang->thumbnail=1;

                $gambarBarang->save();
            }

            $ukuran= new Ukuran();
            $ukuran->id_products=$barang->id;
            $ukuran->id_mukuran=$request->ukuran;

            $ukuran->save();

            $ukuran=Ukuran::where('id_products',$barang->id)->where('id_mukuran',$request->ukuran)->first();

            $harga=new Harga();
            $harga->id_ukuran=$ukuran->id;
            $harga->id_tipe=$request->tipe;
            $harga->harga=$request->harga;

            $harga->save();

        }
    }

    public function storeTipe(Request $request){
        //Dari Tambah Ukuran
        $pesan="";
        $err=Harga::where('id_ukuran', $request->ukuran)->whereIn('id_tipe', $request->tipe)->get();
        //dd($err);
        foreach ($err as $key => $value) {
            # code...
            //dd($value);
            $pesan =$pesan."Tipe ".$value->hargaTipe->nama." sudah ada untuk barang ini \n";
        }
        if($pesan!=""){
            Session::flash('message', $pesan);
            return Redirect::back();
        }
        else{
            foreach ($request->tipe as $key => $value) {
                # code...
                $data=new Harga();
                $data->id_ukuran=$request->ukuran;
                $data->id_tipe=$value;
                $data->harga=$request->harga[$key];

                $data->save();
            }
            $pesan = "Data berhasil disimpan";
            Session::flash('message', $pesan);
            return Redirect::back();
        }
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //tambah ukuran barang

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

    public function ajaxTipe(Request $request){
        //dd($request->input());
        $tipes=Harga::where('id_ukuran',$request->id)->get();
        //dd($tipes);

        $tipes->transform(function ($item, $key) {
            $item->id_tipe=$item->hargaTipe->nama;
            return $item;
        });
        //dd($tipes);

        return response($tipes,200);
    }

    public function updateTipe($id){
        $user= Auth::user();
        $ukuran=Ukuran::where('id_products',$id)->get();
        return view('updatetipe')->with(compact('ukuran','user'));
    }

    public function storeUpdateTipe(Request $request){

        foreach ($request as $key => $value) {
            # code...

            dd($value);
            $update=Harga::where('id',$value->id);

            $update->harga=$value->harga;

            $update->save();

        }
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
