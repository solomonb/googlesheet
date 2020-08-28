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
		$spreadsheetName = "Лист1!A2:D1000";
		
		$requestBody = new Google_Service_Sheets_ClearValuesRequest();
		$response = $service->spreadsheets_values->clear($spreadsheetId, $spreadsheetName, $requestBody);

	//Подключение к БД test2
	
	$host = 'googlesheetapi'; 
	$user = 'root'; 
	$password = ''; 
	$db_name = 'test2';
		
	$link = mysqli_connect($host, $user, $password, $db_name);	
	
	
		if (mysqli_connect_errno()) {
			printf("Не удалось подключиться: %s\n", mysqli_connect_error());
			exit();
		}
			
		if($stmt = mysqli_prepare($link, "SELECT name, surname, age FROM users WHERE age>18")){						
		
			mysqli_stmt_execute($stmt);
			
			mysqli_stmt_bind_result($stmt, $name, $surname, $age);
			$values=[];
			while(mysqli_stmt_fetch($stmt)){				
				$values[]=[$name, $surname, $age];				
			}
			mysqli_stmt_close($stmt);			
		}
		
		mysqli_close($link);		
		
	
	$body = new Google_Service_Sheets_ValueRange(["values"=>$values]);
	$options = ["valueInputOption" => "USER_ENTERED"];
	$service->spreadsheets_values->append($spreadsheetId,$spreadsheetName,$body,$options);	
	
	echo 'Ваши данные успешно занесены в гугл таблицу "New table" ';
