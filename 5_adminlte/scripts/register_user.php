<?php
//print_r($_POST);
function sanitizeInput($input){
		$input = htmlentities(stripslashes(trim($input)));
		return $input;
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		session_start();
		//print_r($_POST);
		$requiredFields = ["firstName", "lastName", "email", "confirm_email", "pass", "confirm_pass", "birthday", "city_id"];

		$errors = [];
		foreach ($requiredFields as $key => $value){
			//echo "$key: $value<br>";
			if (empty($_POST[$value])){
				//echo "$value<br>";
				$errors[] = "Pole <b>$value</b> jest wymagane";
			}
		}

		if ($_POST["email"] != $_POST["confirm_email"])
			$errors[] = "Adresy email muszą być identyczne";

		if ($_POST["additional_email"] != $_POST["additional_confirm_email"])
			$errors[] = "Dodatkowe adresy email muszą być identyczne";

		if ($_POST["pass"] != $_POST["confirm_pass"])
			$errors[] = "Hasła muszą być identyczne";

		if (!isset($_POST["terms"]))
			$errors[] = "Zatwierdź regulamin";

		if (!empty($errors)){
			print_r($errors);
			echo "test: ".$errors[0];
			//print_r($errors);
			//$_SESSION['error_message'] = implode(", ", $errors);
			$_SESSION['error_message'] = implode("<br>", $errors);
			//echo $_SESSION['error_message'];
			echo "<script>history.back();</script>";
			exit();
		}

		/*
		foreach ($requiredFields as $value){
			//echo $_POST[$value]." ==> ";
			${$value} = sanitizeInput($_POST[$value]);
			//echo $firstName."<br>";
		}*/

		//echo $firstName;

		foreach ($_POST as $key => $value){
			//echo $_POST[$value]." ==> ";
			${$key} = sanitizeInput($value);
			//echo $firstName."<br>";
		}
		//echo $firstName;
		require_once "./connect.php";

		try{
			$stmt = $conn->prepare("INSERT INTO `users` (`city_id`, `email`, `additional_email`, `firstName`, `lastName`, `birthday`, `password`) VALUES (?, ?, ?, ?, ?, ?, ?)");

			$pass = password_hash($pass, PASSWORD_ARGON2ID);
			$stmt->bind_param("issssss", $city_id, $email, $additional_email, $firstName, $lastName, $birthday, $pass);
			if ($stmt->execute()){
				$_SESSION["success"] = "Prawidłowo dodano użytkownika $firstName $lastName";
				header("location: ../pages/view");
				exit();
			}

		} catch(mysqli_sql_exception $e){
			$_SESSION["error_message"] = "Error: ".$e->getMessage();
			echo "<script>history.back();</script>";
			exit();
		}

	}else{
		header("location: ../pages/view/register.php");
	}
