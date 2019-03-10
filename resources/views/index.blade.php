<?php
session_start();
?>
@include('header')
@include('navbar')
@include('sidebar')

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="#">Index</a>
  </li>
  <li class="breadcrumb-item active">Products</li>
</ol>
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