<!DOCTYPE html>
<html>
	<head>
		<link rel = "stylesheet" href = "elems/style_ch.css?v10">
		<title>Тест</title>		
	</head>
	<body>	
		<form action="" method="POST" id="form">
			<p>Имя:<br>
			<input type="text" name="name"></p>
			<p>Фамилия:<br>
			<input type="text" name="surname"></p>
			<p>Возраст:<br>
			<input type="text" name="age"></p>
			<p><input type="submit" name = "submit" id="save" value="сохранить"></p>
			<p><input type="button" name = "unload" id="unload" value="выгрузить"></p>
		</form>		
	</body>		
</html>

<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script src="send.js?12"></script>	
<script src="unload.js?12"></script>	