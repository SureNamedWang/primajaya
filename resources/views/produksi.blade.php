@extends('index')
@section('content')

<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Proses Produksi Pesanan ID:{{$produksi->first()->id_orders}}</h1>
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
                            @if($user->admin==1)
                            <th scope="col">OrderID</th>
                            <th scope="col">Karyawan</th>
                            @endif
                            <th scope="col">Waktu</th>
                            <th scope="col">Detail Kegiatan</th>
                            <th scope="col">Bukti</th>
                            <th scope="col">Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produksi as $item)
                        <tr>
                            @if($user->admin==1)
                            <td>{{$item->id_karyawan}}</td>
                            @endif
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->detail_kegiatan}}</td>
                            <td>
                                <img src="{{asset('storage/'.$item->foto)}}" style="height: 50px;width: 50px;">
                            </td>
                            <td>{{$item->progress}}</td>
                        </tr>
                        @endforeach

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            @if($user->admin==1)
                            <td><button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modalPembayaran">Upload</button></td>
                            <!-- The Modal -->
                            <div class="modal" id="modalPembayaran">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                          <h4 class="modal-title">Masukkan Detail Produksi</h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>
                                      <!-- Modal body -->
                                      <form method="post" action="{{route('produksi.store')}}" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="modal-body">
                                            <div class="form-group col-sm-12">
                                                <input type="hidden" name="OrderID" value="{{$id}}">
                                                <input type="hidden" name="admin" value="{{$user->id}}">
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <div class="form-label-group">
                                                    <input type="text" name="karyawan" required>
                                                    <label for="karyawan">ID Karyawan</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <div class="form-label-group">
                                                    <input type="datetime-local" name="waktu" required>
                                                    <label for="waktu">Waktu</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <div class="form-label-group">
                                                    <h6>Detail Kegiatan</h6>
                                                    <textarea name="detail" cols="50" rows="5"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <div class="form-label-group">
                                                    <input type="number" name="progress" min="0" max="100" required>
                                                    <label for="progress">Progress</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <h6 style="bolder">Upload Gambar:</h6>
                                                <input class="input-group-btn" type="file" name="fileToUpload">
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <input type="submit" name="upload" class="btn btn-info" value="upload"></button>

                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /endModal -->
                        @endif
                        <td><a href="{{route('orders.index')}}" class="btn btn-block btn-info">List Order</a></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>


@endsection