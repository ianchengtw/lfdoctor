<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>jQuery</title>
	<script src="/js/jquery/jquery.min.js"></script>
</head>
<body>
	<h1>jQuery testing</h1>
	<script>
		$(document).ready(function() {
			$.post("http://homestead.app/itembyid/3", {}, function(data){console.log(data)});
			$.post("http://homestead.app/itembyname/陳靜婉", {}, function(data){console.log(data)});
			$.post("http://homestead.app/itembylatlng/22.757419580292/121.15435723029", {}, function(data){console.log(data)});
			$.post("http://homestead.app/itemsincircle/22.757419580292/121.15435723029/5", {}, function(data){console.log(data)});
		})
	</script>
</body>
</html>