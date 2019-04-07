<?php
session_start();
?>
@include('header')
@include('navbar')
@include('sidebar')
@yield('content')
@yield('script')
<script type="text/javascript">

	function formSubmit(clicked_id){
		var x=clicked_id;
		document.getElementById(x).submit();// Form submission
	}
	
</script>

@include('footer')
@include('defaultfunction')