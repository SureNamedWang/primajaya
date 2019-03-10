@extends('index')
@section('content')
<!-- #Produk -->
<!-- <div class="card mb-3">
	<div class="card-header" style="font-weight: bold; font-size: 25px ;text-align: center;background-color: beige">
		{{$products->nama}}
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-xl-4 col-sm-6 mb-3" style="align-items: center;">
				<img id="gbr" src="{{asset($products->gambar)}}" alt="Norway" style="width:100%; border-color: burlywood">
				<div class="row" style="margin: auto;">
					<div class="col-xl-3 col-sm-6 mb-3" style="padding-left: 0px; padding-right: 0px;padding-top: 0px;padding-bottom: 0px; border-style: solid; border-color: burlywood; cursor: pointer;">
						<img id="gbr" src="{{asset('la.jpg')}}" alt="Norway" style="width:100%; margin: auto;">
					</div>
					<div class="col-xl-3 col-sm-6 mb-3" style="padding-left: 0px; padding-right: 0px;padding-top: 0px;padding-bottom: 0px; border-style: solid; border-color: burlywood; cursor: pointer;">
						<img id="gbr" src="{{asset('ny.jpg')}}" alt="Norway" style="width:100%; margin: auto;">
					</div>
					<div class="col-xl-3 col-sm-6 mb-3" style="padding-left: 0px; padding-right: 0px;padding-top: 0px;padding-bottom: 0px; border-style: solid; border-color: burlywood; cursor: pointer;">
						<img id="gbr" src="{{asset('chicago.jpg')}}" alt="Norway" style="width:100%; margin: auto;">
					</div>
					<div class="col-xl-3 col-sm-6 mb-3" style="padding-left: 0px; padding-right: 0px;padding-top: 0px;padding-bottom: 0px; border-style: solid; border-color: burlywood; cursor: pointer;">
						<img id="gbr" src="{{asset('ny.jpg')}}" alt="Norway" style="width:100%; margin: auto;">
					</div>
					<div class="col-xl-3 col-sm-6 mb-3" style="padding-left: 0px; padding-right: 0px;padding-top: 0px;padding-bottom: 0px; border-style: solid; border-color: burlywood; cursor: pointer;">
						<img id="gbr" src="{{asset('chicago.jpg')}}" alt="Norway" style="width:100%; margin: auto;">
					</div>
				</div>
			</div>
			<div class="col-xl-8 col-sm-6 mb-3" style="align-items: center;">
				<div class="card mb-3">
					<div class="card-header" style="font-weight: bold; font-size: 25px ;text-align: center;background-color: violet">
						Rp.{{$products->harga}},00.
					</div>
					<div class="card-body">
						<form action="{{route('keranjang.store')}}" method="post">
							@csrf
							<input type="hidden" name="idBarang" value="{{$products->id}}">
							<div class="form-group">
								<div class="form-label-group">
									<input type="number" min="1" max="100" step="1" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" required="required" value="1" >
									<label for="jumlah">Jumlah</label>
								</div>
							</div>
							<div class="form-group">
								<div class="form-label-group">
									<input type="text" id="catatan" name="catatan" class="form-control" placeholder="Catatan">
									<label for="catatan">Catatan</label>
								</div>
							</div>
							<input type="submit" id="submit" class="btn btn-primary btn-block" value="Tambah Ke Keranjang">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="card mb-3">
			<header class="card mb-3">
				<h3>Deskripsi Barang:</h3>
			</header>
			<p>{{$products->detail}}</p>
		</div>

		<div class="card mb-3">
			<header class="card mb-3">
				<h3>Spesifikasi Barang:</h3>
			</header>
			<p>Ukuran : 10mx5m</p>
			<p>Warna : Putih, Hitam, Coklat</p>
			<p>Bahan : Nilon</p>
		</div>

		<footer class="w3-container w3-blue">
			<h5>Footer</h5>
		</footer>

	</div>
	<!-- /#card body -->
	<!--</div> -->
	<!-- /#Produk -->

	<div class="container">

		<div class="card">
			<div class="row">
				<aside class="col-sm-5">
					<article class="gallery-wrap"> 
						<div class="img-big-wrap">
							<div><img src="{{asset($products->gambar)}}" class="w-100 m-0 p-0" id="bigwrap" "></div>
						</div> <!-- slider-product.// -->
						<div class="img-small-wrap">
							<div class="item-gallery"> <img src="{{asset('ny.jpg')}}" class="gbk"> </div>
							<div class="item-gallery"> <img src="{{asset('la.jpg')}}" class="gbk"> </div>
							<div class="item-gallery"> <img src="{{asset('chicago.jpg')}}" class="gbk"> </div>
						</div> <!-- slider-nav.// -->
					</article> <!-- gallery-wrap .end// -->
				</aside>
				<aside class="col-sm-7">
					<article class="card-body p-5">
						<h2 class="title mb-3 bold text-center">
							{{ucwords($products->nama)}}
						</h2>
						<hr>
							<span class="price h3 text-danger"> 
								<span class="currency">IDR </span><span class="num">{{$products->harga}}</span>
							</span>
						<hr>
						<!-- price-detail-wrap .// -->
						<dl class="item-property">
							<dt>Description</dt>
							<dd>{{$products->detail}}</dd>
						</dl>
						<dl class="param param-feature">
							<dt>Model#</dt>
							<dd>12345611</dd>
						</dl>  <!-- item-property-hor .// -->
						<dl class="param param-feature">
							<dt>Color</dt>
							<dd>Black and white</dd>
						</dl>  <!-- item-property-hor .// -->
						<dl class="param param-feature">
							<dt>Delivery</dt>
							<dd>Russia, USA, and Europe</dd>
						</dl>  <!-- item-property-hor .// -->

						<hr>
						<form action="{{route('keranjang.store')}}" method="post">
							@csrf
							<div class="row">
								<input type="hidden" name="idBarang" value="{{$products->id}}">
								<div class="form-group col-sm-6">
									<div class="form-label-group">
										<input type="number" min="1" max="100" step="1" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" required="required" value="1" >
										<label for="jumlah">Jumlah</label>
									</div>
								</div>
								<div class="form-group col-sm-6">
									<div class="form-label-group">
										<input type="text" id="catatan" name="catatan" class="form-control" placeholder="Catatan">
										<label for="catatan">Catatan</label>
									</div>
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