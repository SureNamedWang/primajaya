@extends('index')
@section('content')
<?php 
    $qc=0;
?>
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">List Barang Pesanan ID:{{$id}}</h1>
    </div>
</section>
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <a href="{{route('orders.index')}}" class="btn btn btn-danger">Back</a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Ukuran</th>
                            <th scope="col">Tipe</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Progress</th>
                            <th scope="col"@if($user->admin=="Pemilik"&&$statusProduksi==1) colspan=2 @endif>Quality Control</th>
                            <th scope="col">Detail Produksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $item)
                        <tr>
                            <td>{{$item->keranjangProducts->nama}}</td>
                            <td>{{$item->keranjangHarga->hargaUkuran->MasterUkuran->ukuran}}</td>
                            <td>{{$item->keranjangHarga->hargaTipe->nama}}</td>
                            <td>{{$item->jumlah}}</td>
                            @if($item->keranjangProduksi->last())
                            <td>{{round($item->keranjangProduksi->sortBy('updated_at')->last()->progress*100)}}%</td>
                            @else
                            <td>0%</td>
                            @endif
                            @if($item->quality_control!="Approved")
                            <?php
                                $qc++; 
                            ?>
                            @endif
                            <form method="post" action="{{route('QC')}}">
                                @csrf
                                <td>
                                    <input type="hidden" name="idKeranjang" value="{{$item->id}}">
                                    <select class="form-control" name="qc" required @if($user->admin!='Pemilik') disabled @endif>
                                        <option value="" @if($item->quality_control=="Pending") selected @endif>Pending</option>
                                        <option value="Approved" @if($item->quality_control=="Approved") selected @endif>Approved</option>
                                        <option value="Denied" @if($item->quality_control=="Denied") selected @endif>Denied</option>
                                    </select>
                                    @if($user->admin=="Pemilik"&&$statusProduksi==1)
                                    <td>
                                    <input type="submit" class="button btn-round" value="Ganti">
                                    </td>
                                    @endif
                                </td>
                            </form>
                            <td><a href="{{route('detailProduksi', ['id' => $id, 'idBrg' => $item->id])}}" class="btn btn-sm btn-info">Lihat Detail Produksi</a></td>
                        </tr>
                        @endforeach
                    </tr>

                </tbody>
            </table>
            @if($user->admin!="User"&&$order->status=="Quality Control")
            @if($qc>0)
            <a class="btn btn-block btn-round btn-primary" href="{{route('ubahStatusProduksi',['id'=>$id])}}">Lanjutkan Produksi</a>
            @endif
            <a class="btn btn-block btn-round btn-success mb-2" style="color:white" data-toggle="modal" data-target="#mInsertSisa">Catat Sisa Bahan</a>
            
            <form action="{{route('insertSisaBahan')}}" method="post">
                @csrf
                <!-- The Modal -->
                <div class="modal" id="mInsertSisa">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Masukkan Bahan Sisa</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                @if($user->admin=="Admin")
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nama Bahan</th>
                                            <th scope="col">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- $item=value; --}}
                                        @foreach ($bahans as $key => $item)                                    
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>
                                                <input type="text" class="form-control" name="{{$key}}" required value=0>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                @if($user->admin=="Admin")
                                <input type="submit" class="btn btn-info" value="Upload"></button>
                                @endif
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /endModal -->
            </form>
            @elseif($user->admin!="User"&&$statusProduksi==1)
            <a class="btn btn-block btn-round btn-primary" href="{{route('ubahStatusProduksi',['id'=>$id])}}">Selesaikan Produksi</a>
            @endif
            @if($user->admin!="User"&&$order->status=="Produksi")
            <a class="btn btn-block btn-round btn-secondary" style="color:white" data-toggle="modal" data-target="#mCekBahan">Check Bahan</a>
            <form action="{{route('notifyOwner', ['id' => $id])}}" method="post">
                @csrf
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
                                @if($user->admin=="Admin")
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nama Bahan</th>
                                            <th scope="col">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- $item=value; --}}
                                        @foreach ($bahans as $key => $item)                                    
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$item}}m</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                                @if($user->admin=="Pemilik")
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="datetime-local" class="form-control" name="eta"
                                        placeholder="Estimasi Bahan Sampai" aria-label="Estimasi Barang Sampai" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                    <input type="number" min=0 name="total" value="0" required>
                                        <label for="total">Total Biaya</label>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                @if($user->admin=="Admin")
                                <input type="submit" class="btn btn-info" value="Informasikan kekurangan bahan pada Owner"></button>
                                @endif
                                @if($user->admin=="Pemilik")
                                <input type="submit" class="btn btn-info" value="Notifikasi ETA pada Admin"></button>
                                @endif
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /endModal -->
            </form>
            @endif
        </div>
    </div>
</div>
</div>


@endsection