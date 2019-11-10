@extends('index')
@section('content')
@if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">List Order</h1>
    </div>
</section>

<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table id="tblOrders-datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Opsi</th>
                            <th scope="col">OrderID</th>
                            @if($user->admin!='User')
                            <th scope="col">Pembeli</th>
                            @endif
                            <th scope="col">Tanggal Beli</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Biaya Kirim</th>
                            <th scope="col">Total</th>
                            <th scope="col">DP Minimal</th>
                            <th scope="col">Total Di Bayar</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Opsi
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{route('pembayaran.update', ['id' => $item->id])}}">Pembayaran</a>
                                        @if($user->admin!='Admin')
                                        <a class="dropdown-item" href="{{route('cart.show', ['id' => $item->id])}}">Detail Order</a>
                                        @endif
                                        @if($item->dp<=$item->total_pembayaran)
                                        <a class="dropdown-item" href="{{route('produksi.show', ['id' => $item->id])}}">Produksi</a>
                                        @endif
                                        @if($user->admin!='User'&&$item->status=="Quality Control")
                                        <a class="dropdown-item" data-toggle="modal" data-target="#myModal{{$item->id}}">Pengiriman</a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{$item->id}}</td>
                            @if($user->admin!='User')
                            <td>{{$item->OrdersUsers->name}}</td>
                            @endif
                            <td>{{$item->created_at}}</td>
                            <td>Rp. {{number_format($item->subtotal)}}</td>
                            <td>Rp. {{number_format($item->biaya_kirim)}}</td>
                            <td>Rp. {{number_format($item->total)}}</td>
                            <td>Rp. {{number_format($item->dp)}}</td>
                            <td>Rp. {{number_format($item->total_pembayaran)}}</td>
                            <td>{{$item->status}}</td>
                            @if($user->admin!='User')
                                
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
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
		$('#tblOrders-datatables').DataTable({
		});
    })
</script>
@endsection