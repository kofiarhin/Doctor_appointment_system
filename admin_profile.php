<?php 



require_once "header.php";


if(!$user->logged_in()) {

	redirect::to('login.php');
}


if(input::exist()) {

	$fields = array(
		'email' => input::get('email'),
		'current_password' => input::get('current_password'),
		'new_password' => input::get('new_password')

	);

	$update = $user->update_admin($fields);

	if($update) {

		redirect::to('route.php');
	} else {

		?>
		
		<p class="error">There was a problem updating profile</p>


		<?php 
	}
}
?>


<h1 class="display-4 page-header text-center">Edit Admin Profile</h1>

<form action="" class="main-form bordered" method='post'>

	<div class="form-group">

		<label for="email">Email</label>

		<input type="text" name='email' disabled value = "<?php echo $user->data()->email; ?>" class="form-control">

	</div>


	<div class="form-group">

		<label for="current_password">Current Password</label>

		<input type="text" name = "current_password" placeholder="Current Password" class='form-control'>

	</div>

	<div class="form-group">

		<label for="new_password">New Password</label>

		<input type="text" name="new_password" placeholder="New Password" class='form-control'>

	</div>


	<button type='submit' name='submit' class='btn btn-primary btn-block btn-lg'>Save Changes</button>
</form>

<?php 


require_once "footer.php";


?>