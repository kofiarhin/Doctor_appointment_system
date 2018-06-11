<?php 
	
	require_once "../core/init.php";

	/*
	$fields = array (

		'first_name' => input::get('first_name'),
		'last_name' => input::get('last_name'),
		'email' => input::get('email'),
		'password' => input::get('password')

	);


	*/


	$fields = array(

		'first_name' => array(

			'required' => true

		),

		'last_name' => array(

			'required' => true

		),

		'password' => array(

			'required' => true

		),

		'email' => array(

			'required' => true
		)

	);



	$validation = new Validation();

	$check = $validation->check($_POST, $fields);

	if($check->passed()) {

		echo "proces registration";
		
	} else {

		foreach($check->errors() as $error) {

			echo $error, "<br>";

		}
	}