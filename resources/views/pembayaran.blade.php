@extends('index')
@section('content')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Pembayaran</h1>
    </div>
</section>
@if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
@if (Session::has('alert'))
<div class="alert alert-info">{{ Session::get('alert') }}</div>
@endif
<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">OrderID</th>
                            <th scope="col">Bukti</th>
                            <th scope="col">Bank</th>
                            <th scope="col">Jumlah Bayar</th>
                            <th scope="col">Approval</th>
                            <th scope="col">Tanggal Upload</th>
                            @if($user->admin!='User')
                            <th scope="col">Tanggal Approval</th>
                            @endif
                            <th scope="col">Keterangan</th>
                            @if($user->admin!='User')
                            <th scope="col">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembayaran as $item)
                        <tr>
                            <td>{{$item->id_orders}}</td>
                            <td>
                                <img src="{{asset('storage/'.$item->bukti)}}" style="height: 50px;width: 50px;">
                            </td>
                            <td>@if($item->bank!=null||$item->bank!="")
                                {{$item->bank}}
                                @else
                                <i class="fa fa-window-minimize"></i>
                                @endif
                            </td>
                            <td>Rp. {{number_format($item->jumlah)}}</td>
                            <td>
                                @if($item->approval=='Approved')
                                <i class="fa fa-check"></i>
                                @elseif($item->approval=='Pending')
                                <i class="fa fa-window-minimize"></i>
                                @elseif($item->approval=='Denied')
                                <i class="fa fa-times"></i>
                                @endif
                            </td>
                            <td>{{$item->tanggal_bayar}}</td>
                            @if($user->admin!='User')
                            <td>{{$item->tanggal_approval}}</td>
                            @endif
                            <td>{{$item->keterangan}}</td>
                            @if($user->admin!='User')
                            <td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal{{$item->id}}">Approval</button></td>

                            <!-- The Modal -->
                            <div class="modal" id="myModal{{$item->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                          <h4 class="modal-title">Approve Pembayaran</h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>

                                      <!-- Modal body -->
                                      <form method="post" action="{{ route('pembayaran.update', ['id' => $item->id]) }}">
                                        {{method_field('PATCH')}}
                                        {{csrf_field()}}
                                        <div class="modal-body">
                                            <div class="form-group col-sm-12">
                                                <div class="form-label-group">
                                                    <img src="{{asset('storage/'.$item->bukti)}}" style="height: 300px;width: 300px;" />
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <div class="form-label-group">
                                                <input type="number" min=0 name="jumlah" value="{{$item->jumlah}}" required>
                                                    <label for="jumlah">Jumlah</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <div class="form-label-group">
                                                <select class="form-control" name="bank" required>
                                                    <option value="" @if($item->bank==""||$item->bank==null) selected @endif>Pilih Bank</option>
                                                    <option value="BCA" @if($item->bank=="BCA") selected @endif>BCA</option>
                                                    <option value="Mandiri" @if($item->bank=="Mandiri") selected @endif>Mandiri</option>
                                                    <option value="BNI" @if($item->bank=="BNI") selected @endif>BNI</option>
                                                    <option value="BRI" @if($item->bank=="BRI") selected @endif>BRI</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                    <div class="form-label-group">
                                                      <label>Tanggal Pembayaran</label>
                                                      <input id="tanggal_pembayaran" class="form-control" type="datetime-local" name="tanggal_pembayaran" value="{{Carbon\Carbon::parse($item->tanggal_bayar)->format('Y-m-d\\TH:i')}}">  
                                                    </div>
                                                </div>
                                            <div class="form-group col-sm-12">
                                                <div class="form-label-group">
                                                <input type="text" id="keterangan" name="keterangan" value="{{$item->keterangan}}" required>
                                                    <label for="keterangan">Keterangan</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <input type="submit" name="approval" class="btn btn-info" value="Approved">
                                            <input type="submit" name="approval" class="btn btn-warning" value="Denied">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /endModal -->
                        @endif
                    </tr>
                    @endforeach

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        @if($user->admin!='Admin')
                        <td><button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modalPembayaran">Upload</button></td>
                        <!-- The Modal -->
                        <div class="modal" id="modalPembayaran">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                      <h4 class="modal-title" style="bolder">Upload Bukti Pembayaran</h4>
                                      
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <!-- Modal body -->
                                  <form method="post" action="{{route('pembayaran.store')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <div class="input-file input-file-image mx-auto">
                                            <input type="hidden" name="OrderID" value="{{$id}}">
                                            Upload Bukti Pembayaran
                                            <img class="img-upload-preview" width="150" src="http://placehold.it/150x150" alt="preview">
                                            <input type="file" class="form-control form-control-file" id="uploadImg" name="fileToUpload" accept="image/*">
                                            <label for="uploadImg" class=" label-input-file btn btn-primary">Upload new Image</label>
                                            <br>
                                            <label for="uploadImg" class="form-check-label">(format file jpg/jpeg/png)</label>
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
                    <td><a href="{{route('orders.index')}}" class="btn btn-block btn-info">BACK</a></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
</div>
</div>


@endsection