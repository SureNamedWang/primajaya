@extends('index')
@section('content')

@if($user->admin!='User')
@if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
@if (Session::has('alert'))
<div class="alert alert-danger">{{ Session::get('alert') }}</div>
@endif
<div class="form-group col-sm-12">
    <form method="post" action="{{route('storeBahan')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$id}}">
        <div class="card">
          <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h5>Ukuran</h5>
                    <select class="form-control" name="ukuran">
                        <option value="">Pilih Ukuran</option>
                        @foreach ($barang->ukuranProduct as $ukuran)
                        @foreach($ukuran->hargaUkuran as $harga)
                        <option value="{{$harga->id}}">{{$ukuran->Masterukuran->ukuran}} {{$harga->hargaTipe->nama}}</option>
                        @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    {{-- <button class="btn btn-block btn-info mb-3" type="button" id="btnTambah">Tambah Tipe Ukuran</button> --}}
                </div>
            </div>
        </div>
        <div class="card-body">
            <input type="hidden" name="asal" value="tambahUkuran">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Bahan</th>
                            <th scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">

                        <tr id="tableRow">
                            <td>
                                <div class="form-group col-sm-12">
                                    <div class="form-label-group">
                                        <select class="form-control" name="bahan">
                                            <option value="">Pilih Bahan</option>
                                            @foreach ($bahans as $bahan)
                                            <option value="{{$bahan->id}}">{{$bahan->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </td>
                            <td>
                                <div class="form-group col-sm-12">
                                    <div class="form-label-group">
                                        <input type="number" name="jumlah" required>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <div class="form-group col-sm-12">
                    <input type="submit" class="btn btn-block btn-danger" name="submit" value="submit">
                </div>

            </div>
        </div>
    </div>
</form>
</div>

{{-- <script type="text/javascript">
    $('#btnTambah').on('click', function(){
        $( "#tableRow" ).clone().appendTo('tbody')
    })
</script> --}}

@endif
@endsection