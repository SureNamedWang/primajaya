@extends('index')
@section('content')

@if($user->admin==1)
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Pembayaran</h1>
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
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col" class="w-15">Detail</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->detail}}</td>
                            
                        </tr>
                        @endforeach

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{route('barang.create')}}" class="btn btn-block btn-info">Tambah Barang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endif
@endsection