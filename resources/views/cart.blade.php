@extends('index')
@section('content')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Keranjang Belanja</h1>
    </div>
</section>

<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Barang</th>
                            <th scope="col">Ukuran</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Desain</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $totalHarga=0;
                        @endphp
                        @foreach ($cart as $item)
                        <tr>
                            <td><img src="{{asset('storage/'.$item->keranjangProducts->gambarProduct->where('thumbnail', 1)->first()->gambar)}}" style="height: 50px;width: 50px;" /> </td>
                            <td>{{$item->keranjangProducts->nama}}</td>
                            <td>{{$item->keranjangHarga->hargaUkuran->MasterUkuran->ukuran}}</td>
                            <td>
                                @if(isset($item->id_logo))
                                <i class="fa fa-check"></i>
                                @else
                                <i class="fa fa-window-minimize"></i>
                                @endif
                            </td>
                            <td>
                                @if(isset($item->desain))
                                <img src="{{asset('storage/'.$item->desain)}}" style="height: 50px;width: 50px;">
                                @else
                                <i class="fa fa-window-minimize"></i>
                                @endif
                            </td>
                            <td>{{$item->jumlah}}</td>
                            @isset($id)
                            @else
                            <td>Rp. {{number_format($item->harga)}}</td>
                            @endisset
                            <td>Rp. {{number_format(($item->keranjangHarga->harga)*$item->jumlah)}}</td>
                            {{-- @endif --}}
                            
                            @isset($id)
                            @else
                            <td>
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalEdit{{$item->id}}">
                                    Edit
                                </button>
                                <div class="modal" id="modalEdit{{$item->id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
    
                                            <!-- Modal body -->
                                            <form action="{{route('editKeranjang')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                                <div class="row ml-0 mr-0 pr-4 pl-4">
                                                    <input type="hidden" name="idKeranjang" value="{{$item->id}}">
                                                    <div class="form-group col-sm-12">
                                                        <header style="font-weight: bolder;">Jumlah</header>
                                                        <div class="form-label-group">
                                                            <input type="number" min="1" max="100" step="1" 
                                                            onchange="hitungHarga()" id="jumlah" name="jumlah" class="form-control" 
                                                            placeholder="Jumlah" required value="{{$item->jumlah}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-12 center">
                                                        <header style="font-weight: bolder;">Pilih Ukuran</header>
                                                        <select onchange="hitungHarga()" id="hUkuran" class="form-control" name="ukuran">
                                                            @foreach ($item->KeranjangProducts->hargaUkuranProduct as $harga)
                                                            @if($harga->id==$item->id_produk)
                                                            <option data-techname="{{$harga->harga}}" value="{{$harga->id}}" selected>
                                                            @else
                                                            <option data-techname="{{$harga->harga}}" value="{{$harga->id}}">
                                                            @endif
                                                                {{$harga->hargaUkuran->MasterUkuran->ukuran}} - {{$harga->hargaTipe->nama}} - IDR.{{number_format($harga->harga)}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <hr>
                                                    @if(count($item->KeranjangProducts->addonLogoProduct)>=1)
                                                    <div class="form-group col-sm-12 center">
                                                        <header style="font-weight: bolder">Addon</header>
                                                        <div class="form-check">
                                                            @if($item->id_logo==null||$item->id_logo==0)
                                                            <input type="radio" onchange="hitungHarga()" data-techname="0" class="form-check-input" id="checkLogo" name="cbkLogo" value="0" checked>
                                                            @else
                                                            <input type="radio" onchange="hitungHarga()" data-techname="0" class="form-check-input" id="checkLogo" name="cbkLogo" value="0">
                                                            @endif
                                                            <label class="form-check-label" for="checkLogo0">
                                                                {{ucwords('Tanpa Addon')}} - IDR.{{number_format(0)}}
                                                            </label>
                                                        </div>
                                                        @foreach ($item->KeranjangProducts->addonLogoProduct as $logo)
                                                        <div class="form-check">
                                                            @if($logo->id==$item->id_logo)
                                                            <input type="radio" onchange="hitungHarga()" data-techname="{{$logo->harga}}" class="form-check-input" id="checkLogo" name="cbkLogo" value="{{$logo->id}}" checked>
                                                            @else
                                                            <input type="radio" onchange="hitungHarga()" data-techname="{{$logo->harga}}" class="form-check-input" id="checkLogo" name="cbkLogo" value="{{$logo->id}}">
                                                            @endif
                                                            <label class="form-check-label" for="checkLogo{{$logo->id}}">
                                                                {{ucwords($logo->nama)}} - IDR.{{number_format($logo->harga)}}
                                                            </label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    
                                                    <div class="input-file input-file-image mx-auto">
                                                            
                                                            @if(isset($item->desain))
                                                            <img class="img-upload-preview" width="150" src="{{asset('storage/'.$item->desain)}}" alt="preview">
                                                            @else
                                                            <img class="img-upload-preview" width="150" src="http://placehold.it/150x150" alt="preview">
                                                            @endif
                                                            <input type="file" class="form-control form-control-file" id="uploadImg" name="fileToUpload" accept="image/*">
                                                            <label for="uploadImg" class=" label-input-file btn btn-primary">Upload new Image</label>
                                                            <br>
                                                            <label for="uploadImg" class="form-check-label">(format file jpg/jpeg/png)</label>
                                                            
                                                    </div>
                                                    @endif
                                                    <hr>
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
                            <td class="text-right">
                                <form action="{{route('cart.destroy', ['id' => $item->id])}}" method="post">
                                    {{method_field('DELETE')}}
                                    {{csrf_field()}}
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            @endisset
                        </tr>
                        @php
                        $totalHarga=$totalHarga+$item->total_harga;
                        @endphp
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Sub-Total</strong></td>
                            <td><strong>Rp. {{number_format($totalHarga)}}</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td><strong>Rp. {{number_format($totalHarga)}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                @isset($id)
                <div class="col-sm-12  col-md-6">
                    <a href="{{ url('/orders') }}">
                        <button class="btn btn-block btn-danger">Back</button>
                    </a>
                </div>
                
                @else
                <div class="col-sm-12  col-md-6">
                    <a href="{{ url('/catalogue') }}">
                        <button class="btn btn-block btn-danger">Continue Shopping</button>
                    </a>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <form method="post" action="{{ route('cart.update', ['id' => '0'])}}">
                        {{method_field('PATCH')}}
                        {{csrf_field()}}
                        <input type="hidden" name="subtotal" value="{{$totalHarga}}">
                        <input type="submit" class="btn btn-block btn-success" value="Check Out">
                    </form>
                </div>
                @endisset
            </div>
        </div>
    </div>
</div>
@endsection