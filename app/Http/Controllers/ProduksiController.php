<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Keranjang;
use App\Produksi;
use App\Orders;
use App\User;
use Carbon\Carbon;
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
        $user=Auth::user();
        $produksi=new Produksi();
        $produksi->id_admin = $user->id;
        $produksi->id_keranjang = $request->idBarang;
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
            $produksi->foto_awal = $path;
        }
        if($request->file('fileToUpload2')!=null){    
            $path2 = $request->file('fileToUpload2')->extension();
            
            if($path2!='png' and $path2!='jpg' and $path2!='jpeg'){
                Session::flash('message', "Tipe file salah. Tipe file yang diterima hanya png/jpg/jpeg");
                return Redirect::back();
            }
            else{
                $path2 = $request->file('fileToUpload2')->store('produksi', 'public');
                //dd($path);
                $produksi->foto_akhir = $path2;
            }
        }
        

        $produksi->waktu_mulai = $request->waktu_awal;
        $produksi->waktu_selesai = $request->waktu_akhir;
        $produksi->detail_kegiatan = $request->detail;
        $produksi->jumlah=$request->progress;
        //<--- hitung progress --->
        $jumBarang=Keranjang::select('jumlah')->where('id',$request->idBarang)->first();
        //dd($jumBarang);
        $jumBrgSkrg=Produksi::where('id_keranjang',$request->idBarang)
        ->selectRaw('sum(jumlah) as jumlah')
        ->first();
        if($jumBrgSkrg->jumlah==null){
            $jumBrgSkrg->jumlah=0;
        }
        $jumBrgSkrg->jumlah=$jumBrgSkrg->jumlah+$request->progress;
        $produksi->progress=$jumBrgSkrg->jumlah/$jumBarang->jumlah;
        //<--- end hitung progress --->
        $produksi->id_admin=$request->admin;
        //dd($produksi);

        $produksi->save();

        $Orders = Orders::find($request->OrderID);
        $pembeli = User::find($user->id);

        Mail::send('email', [], function ($m) use ($path,$pembeli) {
            $m->from('noreply@primajaya.com', 'Prima Jaya');

            $m->to($pembeli->email)->subject('Pesanan Anda');

            $m->attach(asset('storage/'.$path));

            if(isset($path2)){
                $m->attach(asset('storage/'.$path2));
            }
        });

        return redirect('/detailProduksi/'.$request->OrderID.'/'.$request->idBarang);
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
        //dd($barang->keranjangProduksi);
        // for($i=0;$i<count($barang);$i++){
        //     $progress[$i]=Produksi::where('id_keranjang',$barang[$i]->id)->last();
        //     //dd($progress);
        // }
        // dd($progress);
        return view('produksi')->with(compact('barang','user','id'));
    }

    public function showDetailProduksi($id,$idBrg){
        $user = Auth::user();
        //dd($id);
        $barang=Produksi::where('id_keranjang',$idBrg)->get();
        //dd($barang);
        $jumBarang=Keranjang::select('jumlah')->where('id',$idBrg)->first();
        //dd($jumBarang);
        $jumBrgSkrg=Produksi::where('id_keranjang',$idBrg)
        ->selectRaw('sum(jumlah) as jumlah')
        ->first();
        if($jumBrgSkrg->jumlah==null){
            $jumBrgSkrg->jumlah=0;
        }
        $jumBarang->jumlah=$jumBarang->jumlah-$jumBrgSkrg->jumlah;
        //dd($jumBarang);
        return view('detailProduksi')->with(compact('barang','user','idBrg', 'jumBarang', 'id'));
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
        $produksi=Produksi::where('id',$id)->first();
        //dd($produksi);
        $produksi->id_admin = $user->id;
        $produksi->id_keranjang = $request->idBarang;
        $produksi->id_karyawan = $request->karyawan;
        
        if($request->file('fileToUpload')!=null){
            $path = $request->file('fileToUpload')->extension();
            //dd($path);
            if($path!='png' and $path!='jpg' and $path!='jpeg'){
                Session::flash('message', "Tipe file salah. Tipe file yang diterima hanya png/jpg/jpeg");
                return Redirect::back();
            }
            else{
                $path = $request->file('fileToUpload')->store('produksi', 'public');
                //dd($path);
                $produksi->foto_awal = $path;
            }
        }
        
        if($request->file('fileToUpload2')!=null){
            $path2 = $request->file('fileToUpload2')->extension();
            //dd($path2);
            if($path2!='png' and $path2!='jpg' and $path2!='jpeg'){
                Session::flash('message', "Tipe file salah. Tipe file yang diterima hanya png/jpg/jpeg");
                return Redirect::back();
            }
            else{
                $path2 = $request->file('fileToUpload2')->store('produksi', 'public');
                //dd($path2);
                $produksi->foto_akhir = $path2;
            }

        }
        $carbon_awal=Carbon::createFromFormat('Y-m-d\\TH:i', $request->waktu_awal);
        
        $carbon_akhir=Carbon::createFromFormat('Y-m-d\\TH:i', $request->waktu_akhir);
        //dd($carbon_akhir);
        //dd($request->waktu_awal);
        //dd($request->waktu_akhir);
        
        if(isset($request->waktu_awal)){
            $produksi->waktu_mulai = $carbon_awal;
        }
        if(isset($request->waktu_akhir)){
            $produksi->waktu_selesai = $carbon_akhir;
        }
        if(isset($request->detail)){
            $produksi->detail_kegiatan = $request->detail;    
        }
        
        //<--- hitung progress --->
        $jumBarang=Keranjang::select('jumlah')->where('id',$request->idBarang)->first();
        //dd($jumBarang);
        $jumBrgSkrg=Produksi::where('id_keranjang',$request->idBarang)
        ->selectRaw('sum(jumlah) as jumlah')
        ->first();
        if($jumBrgSkrg->jumlah==null){
            $jumBrgSkrg->jumlah=0;
        }
        //dd($jumBrgSkrg->jumlah);
        //dd($produksi->jumlah);
        //dd($jumBarang);
        //<--- hitung selisih --->
        if($produksi->jumlah!=$request->progress){
            $jumBrgSkrg->jumlah=$jumBrgSkrg->jumlah-$produksi->jumlah;
            $produksi->jumlah=$request->progress;
            $jumBrgSkrg->jumlah=$jumBrgSkrg->jumlah+$request->progress;
        }
        
        //<--- end hitung selisih --->
        $produksi->progress=$jumBrgSkrg->jumlah/$jumBarang->jumlah;
        //<--- end hitung progress --->
        
        $produksi->id_admin=$request->admin;
        //dd($produksi);
        $produksi->save();

        return redirect('/detailProduksi/'.$request->OrderID.'/'.$request->idBarang);
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
