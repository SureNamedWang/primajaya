@extends('index')
@section('content')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">List Order</h1>
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
                            <th scope="col">Pembeli</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Biaya Kirim</th>
                            <th scope="col">Total</th>
                            <th scope="col">DP</th>
                            <th scope="col">Total Di Bayar</th>
                            <th scope="col">Status</th>
                            <th></th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->id_user}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->subtotal}}</td>
                            <td>{{$item->biaya_kirim}}</td>
                            <td>{{$item->total}}</td>
                            <td>{{$item->dp}}</td>
                            <td>{{$item->total_pembayaran}}</td>
                            <td>{{$item->status}}</td>
                            <td><a href="{{route('pembayaran.update', ['id' => $item->id])}}" class="btn btn-sm btn-danger">Detail Pembayaran</a></td>
                            <td><button class="btn btn-sm btn-info">Detail Order</button></td>
                            @if($user->admin==1)
                                <td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal{{$item->id}}">Ubah Biaya Kirim</button></td>
                                
                                <!-- The Modal -->
                                <div class="modal" id="myModal{{$item->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Ubah Ongkos Kirim</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <form method="post" action="{{ route('orders.update', ['id' => $item->id]) }}">
                                            {{method_field('PATCH')}}
                                            {{ csrf_field() }}
                                            <div class="modal-body">

                                                <div class="form-group col-sm-12">
                                                    <div class="form-label-group">                
                                                        <input type="text" name="hargaAwal" value="{{$item->biaya_kirim}}" disabled>
                                                        <label for="hargaAwal">Harga Awal</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <div class="form-label-group">                
                                                        <input type="number" name="hargaBaru" required>
                                                        <label for="hargaBaru">Harga Baru</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-info" value="Ubah"></button>

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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection