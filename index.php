<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Formulario Básico de Registro</title>
</head>
<body>
	<div id="content">
		<form id="form">
			<label>Nombre
				<input class="required" type="text" name="name" id="name" placeholder="NOMBRE">	
			</label><br>
			<label>E-mail
				<input class="required email" type="text" name="email" id="email" placeholder="E-MAIL">
			</label><br>
			<label>Empresa
				<input class="required" type="text" name="company" id="company" placeholder="EMPRESA">
			</label><br>
			<input class="enviar" type="submit" name="eviar" value="ENVIAR">
		</form>
	</div>
	<div id="scripts">
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="js/messages_es.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
	</div>
</body>
</html>