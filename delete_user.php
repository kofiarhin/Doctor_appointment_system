<?php 


	require_once "core/init.php";


	$user = new User;

	$delete = $user->delete(input::get('user_id'));

	if($delete) {

		session::flash('delete', 'User has been successfully deleted');
		redirect::to("route.php");
	}


