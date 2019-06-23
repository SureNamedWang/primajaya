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
	@yield('script') {{--
	<script type="text/javascript">
		function formSubmit(clicked_id){
		var x=clicked_id;
		document.getElementById(x).submit();// Form submission
	}
	</script> --}}
	@include('footer')
</body>

</html>