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
        return view('cart')->with(compact('cart','userCart'));
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
                
                $path = $request->file('fileToUpload')->extension();
                //dd($path);
                if($path!='png' and $path!='jpg' and $path!='jpeg'){
                    Session::flash('message', "Tipe file salah. Tipe file yang diterima hanya png/jpg/jpeg");
                    return Redirect::back();
                }
                else{
                    $path = $request->file('fileToUpload')->store('logo', 'public');
                    $keranjang->desain=$path;
                }
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
        //dd($request->subtotal);
        $data=CartsList::find($id);
        $data->status=0;
        
        $order=new Orders();
        $order->id_carts_list=$data->id;
        $order->id_user=$data->id_user;
        $order->subtotal=$request->subtotal;
        $order->biaya_kirim=0;
        $order->total=$order->subtotal+$order->biaya_kirim;
        $order->dp=$order->total*30/100;
        $order->status="pending";
        $order->total_pembayaran=0;
        //dd($order);
        $data->save();
        $order->save();
        return redirect()->route('orders.index');
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
