@extends('index')
@section('content')
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">List Gambar {{$idBarang}}</h1>
    </div>
</section>
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="container">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 mb-3 text-center">
                <div class="w3-container mb-3">
                    <h3 style="font-weight: bolder">Thumbnail Saat Ini</h3>
                    <div class="w3-card-12">
                        <img src="{{asset('storage/'.$gambar->where('thumbnail', 1)->first()->gambar)}}" alt="thumbnail" style="width:150px;height: 150px">
                    </div>
                </div>
            </div>
        </div>
        <h4 style="font-weight: bolder">Pilih Thumbnail Baru</h4>
        <div class="row">
            @foreach ($gambar as $gbr)
            <div class="form-group col-xl-3 col-sm-6 mb-3">
                <div class="form-check">
                    <label class="form-check-label" for="radio{{$gbr->id}}">
                        @if($gbr->thumbnail==1)
                        <input type="radio" data-techname="{{$gbr->gambar}}" class="form-check-input" id="radio{{$gbr->id}}" name="rdoAddonKain" value="{{$gbr->id}}" checked>
                        @else
                        <input type="radio" data-techname="{{$gbr->gambar}}" class="form-check-input" id="radio{{$gbr->id}}" name="rdoAddonKain" value="{{$gbr->id}}">
                        @endif
                        <div class="w3-container">
                            <div class="w3-card-4">
                                <img src="{{asset('storage/'.$gbr->gambar)}}" alt="Norway" style="width:150px;height: 150px">
                            </div>
                        </div>
                    </label>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    @endsection