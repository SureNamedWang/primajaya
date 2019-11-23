@extends('index')
@section('content')

<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Proses Produksi Pesanan ID:{{$id}}</h1>
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
                            @if($user->admin!='User')
                            <th scope="col">Karyawan</th>
                            @endif
                            <th scope="col">Waktu Mulai</th>
                            <th scope="col">Foto Awal</th>
                            <th scope="col">Waktu Selesai</th>
                            <th scope="col">Foto Akhir</th>
                            <th scope="col">Detail Kegiatan</th>
                            <th scope="col">Total Barang Jadi</th>
                            @if($user->admin!='User')
                                <th scope="col">Edit Produksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $produksi)
                        <tr>
                            @if($user->admin!='User')
                            <td>{{$produksi->produksiKaryawan->nama}}</td>
                            @endif
                            <td>{{$produksi->waktu_mulai}}</td>
                            <td>
                                <img src="{{asset('storage/'.$produksi->foto_awal)}}" style="height: 50px;width: 50px;">
                            </td>
                            <td>{{$produksi->waktu_selesai}}</td>
                            <td>
                                @if($produksi->foto_akhir!=null)
                                <img src="{{asset('storage/'.$produksi->foto_akhir)}}" style="height: 50px;width: 50px;">
                                @else
                                <i class="fa fa-window-minimize"></i>
                                @endif
                            </td>
                            <td>{{$produksi->detail_kegiatan}}</td>
                            <td>{{$produksi->jumlah}}</td>
                            @if($order->status=="Produksi")
                            <td><button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modalEditProduksi{{$produksi->id}}">Edit</button></td>
                            @else
                            <td>{{"Produksi Dihentikan"}}</td>
                            @endif
                            <div class="modal" id="modalEditProduksi{{$produksi->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Masukkan Detail Produksi</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>
                                          <!-- Modal body -->
                                          <form method="post" action="{{route('produksi.update', ['id' => $produksi->id])}}" enctype="multipart/form-data">
                                            {{method_field('PATCH')}}
                                            {{csrf_field()}}
                                            <div class="modal-body">
                                                <div class="form-group col-sm-12">
                                                    <input type="hidden" name="OrderID" value="{{$id}}">
                                                    <input type="hidden" name="idBarang" value="{{$idBrg}}">
                                                    <input type="hidden" name="admin" value="{{$user->id}}">
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <div class="form-label-group">
                                                        <select class="form-control" name="karyawan" required>
                                                            <option value="">Pilih Karyawan</option>
                                                            @foreach ($karyawan as $pekerja)
                                                            @if($pekerja->id==$produksi->id_karyawan)
                                                            <option value="{{$pekerja->id}}" selected>{{$pekerja->nama}}</option>
                                                            @else
                                                            <option value="{{$pekerja->id}}">{{$pekerja->nama}}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                        <label for="karyawan">Karyawan</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <div class="form-label-group">
                                                        <input type="datetime-local" name="waktu_awal" value="{{Carbon\Carbon::parse($produksi->waktu_mulai)->format('Y-m-d\\TH:i')}}">
                                                        <label for="waktu">Jam Mulai</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <div class="form-label-group">
                                                        <input type="datetime-local" name="waktu_akhir" value="{{Carbon\Carbon::parse($produksi->waktu_selesai)->format('Y-m-d\\TH:i')}}">
                                                        <label for="waktu">Jam Selesai</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <div class="form-label-group">
                                                        <h6>Detail Kegiatan</h6>
                                                        <textarea name="detail" cols="50" rows="5">{{$produksi->detail_kegiatan}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <div class="form-label-group">
                                                    <input type="number" name="progress" min="0" max="{{$jumBarang->jumlah}}" value="{{$produksi->jumlah}}" required>
                                                        <label for="progress">Jumlah Barang Jadi</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <h6 style="bolder">Upload Foto Awal:</h6>
                                                    <input class="input-group-btn" type="file" name="fileToUpload" value="{{$produksi->foto_awal}}">
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <h6 style="bolder">Upload Foto Akhir:</h6>
                                                    <input class="input-group-btn" type="file" name="fileToUpload2" value="{{$produksi->foto_akhir}}">
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
                            @if($user->admin!='User'&&$order->status=="Produksi")
                            <td><button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modalInsertProduksi">Upload</button></td>
                            @endif
                            
                        <td><a href="{{route('produksi.show', ['id' => $id])}}" class="btn btn-block btn-info">BACK</a></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<!-- The Modal -->
<div class="modal" id="modalInsertProduksi">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Masukkan Detail Produksi</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <form method="post" action="{{route('produksi.store')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group col-sm-12">
                        <input type="hidden" name="OrderID" value="{{$id}}">
                        <input type="hidden" name="idBarang" value="{{$idBrg}}">
                        <input type="hidden" name="admin" value="{{$user->id}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="form-label-group">
                            <select class="form-control" name="karyawan" required>
                                <option value="">Pilih Karyawan</option>
                                @foreach ($karyawan as $pekerja)
                                <option value="{{$pekerja->id}}">{{$pekerja->departemen}} {{$pekerja->divisi}} {{$pekerja->nama}}</option>
                                @endforeach
                            </select>
                            <label for="karyawan">Karyawan</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="form-label-group">
                            <input type="datetime-local" name="waktu_awal" required>
                            <label for="waktu">Jam Mulai</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="form-label-group">
                            <input type="datetime-local" name="waktu_akhir">
                            <label for="waktu">Jam Selesai</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="form-label-group">
                            <h6>Detail Kegiatan</h6>
                            <textarea name="detail" cols="50" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="form-label-group">
                        <input type="number" name="progress" min="0" max="{{$jumBarang->jumlah}}" required>
                            <label for="progress">Jumlah Barang Jadi</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <h6 style="bolder">Upload Foto Awal:</h6>
                        <input class="input-group-btn" type="file" name="fileToUpload">
                    </div>
                    <div class="form-group col-sm-12">
                        <h6 style="bolder">Upload Foto Akhir:</h6>
                        <input class="input-group-btn" type="file" name="fileToUpload2">
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

@endsection