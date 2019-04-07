@extends('index')
@section('content')
<div class="container">

	<div class="card">
		<div class="row">
			<aside class="col-sm-5">
				<article class="gallery-wrap"> 
					<div class="img-big-wrap">
						<div><img src="{{asset($products->gambar)}}" class="w-100 m-0 p-0" id="bigwrap" "></div>
					</div> <!-- slider-product.// -->
					<div class="img-small-wrap">
						@foreach ($products->gambarProduct as $gbr)
						<div class="item-gallery"> <img src="{{asset($gbr->gambar)}}" class="gbk"> </div>
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
					<h6 style="font-weight: bolder;">Harga Dasar</h6>
					<span class="price h3 text-danger">
						<span class="currency">IDR </span><span class="num">{{number_format($products->harga)}}</span>
					</span>
					<hr>
					<!-- price-detail-wrap .// -->
					<form action="{{route('cart.store')}}" method="post">
						@csrf
						<div class="row">
							<input type="hidden" name="idBarang" value="{{$products->id}}">
							<div class="form-group col-sm-12">
								<div class="form-label-group">
									<input type="number" min="1" max="100" step="1" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" required="required" value="1" >
									<label for="jumlah">Jumlah</label>
								</div>
							</div>
							<div class="form-group col-sm-12 center">
								<header style="font-weight: bolder;">Pilih Ukuran</header>
								<select class="form-control" name="ukuran">
									<option value="">Ukuran</option>
									@foreach ($products->hargaUkuranProduct as $harga)
									<option value="{{$harga->id}}">{{$harga->hargaUkuran->ukuran}} - {{$harga->nama}} - IDR.{{number_format($harga->harga)}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-sm-12 center">
								<header style="font-weight: bolder">Material Kain</header>
							</div>
							<div class="form-group col-sm-12 center">
								@foreach ($addonKain as $kain)
								<div class="form-check">
									<label class="form-check-label" for="radio{{$kain->id}}">
										<input type="radio" class="form-check-input" id="radio{{$kain->id}}" name="rdoAddonKain" value="{{$kain->id}}">{{ucwords($kain->nama)}} - IDR.{{number_format($kain->harga)}}
									</label>
								</div>
								@endforeach
							</div>
							<hr>
							<div class="form-group col-sm-12 center">
								<header style="font-weight: bolder">Logo</header>
								@foreach ($addonLogo as $logo)
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="checkLogo{{$logo->id}}" name="cbkLogo" value="{{$logo->id}}">
									<label class="form-check-label" for="checkLogo{{$logo->id}}">
										{{ucwords($logo->nama)}} - IDR.{{number_format($logo->harga)}}
									</label>
								</div>
								@endforeach
							</div>
							<div class="form-group col-sm-12 center">
								<header style="font-weight: bolder">Upload Logo</header>
								<input class="input-group-btn" type="file" name="fileToUpload">
							</div>
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
			let gbr = "{{asset($products->gambar)}}";
			console.log(gbr);
			$("#bigwrap").attr("src",gbr);
		});
	</script>
	@endsection