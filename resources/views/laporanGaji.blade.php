@extends('index')
@section('content')

@if($user->admin=='Pemilik')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Laporan Gaji</h1>
        <h3 class="jumbotron-heading">Periode: 
            {{$periode_awal->day}} {{$periode_awal->locale('id')->monthName}} {{$periode_awal->year}}
            -
            {{$periode_akhir->day}} {{$periode_akhir->locale('id')->monthName}} {{$periode_akhir->year}}
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
                            <th scope="col">Nama</th>
                            <th scope="col">Departemen</th>
                            <th scope="col">Divisi</th>
                            <th scope="col">Gaji</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawans as $karyawan)
                        <tr>
                            <td>{{$karyawan->nama}}</td>
                            <td>{{$karyawan->karyawanDivisi->divisiDepartemen->nama}}</td>
                            <td>{{$karyawan->karyawanDivisi->nama}}</td>
                            <td>Rp. {{number_format($karyawan->total_gaji)}}</td>
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