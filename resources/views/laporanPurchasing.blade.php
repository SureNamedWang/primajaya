@extends('index')
@section('content')

@if($user->admin=='Pemilik')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Laporan Purchasing</h1>
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
                <table id="tblPurchasing-datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Tanggal Pesan</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchasing as $pemesanan)
                        <tr>
                            <td>{{$pemesanan->id_orders}}</td>
                            <td>{{$pemesanan->tanggal_pesan->day}} {{$pemesanan->tanggal_pesan->monthName}} {{$pemesanan->tanggal_pesan->year}}</td>
                            <td>Rp. {{number_format($pemesanan->total)}}</td>
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
		$('#tblPurchasing-datatables').DataTable({
		});
    })
</script>
@endsection