@extends('index')
@section('content')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Keranjang Belanja</h1>
    </div>
</section>

<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Barang</th>
                            <th scope="col">Ukuran</th>
                            <th scope="col">Tipe Kain</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Desain</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Total Harga</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $totalHarga=0;
                        @endphp
                        @foreach ($cart as $item)
                        <tr>
                            <td><img src="{{$item->keranjangProducts->gambarProduct->where('thumbnail', 1)->first()->gambar}}" style="height: 50px;width: 50px;" /> </td>
                            <td>{{$item->keranjangProducts->nama}}</td>
                            <td>{{$item->keranjangHarga->hargaUkuran->ukuran}}</td>
                            <td>{{$item->keranjangKain->nama}}</td>
                            <td>
                                @if(isset($item->id_logo))
                                <i class="fa fa-check"></i>
                                @else
                                <i class="fa fa-window-minimize"></i>
                                @endif
                            </td>
                            <td>
                                @if(isset($item->desain))
                                <img src="{{asset('storage/'.$item->desain)}}" style="height: 50px;width: 50px;">
                                @else
                                <i class="fa fa-window-minimize"></i>
                                @endif
                            </td>
                            <td>{{$item->jumlah}}</td>
                            <td>Rp. {{number_format($item->harga)}}</td>
                            @if($userCart->status!=0)
                            <td class="text-right">
                                <form action="{{route('cart.destroy', ['id' => $item->id])}}" method="post">
                                    {{method_field('DELETE')}}
                                    {{csrf_field()}}
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @php
                        $totalHarga=$totalHarga+$item->harga;
                        @endphp
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Sub-Total</strong></td>
                            <td><strong>Rp. {{number_format($totalHarga)}}</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Shipping</strong></td>
                            <td><strong>Rp.0</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td><strong>Rp. {{number_format($totalHarga)}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <a href="{{ url('/catalogue') }}">
                        <button class="btn btn-block btn-danger">Continue Shopping</button>
                    </a>
                </div>
                @if($cart->count()!=0 and $userCart->status!=0)
                <div class="col-sm-12 col-md-6 text-right">
                    <form method="post" action="{{ route('cart.update', ['id' => $userCart->id])}}">
                        {{method_field('PATCH')}}
                        {{csrf_field()}}
                        <input type="hidden" name="subtotal" value="{{$totalHarga}}">
                        <input type="submit" class="btn btn-block btn-success" value="Check Out">
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection