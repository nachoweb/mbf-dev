<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>My Buy Friends</title>
	<!--
	*** Estos dos links son para descomentar en producción *** -->
	<!--<script src="js/build/buildapp.js"></script> -->
	<!--<LINK REL=StyleSheet href="gss/build/buildcss.css" TYPE="text/css" MEDIA=screen>-->

	<!-- *** Link para desarrollo, js y css compilados con plovr *** -->
	<script src="http://localhost:9810/compile?id=mbf"></script>
	<LINK REL=StyleSheet HREF="http://localhost:9810/css/mbf/" TYPE="text/css" MEDIA=screen>
</head>
<!-- En la carga de la página se ejecuta bootstrap que está en app.js para inicializar la aplicación y sus componentes -->
<body onload="mbf.bootstrap()">

<div id="container">
	<h1>Welcome to My Buy Friends!</h1>

	<div id="body">
		
	</div>

	<p class="footer">Página cargada en <strong>{elapsed_time}</strong> segundos</p>
</div>

</body>
</html>
