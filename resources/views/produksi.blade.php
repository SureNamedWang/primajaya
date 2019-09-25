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
        </div>
    </div>
</div>
</div>


@endsection