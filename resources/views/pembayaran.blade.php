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
<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">OrderID</th>
                            <th scope="col">Bukti</th>
                            <th scope="col">Jumlah Bayar</th>
                            <th scope="col">Approval</th>
                            <th scope="col">Tanggal Upload</th>
                            @if($user->admin==1)
                            <th scope="col">Tanggal Approval</th>
                            @endif
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembayaran as $item)
                        <tr>
                            <td>{{$item->id_orders}}</td>
                            <td>
                                <img src="{{asset('storage/'.$item->bukti)}}" style="height: 50px;width: 50px;">
                            </td>
                            <td>{{$item->jumlah}}</td>
                            <td>
                                @if($item->approval==1)
                                <i class="fa fa-check"></i>
                                @else
                                <i class="fa fa-window-minimize"></i>
                                @endif
                            </td>
                            <td>{{$item->created_at}}</td>
                            @if($user->admin==1)
                            <td>{{$item->updated_at}}</td>
                            @endif
                            <td></td>
                            @if($user->admin==1)
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
                                                    <input type="number" name="jumlah" required>
                                                    <label for="jumlah">Jumlah</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <input type="submit" name="approval" class="btn btn-info" value="Approve"></button>

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
                        @if($user->admin!=1)
                        <td><button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modalPembayaran">Upload</button></td>
                        <!-- The Modal -->
                        <div class="modal" id="modalPembayaran">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                      <h4 class="modal-title">Upload Bukti Pembayaran</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <!-- Modal body -->
                                  <form method="post" action="{{route('pembayaran.store')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <div class="form-group col-sm-12">
                                            <input type="hidden" name="OrderID" value="{{$id}}">
                                            Upload Bukti Pembayaran
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