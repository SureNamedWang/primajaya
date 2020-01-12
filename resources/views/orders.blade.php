@extends('index')
@section('content')
@if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">List Order</h1>
    </div>
</section>

<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table id="tblOrders-datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Opsi</th>
                            <th scope="col">OrderID</th>
                            @if($user->admin!='User')
                            <th scope="col">Pembeli</th>
                            @endif
                            <th scope="col">Tanggal Beli</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Biaya Kirim</th>
                            <th scope="col">Total</th>
                            <th scope="col">DP Minimal</th>
                            <th scope="col">Total Di Bayar</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Opsi
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{route('pembayaran.update', ['id' => $item->id])}}">Pembayaran</a>
                                        @if($user->admin!='Admin')
                                        <a class="dropdown-item" href="{{route('cart.show', ['id' => $item->id])}}">Detail Order</a>
                                        @endif
                                        @if($item->dp<=$item->total_pembayaran&&$item->status!="Selesai")
                                        <a class="dropdown-item" href="{{route('produksi.show', ['id' => $item->id])}}">Produksi</a>
                                        @endif
                                        @if($item->status!="Pending"&&$item->status!="Produksi")
                                        <a class="dropdown-item" data-toggle="modal" data-target="#myModal{{$item->id}}">Pengiriman</a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{$item->id}}</td>
                            @if($user->admin!='User')
                            <td>{{$item->OrdersUsers->name}}</td>
                            @endif
                            <td>{{$item->created_at}}</td>
                            <td>Rp. {{number_format($item->subtotal)}}</td>
                            <td>Rp. {{number_format($item->biaya_kirim)}}</td>
                            <td>Rp. {{number_format($item->total)}}</td>
                            <td>Rp. {{number_format($item->dp)}}</td>
                            <td>Rp. {{number_format($item->total_pembayaran)}}</td>
                            <td>{{$item->status}}</td>
                                <!-- The Modal -->
                                <div class="modal" id="myModal{{$item->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Detail Pengiriman</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <form method="post" action="{{ route('orders.update', ['id' => $item->id]) }}" enctype="multipart/form-data">
                                            {{method_field('PATCH')}}
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="form-group col-sm-12">
                                                    <div class="form-label-group">
                                                        <label for="nama">Nama</label>
                                                        <input type="text" class="form-control" id="nama" name="nama" value={{$item->OrdersUsers->name}} disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group col-sm-12">
                                                    <div class="form-label-group">
                                                        <label for="address">Alamat</label>
                                                        <input type="text" class="form-control" id="address" name="address" value={{$item->OrdersUsers->alamat}} disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group col-sm-12">
                                                    <div class="form-label-group">
                                                        <label for="cp">Telepon</label>
                                                        <input type="text" class="form-control" id="cp" name="cp" value={{$item->OrdersUsers->telp}} disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group col-sm-12">
                                                    <div class="form-label-group">
                                                        <label for="pengirim">Jasa Pengiriman</label>
                                                        <select class="form-control" 
                                                        name="pengirim" 
                                                        required 
                                                        @if($user->admin=="User") disabled @endif 
                                                            @if(isset($item->ordersPengiriman->pengirim)&&$item->ordersPengiriman->pengirim!="CV.Prima Jaya Tenda")
                                                            @if($item->biaya_kirim>0&&$item->total==$item->total_pembayaran) 
                                                            disabled 
                                                            @endif 
                                                            @elseif(isset($item->ordersPengiriman->pengirim)&&$item->ordersPengiriman->pengirim=="CV.Prima Jaya Tenda")
                                                            @if($item->total==$item->total_pembayaran)
                                                            disabled
                                                            @endif
                                                            @endif
                                                            >
                                                            <option value="">Pilih Jasa Pengiriman</option>
                                                            <option value="CV.Prima Jaya Tenda" @if(isset($item->ordersPengiriman->pengirim)&&$item->ordersPengiriman->pengirim=="CV.Prima Jaya Tenda") selected @endif>CV.Prima Jaya Tenda</option>
                                                            <option value="Tiki" @if(isset($item->ordersPengiriman->pengirim)&&$item->ordersPengiriman->pengirim=="Tiki") selected @endif>Tiki</option>
                                                            <option value="JNE" @if(isset($item->ordersPengiriman->pengirim)&&$item->ordersPengiriman->pengirim=="JNE") selected @endif>JNE</option>
                                                            <option value="Pos" @if(isset($item->ordersPengiriman->pengirim)&&$item->ordersPengiriman->pengirim=="Pos") selected @endif>Pos</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label>Estimasi Waktu Sampai(Dalam Hari)</label>
                                                        <input class="form-control" 
                                                        type="number" 
                                                        min=1 
                                                        name="eta" 
                                                        @if(isset($item->ordersPengiriman->eta)&&$item->ordersPengiriman->eta!=null) 
                                                        value="{{$item->ordersPengiriman->eta}}" 
                                                        @endif 
                                                        @if($user->admin=="User") 
                                                        disabled 
                                                        @endif
                                                        @if(isset($item->ordersPengiriman->pengirim)&&$item->ordersPengiriman->pengirim!="CV.Prima Jaya Tenda")
                                                        @if($item->biaya_kirim>0&&$item->total==$item->total_pembayaran) 
                                                        disabled 
                                                        @endif 
                                                        @elseif(isset($item->ordersPengiriman->pengirim)&&$item->ordersPengiriman->pengirim=="CV.Prima Jaya Tenda")
                                                        @if($item->total==$item->total_pembayaran)
                                                        disabled
                                                        @endif
                                                        @endif
                                                        >  
                                                    </div>
                                                </div>

                                                <div class="form-group col-sm-12">
                                                    <div class="form-label-group">                
                                                        <input type="number" 
                                                        name="biaya" 
                                                        min=0 
                                                        value={{$item->biaya_kirim}} 
                                                        @if($user->admin=="User") 
                                                        disabled 
                                                        @endif 
                                                        @if(isset($item->ordersPengiriman->pengirim)&&$item->ordersPengiriman->pengirim!="CV.Prima Jaya Tenda")
                                                        @if($item->biaya_kirim>0&&$item->total==$item->total_pembayaran) 
                                                        disabled 
                                                        @endif 
                                                        @elseif(isset($item->ordersPengiriman->pengirim)&&$item->ordersPengiriman->pengirim=="CV.Prima Jaya Tenda")
                                                        @if($item->total==$item->total_pembayaran)
                                                        disabled
                                                        @endif
                                                        @endif
                                                        required>
                                                        <label for="biaya">Biaya Kirim</label>
                                                    </div>
                                                </div>
                                                <hr>
                                                
                                                @if(isset($item->ordersPengiriman->pengirim)&&$item->ordersPengiriman->pengirim!="CV.Prima Jaya Tenda")
                                                @if($item->biaya_kirim>0&&$item->total==$item->total_pembayaran) 
                                                    <div class="form-group col-sm-12">
                                                        <div class="form-label-group">                
                                                            <input class="form-control" type="text" name="kode" 
                                                            @if(isset($item->ordersPengiriman->kode)&&$item->ordersPengiriman->kode!=null) 
                                                            value="{{$item->ordersPengiriman->kode}}" 
                                                            @endif
                                                            @if(isset($item->ordersPengiriman->bukti_pengiriman))
                                                            disabled
                                                            @endif
                                                            @if($user->admin=="User") disabled @endif
                                                            >
                                                            <label for="kode">Kode Ekspedisi/Nomor Surat Jalan</label>
                                                        </div>
                                                    </div>
                                                    @if($user->admin!="User"&&$item->status!="Selesai")
                                                    @if($item->status=="Menunggu Pelunasan Pembayaran")
                                                    <div class="input-file input-file-image mx-auto">
                                                        Surat Jalan/Ekspedisi
                                                        <img class="img-upload-preview" width="150" src="http://placehold.it/150x150" alt="preview">
                                                        <input type="file" class="form-control form-control-file" id="uploadImg" name="buktiPengiriman" accept="image/*">
                                                        <label for="uploadImg" class=" label-input-file btn btn-primary">Upload Gambar</label>
                                                        <br>
                                                        <label for="uploadImg" class="form-check-label">(format file jpg/jpeg/png)</label>
                                                    </div>
                                                    @endif
                                                    @if($item->status=="Pengiriman")
                                                    <div class="input-file input-file-image mx-auto">
                                                        Bukti Penerimaan
                                                        <img class="img-upload-preview" width="150" src="http://placehold.it/150x150" alt="preview">
                                                        <input type="file" class="form-control form-control-file" id="uploadImg" name="buktiPenerimaan" accept="image/*">
                                                        <label for="uploadImg" class=" label-input-file btn btn-primary">Upload Gambar</label>
                                                        <br>
                                                        <label for="uploadImg" class="form-check-label">(format file jpg/jpeg/png)</label>
                                                    </div>
                                                    @endif
                                                    @else
                                                    @if(isset($item->ordersPengiriman->bukti_pengiriman))
                                                    <div class="form-group col-sm-12">
                                                        Bukti Pengiriman
                                                        <div class="form-label-group">
                                                            <img src="{{asset('storage/'.$item->ordersPengiriman->bukti_pengiriman)}}" style="height: 300px;width: 300px;" />
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if(isset($item->ordersPengiriman->bukti_penerimaan))
                                                    <div class="form-group col-sm-12">
                                                        Bukti Penerimaan
                                                        <div class="form-label-group">
                                                            <img src="{{asset('storage/'.$item->ordersPengiriman->bukti_penerimaan)}}" style="height: 300px;width: 300px;" />
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @endif
                                                @endif 
                                                @elseif(isset($item->ordersPengiriman->pengirim)&&$item->ordersPengiriman->pengirim=="CV.Prima Jaya Tenda")
                                                @if($item->total==$item->total_pembayaran)
                                                    <div class="form-group col-sm-12">
                                                        <div class="form-label-group">                
                                                            <input class="form-control" type="text" name="kode" @if(isset($item->ordersPengiriman->kode)&&$item->ordersPengiriman->kode!=null) value="{{$item->ordersPengiriman->kode}}" @endif @if($user->admin=="User") disabled @endif>
                                                            <label for="kode">Kode Ekspedisi/Nomor Surat Jalan</label>
                                                        </div>
                                                    </div>
                                                    @if($user->admin!="User")
                                                    @if($item->status!="Menunggu Pelunasan Pembayaran")
                                                    <div class="input-file input-file-image mx-auto">
                                                        Surat Jalan/Ekspedisi
                                                        <img class="img-upload-preview" width="150" src="http://placehold.it/150x150" alt="preview">
                                                        <input type="file" class="form-control form-control-file" id="uploadImg" name="buktiPengiriman" accept="image/*">
                                                        <label for="uploadImg" class=" label-input-file btn btn-primary">Upload Gambar</label>
                                                        <br>
                                                        <label for="uploadImg" class="form-check-label">(format file jpg/jpeg/png)</label>
                                                    </div>
                                                    @endif
                                                    @if($item->status!="Pengiriman")
                                                    <div class="input-file input-file-image mx-auto">
                                                        Bukti Penerimaan
                                                        <img class="img-upload-preview" width="150" src="http://placehold.it/150x150" alt="preview">
                                                        <input type="file" class="form-control form-control-file" id="uploadImg" name="buktiPenerimaan" accept="image/*">
                                                        <label for="uploadImg" class=" label-input-file btn btn-primary">Upload Gambar</label>
                                                        <br>
                                                        <label for="uploadImg" class="form-check-label">(format file jpg/jpeg/png)</label>
                                                    </div>
                                                    @endif
                                                    @endif
                                                @endif
                                                @endif
                                                
                                                
                                            </div>
                                            @if($user->admin=="Admin")
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-info" value="Upload "></button>

                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                            </div>
                                            @endif
                                            </form>
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

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
		$('#tblOrders-datatables').DataTable({
		});
    })
</script>
@endsection