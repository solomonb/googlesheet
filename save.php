<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
	
	$host = 'googlesheetapi'; 
	$user = 'root'; 
	$password = ''; 
	$db_name = 'test2';	
	
	$link = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));	
		if (!$link) {
			printf("Не удалось подключиться: %s\n", mysqli_connect_error());
			exit();
		}
	
	if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['age'])){			
		
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$age = $_POST['age'];
		
		if(preg_match("#[a-zA-Zа-яёА-ЯЁ]+$#u",$name)){
			if(preg_match("#[a-zA-Zа-яёА-ЯЁ]+$#u",$surname)){
				if(preg_match("#[0-9]+$#",$age)){
													
					$stmt = mysqli_prepare($link, "INSERT INTO users (name, surname, age) VALUES (?, ?, ?)");
					mysqli_stmt_bind_param($stmt, 'ssi', $name, $surname, $age);
											
					mysqli_stmt_execute($stmt);		
					
					echo 'Ваши данные успешно занесены в БД';
					mysqli_stmt_close($stmt);
					mysqli_close($link);
					
				}else echo 'Поле Возраст может содержать только цифры';
			}else echo 'Поле Фамилия может содержать только буквы';
		}else echo 'Поле Имя может содержать только буквы';
		
	} else echo 'Не заполнено какое-то из полей';
	