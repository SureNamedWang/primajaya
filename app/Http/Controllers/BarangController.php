<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bahan;
use App\Products;
use App\Gambar;
use App\Harga;
use App\Ukuran;
use App\AddonLogo;
use App\MasterBahan;
use App\MasterUkuran;
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
        $ukuran=MasterUkuran::all();
        $tipe=tipeUkuran::all();
        return view('tambahbarang')->with(compact('user','ukuran','tipe'));
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

            Session::flash('message', "Barang baru berhasil di simpan");
            return Redirect::back();
        }
    }

    public function editBarang(Request $request){
        //dd($request->input());
        $barang= Products::where('id',$request->idBarang)->first();
        //dd($barang);
        $barang->nama=$request->nama;
        $barang->detail=$request->detail;
        $barang->save();
        Session::flash('message', "Barang berhasil di edit");
        return Redirect::back();
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

    public function storeTipeView($id){
        //dd($id);
        $user= Auth::user();
        //$ukuran=Ukuran::where('id_products',$id)->get();
        $mukuran=MasterUkuran::all();
        $tipe=tipeUkuran::all();
        $barang=Products::find($id)->load('ukuranProduct.hargaUkuran');
        $bahans=MasterBahan::all();
        return view('tambahtipe')->with(compact('user','barang','bahans','mukuran','tipe','id'));
    }

    public function storeTipe(Request $request){
        $pesan="";
        //dd($request->input());
        $ukuran=Ukuran::where('id_mukuran', $request->mukuran)->where('id_products',$request->id)->first();
        //dd($ukuran);
        if($ukuran!=null){
            $err=Harga::where('id_ukuran', $ukuran->id)->whereIn('id_tipe', $request->tipe)->first();
            if($err!=null){
                $bahans=Bahan::where('id_produk',$data->id)->where('id_master_bahan',$request->bahan);
                if($bahans!=null){
                    Session::flash('alert', 'Barang dengan ukuran,tipe, dan bahan ini sudah ada');
                    return Redirect::back();
                }
                else{
                    Session::flash('alert', 'Barang dengan ukuran dan tipe ini sudah ada! \n Untuk menambah bahan baru silahkan pilih tambah bahan pada halaman barang');
                    return Redirect::back();
                }
            }
            else{
                //Kalau ada ukuran tapi ga ada tipe yang diinputkan
                foreach ($request->tipe as $key => $value) {
                    $data = new Harga();
                    if($ukuran==null){
                        $data->id_ukuran=$newUkuran->id;
                    }
                    else{
                        $data->id_ukuran=$ukuran->id;
                    }
                    $data->id_tipe=$value;
                    $data->harga=$request->harga[$key];
    
                    $data->save();

                    $newBahan = new Bahan();
                    $newBahan->id_produk=$data->id;
                    $newBahan->id_master_bahan=$request->bahan;
                    $newBahan->jumlah=$request->jumlah;
                    $newBahan->save();
                }

                $pesan = "Data tipe baru berhasil disimpan";
                Session::flash('message', $pesan);
                return Redirect::back();
            }
        }
        //dd($pesan);
        if($pesan!=""){
            Session::flash('alert', 'Tipe/Bahan dengan ukuran ini sudah ada pada barang');
            //dd($pesan);
            return Redirect::back();
        }
        else{
            //dd($ukuran);
            if($ukuran==null){
                
                $newUkuran = new Ukuran();
                $newUkuran->id_products=$request->id;
                $newUkuran->id_mukuran=$request->mukuran;
                $newUkuran->save();

                foreach ($request->tipe as $key => $value) {
                    # code...
                    $data = new Harga();
                    if($ukuran==null){
                        $data->id_ukuran=$newUkuran->id;
                    }
                    else{
                        $data->id_ukuran=$ukuran->id;
                    }
                    $data->id_tipe=$value;
                    $data->harga=$request->harga[$key];
    
                    $data->save();

                    $newBahan = new Bahan();
                    $newBahan->id_produk=$data->id;
                    $newBahan->id_master_bahan=$request->bahan;
                    $newBahan->jumlah=$request->jumlah;
                    $newBahan->save();
                }

                $pesan = "Data berhasil disimpan";
                Session::flash('message', $pesan);
                return Redirect::back();
            }
            
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

    public function gambar($id){
        $gambar=Gambar::where('id_products',$id)->where('deleted_at',null)->get();
        //dd($gambar);
        $user= Auth::user();
        $idBarang=$id;
        return view('insertGambar')->with(compact('gambar','user','idBarang'));
    }

    public function storeGambar(Request $request){
        $gambar=new Gambar();
        
        $path = $request->file('fileToUpload')->extension();
                //dd($path);
            if($path!='png' and $path!='jpg' and $path!='jpeg'){
                Session::flash('alert', "Tipe file salah. Tipe file yang diterima hanya png/jpg/jpeg");
                return Redirect::back();
            }
            else{
                $path = $request->file('fileToUpload')->store('barang', 'public');
                $gambar->id_products=$request->idBarang;
                $gambar->gambar=$path;
                $gambar->thumbnail=0;

                $gambar->save();
                Session::flash('message', "Gambar berhasil ditambahkan");
                return Redirect::back();
            }
    }

    public function editGambar(Request $request){
        //dd($request->input());
        if(isset($request->pilihThumbnail)){
            $gambarAwal=Gambar::where('id_products',$request->idBarang)->where('thumbnail',1)->first();
            $gambarAwal->thumbnail=0;
            $gambarAwal->save();
            $gambar=Gambar::where('id', $request->rdoGambar)->first();
            $gambar->thumbnail=1;
            $gambar->save();
            Session::flash('message', "Thumbnail telah berhasil diganti");
            return Redirect::back();
        }
        elseif(isset($request->hapusGambar)){
            
            $gambar=Gambar::where('id',$request->rdoGambar)->first();
            if($gambar->thumbnail==1){
                Session::flash('alert', "Anda tidak bisa menghapus gambar yang menjadi thumbnail barang");
                return Redirect::back();        
            }
            $gambar->delete();
            Session::flash('message', "Gambar berhasil dihapus");
            return Redirect::back();
        }
        else{
            Session::flash('alert', "Terjadi kesalahan saat memproses kegiatan");
            return Redirect::back();
        }
    }

    public function deleteGambar(Request $request){
        
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

    public function updateTipeView($id){
        $user= Auth::user();
        $idBarang=$id;
        $ukuran=Ukuran::where('id_products',$id)->get();
        return view('updatetipe')->with(compact('ukuran','user','idBarang'));
    }

    public function updateTipeProses(Request $request){

        foreach ($request->harga as $key => $value) {
            # code...

            //dd($request->id[$key]);
            $update=Harga::where('id',$request->id[$key])->first();
            
            //dd($update);

            $update->harga=$value;

            //dd($update);
            $update->save();
        }
        Session::flash('message', "Update tersimpan");
        return Redirect::back();
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
