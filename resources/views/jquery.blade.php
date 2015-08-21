<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>jQuery</title>
	<script src="/js/jquery/jquery.min.js"></script>
</head>
<body>
	<h1>jQuery testing</h1>
	<p></p>
	<script>
		$(document).ready(function() {
			$.post('{{ URL::to("itembyid/3") }}', {}, function(data){console.log(data)});
			$.post('{{ URL::to("itembyname/陳靜婉") }}', {}, function(data){console.log(data)});
			$.post('{{ URL::to("itembylatlng/22.757419580292/121.15435723029") }}', {}, function(data){console.log(data)});
			$.post('{{ URL::to("itemsincircle/22.757419580292/121.15435723029/5") }}', {}, function(data){console.log(data)});
		})
	</script>
</body>
</html>