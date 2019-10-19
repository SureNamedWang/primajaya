@extends('index')
@section('content')

@if($user->admin!='User')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">List Barang</h1>
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
                <table id="tblKaryawan-datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" colspan="1">Aksi</th>
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Departemen</th>
                            <th scope="col">Divisi</th>
                            @if($user->admin=='Pemilik')
                            <th scope="col">Gaji</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawan as $pekerja)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#modalEditKaryawan{{$pekerja->id}}">Edit</a>
                                    </div>
                                </div>
                                <!-- The Modal -->
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalEditKaryawan{{$pekerja->id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Form Tambah Karyawan</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
            
                                            <!-- Modal body -->
                                            <form method="post" action="{{route('karyawan.update', ['id' => $pekerja->id])}}">
                                                {{method_field('PATCH')}}
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <div class="form-group form-group-default" style="width:auto;">
                                                        <label>Nama</label>
                                                        <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama Karyawan" value="{{$pekerja->nama}}" required>
                                                    </div>
                                                    
                                                    <div class="form-group form-group-default" style="width:auto;">
                                                        <label>Jenis Kelamin</label>
                                                        <select class="form-control" id="formGroupDefaultSelect" name="sex" required>
                                                            <option>Pilih Jenis Kelamin</option>
                                                            @if($pekerja->sex=="pria")
                                                            <option data-techname="pria" value="pria" selected>Pria</option>
                                                            @else
                                                            <option data-techname="pria" value="pria">Pria</option>
                                                            @endif
                                                            @if($pekerja->sex=="wanita")
                                                            <option data-techname="wanita" value="wanita" selected>Wanita</option>
                                                            @else
                                                            <option data-techname="wanita" value="wanita">Wanita</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="form-group form-group-default" style="width:auto;">
                                                        <label>Divisi</label>
                                                        <select class="form-control" id="formGroupDefaultSelect" name="divisi" required>
                                                            <option>Pilih Divisi</option>
                                                            @foreach($divisi as $division)
                                                            @if($pekerja->divisis_id==$division->id)
                                                            <option data-techname="{{$division->id}}" value="{{$division->id}}" selected>{{$division->nama}}</option>
                                                            @else
                                                            <option data-techname="{{$division->id}}" value="{{$division->id}}">{{$division->nama}}</option>
                                                            @endif
                                                            
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group form-group-default" style="width:auto;">
                                                        <label>Gaji</label>
                                                        <input id="gaji" type="number" class="form-control" name="gaji" min=0 placeholder="Gaji Karyawan" value="{{$pekerja->gaji}}" required>
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
                            </td>
                            <td>{{$pekerja->id}}</td>
                            <td>{{$pekerja->nama}}</td>
                            <td>{{$pekerja->sex}}</td>
                            <td>{{$pekerja->karyawanDivisi->divisiDepartemen->nama}}</td>
                            <td>{{$pekerja->karyawanDivisi->nama}}</td>
                            @if($user->admin=="Pemilik")
                            <td>{{$pekerja->gaji}}/{{$pekerja->karyawanDivisi->tipeGaji}}</td>
                            @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-6">
                        <a class="btn btn-block btn-secondary" style="color:white;" data-toggle="modal" data-target="#modalTambahKaryawan">Tambah Karyawan</a>
                    </div>
                    <!-- The Modal -->
                    <div class="modal" id="modalTambahKaryawan">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Form Tambah Karyawan</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <form method="post" action="{{ route('karyawan.store') }}">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-group form-group-default">
                                        <label>Nama</label>
                                        <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama Karyawan" required>
                                    </div>
                                    
                                    <div class="form-group form-group-default">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control" id="formGroupDefaultSelect" name="sex" required>
                                            <option>Pilih Jenis Kelamin</option>
                                            <option data-techname="pria" value="pria">Pria</option>
                                            <option data-techname="wanita" value="wanita">Wanita</option>
                                        </select>
                                    </div>
                                    <div class="form-group form-group-default">
                                        <label>Divisi</label>
                                        <select class="form-control" id="formGroupDefaultSelect" name="divisi" required>
                                            <option>Pilih Divisi</option>
                                            @foreach($divisi as $division)
                                            <option data-techname="{{$division->id}}" value="{{$division->id}}">{{$division->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group form-group-default">
                                        <label>Gaji</label>
                                        <input id="gaji" type="number" class="form-control" name="gaji" min=0 placeholder="Gaji Karyawan" required>
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
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endif
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
		$('#tblKaryawan-datatables').DataTable({
		});
    })
</script>
@endsection