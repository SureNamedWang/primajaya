@extends('index')
@section('content')

<!-- #Category 1 -->
<div class="card mb-3">
	<div class="card-body">
		<div class="row">
			@foreach ($products as $product)

			<div class="col-xl-4 col-sm-12 mb-3">
				<a href="{{route('catalogue.show', ['id' => $product->id])}}">
					<div class="card card-post card-round">
						<img class="card-img-top" 
						src="{{asset('storage/'.$product->gambarProduct->where('thumbnail', 1)->first()->gambar)}}"
						alt="Card image cap"
						style="height: 200px;object-fit: cover">
						<div class="card-body">
							<div class="d-flex">
								<div class="info-post ml-2">
									<p class="username">{{ucwords($product->nama)}}</p>
									<p class="date text-muted">Rp.
										{{ number_format($product->hargaUkuranProduct->first()->harga,0,',','.')}}
									</p>
								</div>
							</div>
							<div class="separator-solid"></div>
							<p class="card-text">
								<?php
									echo (substr($product->detail,0,75).'...');
								?>
							</p>
							<a href="{{route('catalogue.show', ['id' => $product->id])}}"
								class="btn btn-primary btn-rounded btn-sm mt-2 float-right">Read More</a>
						</div>
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

@endsection