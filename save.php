<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
	
	$host = 'googlesheetapi'; 
	$user = 'root'; 
	$password = ''; 
	$db_name = 'test2';
	
	
	if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['age'])){
		$name=$_POST['name'];
		$surname=$_POST['surname'];
		$age=$_POST['age'];	
		
		$link = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));	
		mysqli_query($link, "SET NAMES 'utf8'");
		$query = "INSERT INTO users SET name = '$name', surname= '$surname', age= '$age'";							
		mysqli_query($link,$query);
		
		echo 'Ваши данные успешно занесены в БД';
	} else echo 'Не заполнено какое-то из полей';
	