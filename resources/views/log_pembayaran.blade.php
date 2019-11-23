@extends('index')
@section('content')

@if($user->admin=='Pemilik')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Log Pembayaran</h1>
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
                <table id="tblLogPembayaran-datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Perubahan</th>
                            <th scope="col">Data Awal</th>
                            <th scope="col">Data Baru</th>
                            <th scope="col">Admin</th>
                            <th scope="col">ID Order</th>
                            <th scope="col">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                        <tr>
                            <td>{{$log->kategori}}</td>
                            <td>{{$log->data_awal}}</td>
                            <td>{{$log->data_baru}}</td>
                            <td>{{$log->logUser->name}}</td>
                            <td>{{$log->logPembayaran->id}}</td>
                            <td>{{Carbon\Carbon::parse($log->created_at)->timezone('Asia/Jakarta')->toDayDateTimeString()}}</td>
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
		$('#tblLogPembayaran-datatables').DataTable({
		});
    })
</script>
@endsection