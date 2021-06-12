<!DOCTYPE html>
<html>
	<head>
		<title>Chat Room</title>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		 <meta name="description" content="">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="icon" type="image/ico" href="image/icon.png">
		<style type="text/css">
			body {
			  	background: white;
			}
			img {   
			   	left: 45%;
			   	position: absolute;
			   	top: 40%;
			}
			@media only screen and (max-width: 360px) {
			  	img {		   
				  	left: 35%;
				  	position: absolute;
				  	top: 40%;
				}
			}
		</style>
	</head>
	<body onload="myFunction()">
		<div id="loader">
			<img class="preloader" src="image/loader.gif">		
		</div>
		<script>
			var myVar;

			function myFunction() {
			  myVar = setTimeout(showPage,8000);
			}

			function showPage() {
			  window.open("login.php","_self");
			}
		</script>
	</body>
</html>