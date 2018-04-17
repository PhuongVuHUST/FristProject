<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php $khoahoc = array('php','asp','ios');?>
	{{-- @if(!empty($khoahoc))
		@foreach($khoahoc as $value)
		{{ $value }}
		@endforeach
	@else
	{{ "Mang Rong" }}
	@endif --}}

	@forelse($khoahoc as $value)
		@continue($value== "laravel");
		{{ $value }}
	@empty
	{{ "Mang Rong" }}
	@endforelse
</body>
</html>