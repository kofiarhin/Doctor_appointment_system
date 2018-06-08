<?php 


require_once "header.php";


?>


<?php 



		//check  if user has submitted data


if(input::exist()) {

	$validation = new Validation();

	$fields = array(

		'first_name' => array(


			'required' => true,
			'min' => 4

		),

		'last_name' => array(


			'required' => true

		),

		'email' => array(

			'required' => true,
			'unique' => 'login'
		),

		'password' => array(

			'required' => true
		),

		'contact' => array(

			'required' => true,
			'max' => 10

		)

	);

	$check = $validation->check($_POST, $fields);


	if($check->passed()) {



		$doctor = new Doctor();

		$salt = hash::salt(32);
		$password = hash::make(input::get('password'), $salt);

		$fields = array(

			'first_name' => input::get('first_name'),
			'last_name' => input::get('last_name'),
			'email' => input::get('email'),
			'password' => $password,
			'salt' => $salt,
			'address' => input::get('address'),
			'contact' => input::get('contact'),
			'dob' => input::get('dob'),
			'gender' => input::get('gender'),
			'specialty' => input::get('specialty')

		);



		$account = $doctor->create_account($fields);

		if($account) {

			redirect::to('admin_dashboard.php');
		} else {


			?>

			<p class="error">There was a problem creating account</p>


			<?php 
		}


	} else {

		foreach($check->errors() as $error) {

			?>

			<p class="error"><?php echo $error; ?></p>

			<?php 
		}
	}
}
		//get specialties

$specialties = $user->specialties();


?>


<section id='create_doctor'>

	<h1 class="display-4 text-center page-header">Create Doctor Account</h1>

	<form action="" method='post' class='main-form bordered'>

		<div class="form-group">

			<label for="first_name">First Name</label>
			<input type="text" name ="first_name" placeholder="First Name" value="<?php echo input::get('first_name') ?>" class="form-control">
		</div>
		
		<div class="form-group">
			<input type="text" name ="last_name" placeholder="Last Name" value="<?php echo input::get('last_name')?>" class='form-control'>

		</div>

		<div class="form-group">
			<label for="email">Email Address</label>
			<input type="text" name ="email" placeholder="Email Address" value ="<?php echo input::get('email') ?>" class='form-control' class='form-congtrol'>

		</div>
		
		<div class="form-group">

			<label for="password">Password</label>
			<input type="password" name ="password" placeholder="Password..." value = "<?php echo input::get('password') ?>" class='form-control'>

		</div>

		<div class="form-group">
			<label for="address">Address</label>
			<input type="text" name="address" placeholder="Eg, Dansoman, Accra" value ='<?php echo input::get('contact') ?>'  class='form-control'>
			
		</div>


		<div class="form-group">
			
			<label for="dob">Date of Birth</label>
			<input type="date" name="dob" placeholder="Date of Birth" value = "<?php echo input::get('dob') ?>" class='form-control'>
		</div>

		<div class="form-group">
			
			<label for="contact">Contact</label>
			<input type="number" name='contact' placeholder="Contact" value = "<?php echo input::get("contact") ?>" class='form-control'>
		</div>

		<div class="form-group">
			
			<select name="gender" class='form-control'>
				<option value="male">Male</option>
				<option value="female">Female</option>
			</select>
		</div>

		<div class="form-group">
			


			<?php 

			if($specialties) {


				?>

				<select name="specialty" id="" class="form-control">

					<?php 

					foreach($specialties as $specialty) {


						?>


						<option value="<?php echo $specialty->id ?>"><?php echo $specialty->specialty_name; ?></option>

						<?php 
					}

					?>

				</select>	


				<?php 
			}


			?>


		</div>
		<button type='submit' name='submit' class='btn btn-primary btn-lg'>Create Account</button>

	</form>


</section>


<?php 


require_once "footer.php";



?>