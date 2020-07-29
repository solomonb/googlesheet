<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
	require  'vendor/autoload.php';
	//Подключение к таблицам гугл
	$googleAccount = "myKey.json";

		putenv('GOOGLE_APPLICATION_CREDENTIALS=' .$googleAccount);
			
		$client = new Google_Client();
			
		$client->useApplicationDefaultCredentials();	

		$client->setScopes('https://www.googleapis.com/auth/spreadsheets');

		$service = new Google_Service_Sheets($client);	  

		$spreadsheetId = '1rcRJPIWhbjiqqywRGeQ7So5bv2fGOV6t6afvmhGYqXc';
		$spreadsheetName = "Лист1!A2:A1000";
		$response = $service->spreadsheets_values->get($spreadsheetId, $spreadsheetName);
		$values = $response->getValues();
		//Создадим в массив все id таблицы New table в гугл таблице
		$arrayId[]="";
		if (empty($values)) {
			print "No data found.";
		} else {
			foreach ($values as $row) {				
				$arrayId[] = $row[0];	
				print_r($arrayId);
			}
		}		
	//Подключение к БД test2
	$host = 'googlesheetapi'; 
	$user = 'root'; 
	$password = ''; 
	$db_name = 'test2';
		
	$link = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));	
	mysqli_query($link, "SET NAMES 'utf8'");
	
	$query = "SELECT *FROM users";		
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
	//Также создадим массив из id таблицы users БД test2
		$valuesID[]="";
		foreach ($data as $elem) {			
			$valuesID[]= $elem['id'];			
			}
	//Сравним данные таблиц из БД и гугл таблиц по созданным ранее массивам id	
	$diff = array_diff($valuesID, $arrayId);	
	
	foreach ($diff as $elem) {			
			$id= $elem;	
			//По отличающимся id выгружаем данные из таблицы users (БД) в таблицу New table (гугл таблицы)
				$query = "SELECT *FROM users WHERE age>18 and id=$id";		
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
					$values=[];
					foreach ($data as $elem) {			
						$values[]= [$elem['id'],$elem['name'],$elem['surname'],$elem['age']];
						}			
					
							$googleAccount = "myKey.json";
							putenv('GOOGLE_APPLICATION_CREDENTIALS=' .$googleAccount);
								
							$client = new Google_Client();
								
							$client->useApplicationDefaultCredentials();	

							$client->setScopes('https://www.googleapis.com/auth/spreadsheets');

							$service = new Google_Service_Sheets($client);	  

							$spreadsheetId = '1rcRJPIWhbjiqqywRGeQ7So5bv2fGOV6t6afvmhGYqXc';
							$spreadsheetName = "Лист1";
							
							$body = new Google_Service_Sheets_ValueRange(["values"=>$values]);
							$options = ["valueInputOption" => "USER_ENTERED"];
							$service->spreadsheets_values->append($spreadsheetId,$spreadsheetName,$body,$options);	
	}
	
	echo 'Ваши данные успешно занесены в гугл таблицу "New table" ';
