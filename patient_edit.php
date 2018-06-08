<?php 

require_once "header.php";

?>


<?php 

	 		//check if user has submitted data

if(!$user->logged_in()) {

	redirect::to('login.php');
}


$patient = new Patient();

if(!$patient->exist()) {

	redirect::to('login.php');
}




 			//checkk if user has submitted data

if(input::exist()) {


	$fields = array(

		'first_name' => input::get('first_name'),
		'last_name' => input::get('last_name'),
		'contact' => input::get('contact'),
		'address' => input::get('address')

	);

	$update = $patient->update_info($fields);

	if($update) {

		redirect::to('patient_profile.php');
	} else {

		?>

		<p class="error">There was a problem saving changes. Check all fields</p>

		<?php 
	}
}

?>

<div class="container">


	<h1 class="page-header display-5 text-center"> Edit Profile</h1>

	<form action="" method="post" class="main-form bordered"s>

		<div class="form-group">

			<label for="first_name">First Name</label>
			<input type="text" name='first_name' placeholder='Frist Name' value = "<?php echo $patient->data()->first_name; ?>" class='form-control'>
		</div>

		<div class="form-group">

			<label for="last_name">Last Name</label>
		<input type="text" name='last_name' placeholder="Last Name" value= "<?php echo $patient->data()->last_name; ?>" class='form-control'>

		</div>


		<div class="form-group">
			<label for="contact">Contact</label>
		<input type="number" name="contact" placeholder="Contact" value = "0<?php echo $patient->data()->contact; ?>" class='form-control'>

		</div>

		<div class="form-group">

			<label for="address">Address</label>
		<input type="text" name="address" placeholder='address' value= "<?php echo $patient->data()->address; ?>" class="form-control">

		</div>

		<div class="form-group">
			
		<button  class="btn btn-lg btn-info"type='submit' name='submit'>Save Changes</button>
		</div>
	</form>
</div>


<?php 

require_once "footer.php";

?>