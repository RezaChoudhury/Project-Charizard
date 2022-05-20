<?php
session_start();
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
require_once('connect.php');
    if(empty($_POST['loginUser'])){ $errors[]= ""; echo json_encode(['errors' => 'Please enter a username/email.']);}
    if(empty($_POST['loginPassword'])){ $errors[]= ""; echo json_encode(['errors' => 'Please enter your password.']);}
    if(empty($errors)){
		//checks login info
			$loginSql = "SELECT * FROM users WHERE ";
			if(filter_var($_POST['loginUser'], FILTER_VALIDATE_EMAIL)){
				$loginSql .="email=?";
			}else{
				$loginSql .="username=?";
			}
			$loginResult = $db->prepare($loginSql);
			$loginResult->execute(array($_POST['loginUser']));
			$loginCount = $loginResult->rowCount();
			$loginRes = $loginResult->fetch(PDO::FETCH_ASSOC);
			if ($loginCount == 1){
				if(password_verify($_POST['loginPassword'], $loginRes['password'])){
					// regenerate session id
					session_regenerate_id();
					$_SESSION['login'] = true;
					$_SESSION['id'] = $loginRes['id'];
					$_SESSION['last_login'] = time();
					
					//redirect to members page
                    echo json_encode(['id' => "${_SESSION['id']}"]);
				
				}else{
					echo json_encode(['errors' => 'Incorrect email and/or password.']);
				}
			}else{
				echo json_encode(['errors' => 'This user does not exist.']);
			}
						
	}
?>