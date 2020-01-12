@extends('index')
@section('content')

@if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

@if($user->admin!='User')
<div class="container">
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <div class="card">
              <div class="card-header">
                Form Tambah Barang
            </div>
            <div class="card-body">
                <form method="post" action="{{route('storeBarang')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="asal" value="tambahBarang">
                    <div class="form-group col-sm-12">
                        <div class="form-label-group">
                            <input type="text" class="w-100" name="nama" required>
                            <label for="nama">Nama</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="form-label-group">
                            <h6>Detail</h6>
                            <textarea name="detail" class="w-100" cols="25" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <h6>Gambar</h6>
                        <input class="input-group-btn" class="w-100" type="file" name="fileToUpload" required>
                    </div>
                    <div class="form-group col-sm-12">
                        <select class="form-control" name="ukuran" required>
                            <option value="">Pilih Ukuran</option>
                            @foreach ($ukuran as $ukuran)
                            <option value="{{$ukuran->id}}">{{$ukuran->ukuran}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-12">
                        <select class="form-control" name="tipe" required>
                            <option value="">Pilih Tipe</option>
                            @foreach ($tipe as $tipe)
                            <option value="{{$tipe->id}}">{{$tipe->nama}}</option>
                            @endforeach
                        </select> 
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="form-label-group">
                            <input type="text" name="harga" required>
                            <label for="harga">Harga</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <input type="submit" class="btn btn-block btn-danger" name="submit" value="submit">
                    </div>
                </form>  
            </div>
        </div>

    </div>
    <div class="col-sm-2">
    </div>
</div>
</div>

@endif
@endsection