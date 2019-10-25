@extends('index')
@section('content')

<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Proses Produksi Pesanan ID:{{$id}}</h1>
    </div>
</section>
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Progress</th>
                            <th scope="col">Detail Produksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $item)
                        <tr>
                            <td>{{$item->keranjangProducts->nama}}</td>
                            <td>{{$item->jumlah}}</td>
                            @if($item->keranjangProduksi->last())
                            <td>{{$item->keranjangProduksi->last()->progress*100}}%</td>
                            @else
                            <td>0%</td>
                            @endif
                            <td><a href="{{route('detailProduksi', ['id' => $id, 'idBrg' => $item->id])}}" class="btn btn-sm btn-info">Lihat Detail Produksi</a></td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        <td><a href="{{route('orders.index')}}" class="btn btn-block btn-info">List Order</a></td>
                    </tr>

                </tbody>
            </table>
            @if($user->admin!="User")
            <a class="btn btn-block btn-primary" data-toggle="modal" data-target="#mCekBahan">Check Bahan</a>
            <!-- The Modal -->
            <div class="modal" id="mCekBahan">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">List Bahan</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Bahan</th>
                                        <th scope="col">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders->ordersKeranjang as $ord)
                                    @foreach ($ord->keranjangHarga as $produk)
                                    @foreach ($produk->hargaBahan as $bahan)
                                    <tr>
                                    <td>a</td>
                                    <td>b</td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-info" value="Ubah"></button>

                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /endModal -->
            @endif
        </div>
    </div>
</div>
</div>


@endsection