<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bahan;
use App\Products;
use App\Gambar;
use App\Harga;
use App\Ukuran;
use App\AddonLogo;
use App\MasterUkuran;
use App\MasterBahan;
use App\tipeUkuran;
use Auth;
use Session;
use Redirect;

class BahanController extends Controller
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

    public function storeBahanView($id){
        //dd($id);
        $user= Auth::user();
        $barang=Products::find($id)->load('ukuranProduct.hargaUkuran');
        //dd($barang);
        $bahans=MasterBahan::all();
        return view('insertBahan')->with(compact('user','barang','bahans','id'));
    }

    public function storeBahan(Request $request){
        $pesan="";
        
        $bahan=Bahan::where('id_master_bahan', $request->bahan)->where('id_harga',$request->ukuran)->first();
        //dd($ukuran);
        if($bahan!=null){
            $pesan ="Sudah ada bahan untuk barang dengan ukuran ini \n";   
        }
        if($pesan!=""){
            Session::flash('alert', 'Tipe bahan dengan ukuran ini sudah ada pada barang');
            return Redirect::back();
        }
        else{
            if($bahan==null){
                $newBahan = new Bahan();
                $newBahan->id_harga=$request->ukuran;
                $newBahan->id_master_bahan=$request->bahan;
                $newBahan->jumlah=$request->jumlah;
                //$newBahan->harga=$request->harga;
                //dd($newBahan);
                $newBahan->save();
            }
            Session::flash('message', 'Data berhasil disimpan');
            return Redirect::back();
        }
    }

    public function updateBahansView($id){
        $user= Auth::user();
        $idBarang=$id;
        $barang=Products::find($id)->load('ukuranProduct.hargaUkuran');
        return view('updateBahan')->with(compact('barang','user','idBarang'));
    }

    public function ajaxBahan(Request $request){
        //dd($request->input());
        $bahans=Bahan::where('id_harga',$request->id)->get();
        //dd($bahans);

        $bahans->transform(function ($bahan, $key) {
            $bahan->id_master_bahan=$bahan->MasterBahan->nama;
            return $bahan;
        });
        //dd($bahans);

        return response($bahans,200);
    }

    public function updateBahanProses(Request $request){

        foreach ($request->jumlah as $key => $value) {
            # code...

            //dd($request->id[$key]);
            $update=Bahan::where('id',$request->id[$key])->first();
            
            //dd($update);

            $update->jumlah=$value;

            //dd($update);
            $update->save();
        }
        Session::flash('message', "Update tersimpan");
        return Redirect::back();
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
?>