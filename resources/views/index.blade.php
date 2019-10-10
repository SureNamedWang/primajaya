<?php
session_start();
?>
	@include('header')

<body>
	<div class="wrapper">
	@include('navbar')
	@include('sidebar')
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Store</h4>
					</div>
				</div>
				@yield('content')

			</div>
		</div>

	</div>
	@include('footer')
	
</body>

@yield('script')
<script>
		@if (Session::has('message'))
			swal({
				title: "Selamat!",
				text: "{{Session::get('message')}}",
				icon: "success",
			});
		@endif
		@if (Session::has('alert'))
			swal({
				title: "Kesalahan",
				text: "{{ Session::get('alert') }}",
				icon: "error",
			});
			console.log('alertif');
		@endif
	</script>
</html>