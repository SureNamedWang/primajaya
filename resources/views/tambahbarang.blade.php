@extends('index')
@section('content')

@if($user->admin==1)
<div class="container">
    <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4">
            <div class="card">
              <div class="card-header">
                Form Tambah Barang
            </div>
            <div class="card-body" style="">
                <form method="post" action="{{route('barang.store')}}" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="form-group col-sm-12">
                        <div class="form-label-group">
                            <input type="text" name="nama" required>
                            <label for="nama">Nama</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="form-label-group">
                            <h6>Detail</h6>
                            <textarea name="detail" cols="25" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <h6>Gambar</h6>
                        <input class="input-group-btn" type="file" name="fileToUpload">
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="form-label-group">
                            <input type="text" name="ukuran" required>
                            <label for="ukuran">Ukuran</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="form-label-group">
                            <input type="text" name="harga" required>
                            <label for="harga">Harga</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="form-label-group">
                            <input type="text" name="type" required>
                            <label for="type">Type(Komplit/Rangka/Kain)</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <input type="submit" name="upload" class="btn btn-block btn-info" value="Tambah">
                    </div>
                </form>  
            </div>
        </div>

    </div>
    <div class="col-sm-4">
    </div>
</div>
</div>

@endif
@endsection