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
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawans as $karyawan)
                        <tr>
                            <td>{{$karyawan->nama}}</td>
                            <td>{{$karyawan->karyawanDivisi->divisiDepartemen->nama}}</td>
                            <td>{{$karyawan->karyawanDivisi->nama}}</td>
                            <td>Rp. {{number_format($karyawan->total_gaji)}}</td>
                            <td><a class="btn btn-secondary text-white" data-toggle="modal" data-target="#mDetailKerja{{$karyawan->id}}">Show Detail</a></td>

                            <!-- The Modal -->
                            <div class="modal" id="mDetailKerja{{$karyawan->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Detail Kerja</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
            
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @if($karyawan->karyawanDivisi->nama=="Rangka")
                                                    Tanggal
                                                    @elseif($karyawan->karyawanDivisi->nama=="Kain")
                                                    ID Order
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    @if($karyawan->karyawanDivisi->nama=="Rangka")
                                                    Lembur
                                                    @elseif($karyawan->karyawanDivisi->nama=="Kain")
                                                    Jumlah
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @if($karyawan->karyawanDivisi->nama=="Rangka")
                                                        @foreach ($karyawan->tanggalKerja as $key => $item)                                    
                                                            {{$key}}<hr>
                                                        @endforeach     
                                                    @else
                                                        @foreach ($karyawan->jumlahKerja as $key => $item)
                                                            {{$key}}&nbsp;&nbsp;<a class="btn btn-secondary" href={{route('produksi.show', ['id' => $key])}}>Lihat</a><hr>
                                                        @endforeach
                                                    @endif        
                                                </div>
                                                <div class="col-md-6">
                                                        @if($karyawan->karyawanDivisi->nama=="Rangka")
                                                            @foreach ($karyawan->tanggalKerja as $key => $item)                                     
                                                            @if($karyawan->karyawanDivisi->nama=="Rangka"&&$item==2)
                                                            <i class="fa fa-check"></i><hr>
                                                            @elseif($karyawan->karyawanDivisi->nama=="Rangka"&&$item==1)
                                                            <i class="fa fa-times"></i><hr>
                                                            @endif
                                                            @endforeach
                                                        @else
                                                            @foreach ($karyawan->jumlahKerja as $key => $item)
                                                                {{$item}}<hr>
                                                            @endforeach
                                                        @endif        
                                                    </div>
                                            </div>
                                        </div>
            
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /endModal -->
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