@extends('index')
@section('content')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Pembayaran</h1>
    </div>
</section>

<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">OrderID</th>
                            <th scope="col">Bukti</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Approval</th>
                            <th scope="col">Tanggal Upload</th>
                            <th scope="col">Tanggal Approval</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembayaran as $item)
                        <tr>
                            <td>{{$item->id_orders}}</td>
                            <td>{{$item->bukti}}</td>
                            <td>{{$item->jumlah}}</td>
                            <td>
                                @if($item->approval==1)
                                <i class="fa fa-check"></i>
                                @else
                                <i class="fa fa-window-minimize"></i>
                                @endif
                            </td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                            <td><a href="{{route('orders.index')}}" class="btn btn-sm btn-info">Detail Order</a></td>
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
                                                        <img src="{{$item->bukti}}" style="height: 300px;width: 300px;" />
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
                                                <input type="submit" name="approval" class="btn btn-info" value="Approved"></button>

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