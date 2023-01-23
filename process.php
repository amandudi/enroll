<?php
	session_start();
	include('db/DBModel.php');

	if(isset($_POST) && !empty($_POST) && $_POST['enroll'] == 'Enroll'){	// === This block can further be modified / copied for other functionalities in future
		
		$errors = array();
		if(!validate_phone($_POST['phone'])){
			array_push($errors, 'Please enter a valid phone number.');
		}
		if(!validate_email($_POST['email'])){
			array_push($errors, 'Please enter a valid Email.');
		}
	
		if(!empty($errors)){
			$_SESSION['enroll']['status'] = 'error';
			$_SESSION['enroll']['data'] = $_POST;
			$_SESSION['enroll']['errors'] = $errors;
		}else{
			$enroll_result = $db_obj -> enroll($_POST);
			if($enroll_result !== true){
				$_SESSION['enroll']['status'] = 'error';
				$_SESSION['enroll']['data'] = $_POST;
				$_SESSION['enroll']['errors'] = $enroll_result;
			}else{
				$_SESSION['enroll']['status'] = 'success';
			}
		}
		header('location:enroll');
	}

	/* server side validation for phone number */
	function validate_phone($phone){
		if(preg_match('/^[0-9]{10}+$/', $phone)) {
			return true;
		}
		return false;
	}

	/* server side validation for EMAIL */
	function validate_email($email){
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}
?>