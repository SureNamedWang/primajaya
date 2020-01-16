<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\notifikasiKekuranganBahan;
use App\Notifications\notifikasiETAbahan;
use App\karyawan;
use App\Keranjang;
use App\Produksi;
use App\Orders;
use App\User;
use App\penyimpanan_bahan;
use App\MasterBahan;
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

    public function qualityControl(Request $request){
        //dd($request->input());
        $user=Auth::user();
        $barang=Keranjang::find($request->idKeranjang);
        if($request->qc=="Approved"){
            $barang->quality_control="Approved";
        }
        else if($request->qc=="Denied"){
            $barang->quality_control="Denied";
        }
        else{
            Session::flash('alert', "Quality Control hanya bisa diubah menjadi Approved atau Denied!");
            return Redirect::back();    
        }
        $barang->save();
        
        Session::flash('message', "Quality Control Barang Berhasil di Ubah!");
        return Redirect::back();
    }

    public function insertSisaBahan(Request $request){
        //dd($request->except('_token'));
        $user=Auth::user();
        $sisas=penyimpanan_bahan::all();
        $saved=0;
        foreach($request->except('_token') as $bahan=>$jumlah){
            $saved=0;
            foreach($sisas as $sisa){
                if($sisa->penyimpananMasterBahan->nama==$bahan){
                    $sisa->jumlah+=$jumlah;
                    $sisa->admin=$user->id;
                    $sisa->save();
                    $saved=1;
                }
            }
            if($saved==0){
                $newSisa=new penyimpanan_bahan();
                $id=MasterBahan::where('nama',$bahan)->first();
                $newSisa->master_bahans_id=$id->id;
                $newSisa->jumlah=$jumlah;
                $newSisa->admin=$user->id;
                $newSisa->save();
            }
        }
        $sisas=penyimpanan_bahan::all();
        Session::flash('message', "Sisa Bahan Telah Berhasil Diupload!");
        return Redirect::back();
    }

    public function ubahStatusProduksi($id){
        $orders=Orders::find($id);
        if($orders->status=="Produksi"){
            $orders->status="Quality Control";
            Session::flash('message', "Produksi untuk Order ID:".$id." telah berhasil dihentikan");
        }
        else if($orders->status=="Quality Control"){
            $orders->status="Produksi";
            Session::flash('message', "Produksi untuk Order ID:".$id." telah berhasil dilanjutkan");
        }
        //dd($orders);
        $orders->save();
        return redirect('/produksi/'.$id);
    }

    public function laporanGaji(Request $request){
        $user=Auth::user();
        $start=$request->periode_awal.' 0:00:00';
        $fin=$request->periode_akhir.' 23:59:59';
        $produksi=Produksi::whereBetween('waktu_selesai',[$start,$fin])->get();
        
        $jumlah=0;
        $gaji=collect();
        $karyawans=Karyawan::with(array('produksi' => function($query) use ($start,$fin){
            $query->whereBetween('waktu_selesai',[$start,$fin])->orderBy('waktu_selesai','ASC');
        }))->get();
        //dd($karyawans);
        $karyawans->transform(function ($karyawan, $key) {
            $produksis = $karyawan->produksi;
            $jumlah=0;
            $hariKerja=collect();
            $jumlahKerja=collect();
            switch ($karyawan->karyawanDivisi->nama) {
                case 'Rangka':
                    $temporaryCollection = collect();
                    foreach ($produksis as $produksi) {
                        $waktu_selesai=Carbon::parse($produksi->waktu_selesai);
                        $key = $waktu_selesai->format('dmY');
                        $value=1;

                        //kalau kerja diatas jam 6(18:00) kasih tambah pengali gaji
                        if($waktu_selesai->hour>=18){
                            $value = 2;
                        }
                        
                        $temporaryCollection->put($key, $value);

                        //Absen kerja
                        $hariKerja->put($key, $value);
                    }

                    foreach ($temporaryCollection as $value) {
                        $jumlah += $value;
                    }
                    break;
                case 'Kain':
                    foreach ($produksis as $produksi) {
                        $jumlah += $produksi->jumlah;
                        
                        //jumlah perOrderan kerja
                        $idOrderan=$produksi->produksiKeranjang->id_orders;
                        if($jumlahKerja->has($idOrderan)){
                            $jumlahKerja->idOrderan+=$produksi->jumlah;
                        }
                        else{
                            $jumlahKerja->put($idOrderan,$produksi->jumlah);
                        }
                    }
                    break;
                default:
                break;
            }

            if($jumlah!=0){
                $karyawan->pengali_gaji = $jumlah;
                $karyawan->total_gaji = $jumlah*$karyawan->gaji;
                $karyawan->tanggalKerja=$hariKerja;
                $karyawan->jumlahKerja=$jumlahKerja;
                return $karyawan;
            }
        });
        $periode_awal=Carbon::parse($request->periode_awal);
        $periode_akhir=Carbon::parse($request->periode_akhir);
        $karyawans = $karyawans->filter(function ($karyawan, $key) {
            if(isset($karyawan)){
               return $karyawan; 
            }
        });
        //dd($karyawans);
        return view('laporanGaji')->with(compact('user','karyawans','periode_awal','periode_akhir'));
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
            Session::flash('alert', "Tipe file untuk produksi awal salah. Tipe file yang diterima hanya png/jpg/jpeg");
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
                Session::flash('alert', "Tipe file untuk produksi akhir salah. Tipe file yang diterima hanya png/jpg/jpeg");
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
        $pembeli = User::find($Orders->id_user);

        Mail::send('email', [], function ($m) use ($path,$pembeli,$Orders) {
            $m->from('noreply@primajaya.com', 'Prima Jaya');
            $m->to($pembeli->email)->subject('Pesanan Tenda untuk Order ID:'.$Orders->id);
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
        $jumlahBarangJadi=0;
        $statusProduksi=0;
        $user = Auth::user();
        $barang = Keranjang::with('keranjangProduksi')->where('id_orders',$id)->get();
        //dd(count($barang));
        foreach($barang as $item){
            if($item->keranjangProduksi->first()!=null){
                if($item->keranjangProduksi->sortBy('updated_at')->last()->progress==1){
                    $jumlahBarangJadi++;
                }
            }
        }
        if($jumlahBarangJadi==count($barang)){
            $statusProduksi=1;
        }
        
        //dd($barang);
        $orders=Orders::find($id)->load('ordersKeranjang.keranjangHarga.hargaBahan');
        $bahans=collect();
        //dd($orders);
        // dd($orders->ordersKeranjang->first()->keranjangHarga->hargaBahan);
        foreach($orders->ordersKeranjang as $ord){
            foreach($ord->keranjangHarga->hargaBahan as $bahan){
                //dd($bahan->MasterBahan->nama);
                if($bahans->get($bahan->MasterBahan->nama)==null){
                    $bahans->put($bahan->MasterBahan->nama,$bahan->jumlah);
                }
                else{
                    $jumlah=$bahans->get($bahan->MasterBahan->nama);
                    $jumlah=$bahans->get($bahan->MasterBahan->nama)+$bahan->jumlah;
                    $bahans[$bahan->MasterBahan->nama]+=$jumlah*$ord->jumlah;
                }
            }
        }
        //dd($bahans);
        
        $order=Orders::find($id);
        return view('produksi')->with(compact('order','barang','statusProduksi','bahans','user','id'));
    }

    public function notifyOwner(Request $request,$id){
        if(isset($request->eta)){
            //Notifikasi email
            $owner = Auth::user();
            $admin = User::where('admin','Admin')->first();
            $admins = User::where('admin','Admin')->get();

            $tgl=Carbon::createFromFormat('Y-m-d\\TH:i', $request->eta, 'Asia/Jakarta');
            //dd($tgl->dayOfWeek);
            $eta=collect();
            $eta->put('id',$id);
            $eta->put('nama',$owner->name);
            $eta->put('email',$owner->email);
            $eta->put('tanggal',$tgl);
            //dd($eta);
            $admin->notify(new notifikasiETAbahan($eta,$admins));

            $gudang=penyimpanan_bahan::all();
            foreach($gudang as $sisa){
                $sisa->jumlah=0;
                $sisa->save();
            }

            Session::flash('message', "Email telah terkirim ke semua admin!");
            return Redirect::back();
        }
        
        $user = Auth::user();
        //dd($user);
        $barang = Keranjang::with('keranjangProduksi')->where('id_orders',$id)->get();
        $orders=Orders::find($id)->load('ordersKeranjang.keranjangHarga.hargaBahan');
        $bahans=collect();
        foreach($orders->ordersKeranjang as $ord){
            foreach($ord->keranjangHarga->hargaBahan as $bahan){
                if($bahans->get($bahan->MasterBahan->nama)==null){
                    $bahans->put($bahan->MasterBahan->nama,$bahan->jumlah);
                }
                else{
                    $jumlah=$bahans->get($bahan->MasterBahan->nama);
                    $jumlah=$bahans->get($bahan->MasterBahan->nama)+$bahan->jumlah;
                    $bahans[$bahan->MasterBahan->nama]+=$jumlah*$ord->jumlah;
                }
            }
        }
        $gudangs=penyimpanan_bahan::all();
        $sisa=collect();
        if(count($gudangs)>0){
            foreach($bahans as $bahan=>$jumlah){
                foreach($gudangs as $gudang){
                    if($gudang->penyimpananMasterBahan->nama==$bahan){
                        $jumlah=$jumlah-$gudang->jumlah;
                        // if($bahan=="besi"){
                        //     $jumlah=round($jumlah/6);
                        // }
                        // else{
                        //     $jumlah=round($jumlah/10);
                        // }
                        $sisa->put($bahan,$jumlah);
                    }
                }
            }
            //Notifikasi email
            $owner = User::where('admin','Pemilik')->first();
            $sisa->id=$id;
            $sisa->email=$user->email;
            $sisa->nama=$user->name;
            //dd($sisa);
            $owner->notify(new notifikasiKekuranganBahan($sisa));
        }
        else{
            $owner = User::where('admin','Pemilik')->first();
            $bahans->id=$id;
            $bahans->email=$user->email;
            $bahans->nama=$user->name;
            //dd($bahans);
            $owner->notify(new notifikasiKekuranganBahan($bahans));
        }
        
        Session::flash('message', "Email telah terkirim ke pemilik!");
        return Redirect::back();
    }

    public function showDetailProduksi($id,$idBrg){
        $user = Auth::user();
        $order=Orders::find($id);
        $cek=Keranjang::where('id',$idBrg)->where('id_orders',$id)->first();
        //dd($cek);
        if($cek==null){
            Session::flash('alert', "Barang tidak ditemukan!");
            return redirect('/produksi/'.$id);
        }

        $karyawan = karyawan::where('divisis_id',1)->orWhere('divisis_id',2)->get();
        //dd($karyawan);
        $barang=Produksi::where('id_keranjang',$idBrg)->get();
        
        $jumBarang=Keranjang::select('jumlah')->where('id',$idBrg)->first();
        $jumBrgSkrg=Produksi::where('id_keranjang',$idBrg)
        ->selectRaw('sum(jumlah) as jumlah')
        ->first();
        if($jumBrgSkrg->jumlah==null){
            $jumBrgSkrg->jumlah=0;
        }
        $jumBarang->jumlah=$jumBarang->jumlah-$jumBrgSkrg->jumlah;
        //dd($jumBarang);
        return view('detailProduksi')->with(compact('order','barang','karyawan','user','idBrg', 'jumBarang', 'id'));
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
                Session::flash('alert', "Tipe file salah. Tipe file yang diterima hanya png/jpg/jpeg");
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
                Session::flash('alert', "Tipe file salah. Tipe file yang diterima hanya png/jpg/jpeg");
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
            //dd($jumBrgSkrg->jumlah);
            //dd($produksi->jumlah);
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
