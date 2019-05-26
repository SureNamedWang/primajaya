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
                            <th scope="col">Detail</th>
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
                            <td></td>
                            <td></td>
                            <td></td>
                            
                            <td><button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modalPembayaran">Tambah Barang</button></td>
                            <!-- The Modal -->
                            <div class="modal" id="modalPembayaran">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                          <h4 class="modal-title">Tambah Barang</h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>
                                      <!-- Modal body -->
                                      <form method="post" action="{{route('barang.store')}}" enctype="multipart/form-data">
                                        {{csrf_field()}}

                                        <div class="modal-body">
                                            <div class="form-group col-sm-12">
                                                <div class="form-label-group">
                                                    <input type="text" name="nama" required>
                                                    <label for="nama">Nama</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <div class="form-label-group">
                                                    <h6>Detail</h6>
                                                    <textarea name="detail" cols="50" rows="5"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <h6>Gambar</h6>
                                                <input class="input-group-btn" type="file" name="fileToUpload">
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <div class="form-label-group">
                                                    <input type="text" name="ukuran" required>
                                                    <label for="ukuran">Ukuran</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <div class="form-label-group">
                                                    <input type="text" name="harga" required>
                                                    <label for="harga">Harga</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <div class="form-label-group">
                                                    <input type="text" name="type" required>
                                                    <label for="type">Type(Komplit/Rangka/Kain)</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <input type="submit" name="upload" class="btn btn-info" value="Tambah"></button>

                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /endModal -->
                        
                        <td><a href="{{route('orders.index')}}" class="btn btn-block btn-info">List Order</a></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@endif
@endsection