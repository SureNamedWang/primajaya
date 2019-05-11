@extends('index')
@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="#">Index</a>
	</li>
	<li class="breadcrumb-item active">Products</li>
</ol>
<!-- #Category 1 -->
<div class="card mb-3">
	<div class="card-header" style="font-weight: bold; font-size: 25px ;background-color: beige">
		TENDA
	</div>
	<div class="card-body">
		<div class="row">
			@foreach ($products as $product)

			<div class="col-xl-4 col-sm-6 mb-3">
				<a href="{{route('catalogue.show', ['id' => $product->id])}}">
					<div class="w3-container">
						<!-- <form id="{{$product->id}}" action="{{route('catalogue.show', ['id' => $product->id])}}" method="GET"> -->
							<h6 style="font-weight: bolder">{{ucwords($product->nama)}}</h6>
							<div class="w3-card-4">
								<img src="{{$product->gambarProduct->where('thumbnail', 1)->first()->gambar}}" alt="Norway" style="width:100%">
								<div class="w3-container w3-center" style="height: 80px">
									<?php
									echo (substr($product->detail,0,75).'...');
									?>								
								</div>
								<footer class="w3-container w3-red">
									<h6>Start from:</h6>
									<h5 class="w3-center">Rp. {{ number_format($product->hargaUkuranProduct->first()->harga,0,',','.')}}</h5>
								</footer>
							</div>
							<input type="hidden" name="idBarang" value="{{$product->id}}">
							<!-- </form> -->
						</div>
					</a>
				</div>
				
				@endforeach
			</div>
			<!-- /#row -->
		</div>
		<!-- /#card body -->
	</div>
	<!-- /#card -->
	<!-- /#Category 1 -->

	<!-- #Category 2 -->
	<div class="card mb-3">
		<div class="card-header" style="font-weight: bold; font-size: 25px ;background-color: lightcyan">
			NEON
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-xl-4 col-sm-6 mb-3">
					<div class="w3-container">
						<h2>Photo Card</h2>
						<div class="w3-card-4">
							<img src="la.jpg" alt="Norway" style="width:100%">
							<div class="w3-container w3-center">
								<p>The Italian / Austrian Alps</p>
							</div>
							<footer class="w3-container w3-red">
								<h5>Footer</h5>
							</footer>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-sm-6 mb-3">
					<div class="w3-container">
						<h2>Photo Card</h2>

						<div class="w3-card-4">
							<img src="la.jpg" alt="Norway" style="width:100%">
							<div class="w3-container w3-center">
								<p>The Italian / Austrian Alps</p>
							</div>
							<footer class="w3-container w3-red">
								<h5>Footer</h5>
							</footer>
						</div>
					</div>
				</div>
			</div>
			<!-- /#row -->
		</div>
		<!-- /#card body -->
	</div>
	<!-- /#card -->
	<!-- /#Category 2 -->

	@endsection