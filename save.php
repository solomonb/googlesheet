<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
	
	$host = 'googlesheetapi'; 
	$user = 'root'; 
	$password = ''; 
	$db_name = 'test2';	
	
	if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['age'])){			
		
		$link = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));	
		if (!$link) {
			printf("Не удалось подключиться: %s\n", mysqli_connect_error());
			exit();
		}
				
		$stmt = mysqli_prepare($link, "INSERT INTO users (name, surname, age) VALUES (?, ?, ?)");
		mysqli_stmt_bind_param($stmt, 'ssi', $name, $surname, $age);

		$name=$_POST['name'];
		$surname=$_POST['surname'];
		$age=$_POST['age'];	
						
		mysqli_stmt_execute($stmt);		
		
		echo 'Ваши данные успешно занесены в БД';
		mysqli_stmt_close($stmt);
		mysqli_close($link);
		
	} else echo 'Не заполнено какое-то из полей';
	