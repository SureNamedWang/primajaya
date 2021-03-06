@extends('index')
@section('content')

<div class="container">

	<div class="card">
		<div class="row">
			<aside class="col-sm-5">
				<article class="gallery-wrap"> 
					<div class="img-big-wrap">
						<div>
							<img src="{{asset('storage/'.$products->gambarProduct->where('thumbnail', 1)->first()->gambar)}}" class="w-100 m-0 p-0" id="bigwrap">
						</div>
					</div> <!-- slider-product.// -->
					<div class="img-small-wrap">
						@foreach ($products->gambarProduct as $gbr)
						<div class="item-gallery"> <img src="{{asset('storage/'.$gbr->gambar)}}" class="gbk"></div>
						@endforeach
					</div> <!-- slider-nav.// -->
				</article> <!-- gallery-wrap .end// -->
				<article class="card-body p-5">
					<dl class="item-property">
						<dt>Deskripsi Produk</dt>
						<dd style="text-align: justify;">{{$products->detail}}</dd>
					</dl>
				</article>
			</aside>
			<aside class="col-sm-7">
				<article class="card-body p-5">
					<h2 class="title mb-3 bold text-center">
						{{ucwords($products->nama)}}
					</h2>
					<hr>
					<h6 style="font-weight: bolder;">Harga </h6>
					<span class="price h3 text-danger">
						<span class="currency">IDR </span><span class="num" id="dispHarga">{{number_format($products->hargaUkuranProduct->first()->harga)}}</span>
					</span>
					<hr>
					<!-- price-detail-wrap .// -->
					<form action="{{route('cart.store')}}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<input type="hidden" name="idBarang" value="{{$products->id}}">
							<div class="form-group col-sm-12">
								<header style="font-weight: bolder;">Jumlah</header>
								<div class="form-label-group">
									<input type="number" min="1" max="100" step="1" onchange="hitungHarga()" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" required="required" value="1" >
								</div>
							</div>
							<div class="form-group col-sm-12 center">
								<header style="font-weight: bolder;">Pilih Ukuran</header>
								<select onchange="hitungHarga()" id="hUkuran" class="form-control" name="ukuran">
									<option data-techname="0" value="">Ukuran</option>
									@foreach ($products->hargaUkuranProduct as $harga)
									<option data-techname="{{$harga->harga}}" value="{{$harga->id}}">
										{{$harga->hargaUkuran->MasterUkuran->ukuran}} - {{$harga->hargaTipe->nama}} - IDR.{{number_format($harga->harga)}}
									</option>
									@endforeach
								</select>
							</div>
							@if(count($products->addonKainProduct)>=1)
							<div class="form-group col-sm-12 center">
								<header style="font-weight: bolder">Material Kain</header>
							</div>
							<div class="form-group col-sm-12 center">
								@foreach ($products->addonKainProduct as $kain)
								<div class="form-check">
									<label class="form-check-label" for="radio{{$kain->id}}">
										<input type="radio" onchange="hitungHarga()" data-techname="{{$kain->harga}}" class="form-check-input" id="radioKain" name="rdoAddonKain" value="{{$kain->id}}">
										{{ucwords($kain->nama)}} - IDR.{{number_format($kain->harga)}}
									</label>
								</div>
								@endforeach
							</div>
							@endif
							<hr>
							@if(count($products->addonLogoProduct)>=1)
							<div class="form-group col-sm-12 center">
								<header style="font-weight: bolder">Logo</header>
								@foreach ($products->addonLogoProduct as $logo)
								<div class="form-check">
									<input type="radio" onchange="hitungHarga()" data-techname="{{$logo->harga}}" class="form-check-input" id="checkLogo" name="cbkLogo" value="{{$logo->id}}">
									<label class="form-check-label" for="checkLogo{{$logo->id}}">
										{{ucwords($logo->nama)}} - IDR.{{number_format($logo->harga)}}
									</label>
								</div>
								@endforeach
							</div>
							
							<div class="input-file input-file-image mx-auto">
									<img class="img-upload-preview" width="150" src="http://placehold.it/150x150" alt="preview">
									<input type="file" class="form-control form-control-file" id="uploadImg" name="fileToUpload" accept="image/*">
									<label for="uploadImg" class=" label-input-file btn btn-primary">Upload an Image</label>
							</div>
							@endif
							<hr>
							<div class="form-group col-sm-12 center">
								<button type="submit" class="btn btn-block btn-lg btn-outline-primary text-uppercase">
									<i class="fas fa-shopping-cart"></i>
									Tambah ke Keranjang
								</button>
							</div>
						</div> <!-- row.// -->
					</form>
				</article> <!-- card-body.// -->
			</aside> <!-- col.// -->
		</div> <!-- row.// -->
	</div> <!-- card.// -->


</div>
<!--container.//-->
@endsection

@section('script')
<script>
	$(".gbk").hover(
		function() {
			let gbr = $(this).attr('src');
			console.log(gbr);
			$("#bigwrap").attr("src",gbr);
		}
		);
	$('.gbk').mouseleave(
		function(){
			let gbr = "{{asset('storage/'.$products->gambarProduct->where('thumbnail', 1)->first()->gambar)}}";
			console.log(gbr);
			$("#bigwrap").attr("src",gbr);
		});
	function hitungHarga(){
		let vUkuran=0;
		let vKain=0;
		let vLogo=0;
		let vJumlah=0;
		vUkuran=$('#hUkuran').find(':selected').attr('data-techname');
		vKain=$("#radioKain:checked").attr('data-techname');
		vLogo=$('#checkLogo:checked').attr('data-techname');
		vJumlah=$('#jumlah').val();
		if(vUkuran==undefined){
			vUkuran=0;
		}
		if(vKain==undefined){
			vKain=0;
		}
		if(vLogo==undefined){
			vLogo=0;
		}
		let total=parseInt(vUkuran)+parseInt(vKain)+parseInt(vLogo);
		total=total*vJumlah;
		total=total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		//alert('ukuran:'+vUkuran+' Kain:'+vKain+' Logo:'+vLogo+' Total:'+total);
		$('#dispHarga').html(total);
		//number_format(total,0,',','.')
	}
	</script>
	@endsection