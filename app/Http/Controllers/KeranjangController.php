<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartsList;
use App\Keranjang;
use App\Products;
use App\Ukuran;
use App\Harga;
use App\AddonLogo;
use App\Orders;
use Auth;
use Session;
use Redirect;

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
        $cart = Keranjang::where('id_user',$user->id)->where('id_orders',null)->get();
        //dd($cart);
        return view('cart')->with(compact('cart','user'));
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
        if(isset($request->email)){
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
            {

            }
            else{
                Session::flash('alert', "Email/Password salah, silahkan masukkan kembali atau daftar akun baru jika anda belum memiliki akun.");    
                return Redirect::back()->withInput();
            }
        }
        //
        if(!isset($request->ukuran)){
            Session::flash('alert', "Untuk memesan barang anda minimal perlu memilih ukuran yang di inginkan.");
            return Redirect::back();
        }
        $user = Auth::user();
        $keranjangUser=Keranjang::where('id_user', $user->id)->where('id_orders',null)->get();
        //dd($request->input());
        //dd($keranjangUser);
        foreach($keranjangUser as $kUser){
            if($kUser->id_products==$request->idBarang&&$kUser->id_produk==$request->ukuran&&$kUser->deleted_at==null){
                if(!isset($keranjang)){
                    if($kUser->id_logo==null&&$request->cbkLogo=='null'){
                        $keranjang=Keranjang::where('id',$kUser->id)->where('id_logo',null)->first();
                        $keranjang->jumlah=$keranjang->jumlah+$request->jumlah;
                    }
                    if($kUser->id_logo==2&&$request->cbkLogo==2){
                        $keranjang=Keranjang::where('id',$kUser->id)->where('id_logo',$request->cbkLogo)->first();
                        $keranjang->jumlah=$keranjang->jumlah+$request->jumlah;
                    }
                }
            }    
        }
        //dd($keranjang);
        if(!isset($keranjang)){
            $keranjang = new Keranjang();
            $keranjang->id_user=$user->id;
            $keranjang->id_products = $request->idBarang;
            $keranjang->jumlah = $request->jumlah;
        }
        
        $hargaBarang=0;
        if(isset($request->ukuran)){
            $keranjang->id_produk = $request->ukuran;
            $hargaBarang = Harga::find($request->ukuran)->harga;    
        }
        
        if(isset($request->cbkLogo)&&$request->cbkLogo!='null'){
            $keranjang->id_logo = $request->cbkLogo;
            //dd($request->cbkLogo);
            if($request->cbkLogo==1){
                if(isset($request->fileToUpload)){
                
                    $path = $request->file('fileToUpload')->extension();
                    //dd($path);
                    if($path!='png' and $path!='jpg' and $path!='jpeg'){
                        Session::flash('alert', "Tipe file salah. Tipe file yang diterima hanya png/jpg/jpeg");
                        return Redirect::back();
                    }
                    else{
                        $path = $request->file('fileToUpload')->store('logo', 'public');
                        $keranjang->desain=$path;
                    }
                }
                else{
                    Session::flash('alert', "Logo tidak terupload silahkan masukkan gambar logo yang di inginkan.");
                    return Redirect::back();
                }
            }
            //dd($request->input());
            if($request->cbkLogo!='null'){
                $hargaLogo = AddonLogo::find($request->cbkLogo)->harga;
            }
            else{
                $hargaLogo=0;
            }
        }
        else{
            $hargaLogo = 0;
        }

        $totalHarga = $hargaBarang+$hargaLogo;
        $totalHarga = $totalHarga*$request->jumlah;
        $keranjang->harga = $hargaBarang;
        $keranjang->total_harga=$totalHarga;
        //dd($totalHarga);
        $keranjang->save();
        //dd($keranjang);
        Session::flash('message', "Barang yang anda pilih telah di masukkan ke keranjang.");
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
        $user = Auth::user();
        $cart = Keranjang::where('id_orders',$id)->where('id_user',$user->id)->get();
        
        //dd($cart);
        return view('cart')->with(compact('cart','user','id'));
    }

    public function editKeranjang(Request $request){
        $keranjang = Keranjang::find($request->idKeranjang);
        //dd($keranjang);
        $user = Auth::user();
        
        $keranjang->jumlah = $request->jumlah;
        $hargaBarang=0;

        if(isset($request->ukuran)){
            $keranjang->id_produk = $request->ukuran;
            $hargaBarang = Harga::find($request->ukuran)->harga;    
        }
        
        if(isset($request->cbkLogo)&&$request->cbkLogo!='null'){
            $keranjang->id_logo = $request->cbkLogo;
            //dd($request->cbkLogo);
            if($request->cbkLogo==1){
                if(isset($request->fileToUpload)){
                
                    $path = $request->file('fileToUpload')->extension();
                    //dd($path);
                    if($path!='png' and $path!='jpg' and $path!='jpeg'){
                        Session::flash('alert', "Tipe file salah. Tipe file yang diterima hanya png/jpg/jpeg");
                        return Redirect::back();
                    }
                    else{
                        $path = $request->file('fileToUpload')->store('logo', 'public');
                        $keranjang->desain=$path;
                    }
                }
                else{
                    Session::flash('alert', "Logo tidak terupload silahkan masukkan gambar logo yang di inginkan.");
                    return Redirect::back();
                }
            }
            //dd($request->input());
            if($request->cbkLogo!='null'){
                $hargaLogo = AddonLogo::find($request->cbkLogo)->harga;
            }
            else{
                $hargaLogo=0;    
                $keranjang->desain=null;
                $keranjang->id_logo=null;
            }
        }
        else{
            $hargaLogo = 0;
            $keranjang->desain=null;
            $keranjang->id_logo=null;
        }

        $totalHarga = $hargaBarang+$hargaLogo;
        $totalHarga = $totalHarga*$request->jumlah;
        $keranjang->harga = $hargaBarang;
        $keranjang->total_harga=$totalHarga;
        //dd($keranjang);
        //dd($totalHarga);
        $keranjang->save();
        //dd($keranjang);
        Session::flash('message', "Detail barang berhasil diubah.");
        return redirect('/cart');
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
        $user = Auth::user();
        $order=new Orders();
        
        $order->id_user=$user->id;
        $order->subtotal=$request->subtotal;
        $order->biaya_kirim=0;
        $order->total=$order->subtotal+$order->biaya_kirim;
        $order->dp=$order->total*30/100;
        $order->status="Pending";
        $order->total_pembayaran=0;
        //dd($order);
        if($order->total==0){
            Session::flash('alert', "Tidak ada barang dalam keranjang.");
            return redirect()->route('cart.index');        
        }
        else{
            $order->save();
        
            $barang=Keranjang::where('id_user',$user->id)->where('id_orders',null)->where('deleted_at',null)->get();
            foreach($barang as $items){
                $items->id_orders=$order->id;
                $items->save();
            }
        }
        

        return redirect()->route('orders.index');
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
        $this->middleware('auth')->except('store');
    }
}