@extends('index')
@section('content')

@if($user->admin=='Pemilik')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Laporan Gaji</h1>
        <h3 class="jumbotron-heading">Periode: 
            {{$awal->day}} {{$awal->locale('id')->monthName}} {{$awal->year}}
            -
            {{$akhir->day}} {{$akhir->locale('id')->monthName}} {{$akhir->year}}
        </h3>
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
                <table id="tblGaji-datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembayaran as $pendapatan)
                        <tr>
                            <td>{{$pendapatan->tanggal_bayar->day}} {{$pendapatan->tanggal_bayar->monthName}} {{$pendapatan->tanggal_bayar->year}}</td>
                            <td>{{$pendapatan->id_orders}}</td>
                            <td>{{$pendapatan->pembayaranOrders->OrdersUsers->name}}</td>
                            <td>Rp. {{number_format($pendapatan->jumlah)}}</td>
                            <td>{{$pendapatan->keterangan}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endif
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
		$('#tblGaji-datatables').DataTable({
		});
    })
</script>
@endsection