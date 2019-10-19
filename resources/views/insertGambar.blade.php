@extends('index')
@section('content')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">List Gambar {{$idBarang}}</h1>
    </div>
</section>
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
@if (Session::has('alert'))
<div class="alert alert-danger">{{ Session::get('alert') }}</div>
@endif
<div class="container">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <h3 style="font-weight: bolder">Upload Gambar Baru</h3>
                <form action="{{route('storeGambar')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="idBarang" value="{{$idBarang}}">
                    <div class="input-file input-file-image mx-auto">
                        <img class="img-upload-preview" width="150" src="http://placehold.it/150x150" alt="preview">
                        <input type="file" class="form-control form-control-file" id="uploadImg" name="fileToUpload" accept="image/*">
                        <label for="uploadImg" class=" label-input-file btn btn-primary">Pilih File</label>
                        <br>
                        <label for="uploadImg" class="form-check-label">(format file jpg/jpeg/png)</label>
                    </div>
                    <input type="submit" class="btn btn-block btn-primary pl-2 pr-2" name="submit" value="Upload Gambar">
                </form>
            </div>
            <div class="col-sm-6 mb-3 text-center">
                <div class="w3-container mb-3">
                    <h3 style="font-weight: bolder">Thumbnail Saat Ini</h3>
                    <div class="w3-card-12">
                        <img src="{{asset('storage/'.$gambar->where('thumbnail', 1)->first()->gambar)}}" alt="thumbnail" style="width:150px;height: 150px">
                    </div>
                </div>
            </div>
        </div>
        <h4 style="font-weight: bolder">Pilih Gambar</h4>
        
        <form action="{{route('editGambar')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="row">
                    @foreach ($gambar as $gbr)
                    <div class="form-group col-xl-3 col-sm-6 mb-3">
                        <div class="form-check">
                            <label class="form-check-label" for="radio{{$gbr->id}}">
                                @if($gbr->thumbnail==1)
                                <input type="radio" data-techname="{{$gbr->gambar}}" class="form-check-input" id="radio{{$gbr->id}}" name="rdoGambar" value="{{$gbr->id}}" checked>
                                @else
                                <input type="radio" data-techname="{{$gbr->gambar}}" class="form-check-input" id="radio{{$gbr->id}}" name="rdoGambar" value="{{$gbr->id}}">
                                @endif
                                <div class="w3-container">
                                    <div class="w3-card-4">
                                        <img src="{{asset('storage/'.$gbr->gambar)}}" alt="Gambar{{$gbr->id}}" style="width:150px;height: 150px">
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    @endforeach
                    
                
            </div>
            <input type="hidden" name="idBarang" value="{{$idBarang}}">
            <input type="submit" class="btn btn-block btn-primary" name="pilihThumbnail" value="Pilih Thumbnail">
            <input type="submit" class="btn btn-block btn-danger" name="hapusGambar" value="Hapus Gambar">
        </form>
    </div>


    @endsection