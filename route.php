<?php 


	require_once "header.php";


	if(!$user->logged_in()) {

		redirect::to('login.php');
	}


	$role = $user->data()->role;

	switch ($role) {

		case 'admin':
	 		redirect::to('admin_dashboard.php');
	 		break;
	 	case 'patient':
	 		redirect::to('patient_dashboard.php');
	 		break;
	 	case 'doctor':
	 		redirect::to('doctor_dashboard.php');
	 		break;
	 	default:
	 		
	 		redirect::to('index.php');
	 		break;
	 } 