<?php 

require_once "header.php";

?>


<?php 





?>


<section id="register">

	<div class="container">

		<div id="result"></div>

		<h1 class="display-5 text-center  page-header">Create An Account</h1>


		<?php 

		//check if there are any errors

		if(input::exist()) {


			$validation = new Validation();

			$fields = array(


				'first_name' => array(

					'required' => true,
					'min' => 3

				),


				'last_name' => array(

					'required' => true,
					'min' => 2
				),

				'email' => array(


					'required' => true

				),


				'password' => array(

					'required' => true
				),


				'contact' => array(

					'required' => true,
					'min' =>  10

				)

			);



			$check = $validation->check($_POST, $fields);

			if($check->passed()) {


				$patient = new Patient;

				$fields = array(

					'first_name' => input::get('first_name'),
					'last_name' => input::get('last_name'),
					'email' => input::get('email'),
					'password' => input::get('password'),
					'contact' => input::get('contact'),
					'address' => input::get('address'),
					'dob' => input::get('dob'),
					'gender' => input::get('gender'),
					'joined' => date('Y-m-d H:i:s'),
					'profile_status' => 0

				);

				$account = $patient->create_account($fields);

				if($account) {

					redirect::to('login.php');
				}


			} else {


				foreach($check->errors() as $error) {

					?>

					<p class="error"><?php echo $error; ?></p>

					<?php 
				}
			}



		}

		?>


		<form action="" method='post' class='main-form bordered'>


			<div class="form-group">
				<label for="first_name">Name</label>
				<input type="text" name="first_name" id="first_name" placeholder="First Name" value = "<?php echo input::get('first_name') ?>" class='form-control'>

			</div>

			<div class="form-group">
				<label for="last_name">Last Name</label>
				<input type="text" name="last_name" id = "last_name" placeholder="Last Name" value="<?php echo input::Get('last_name') ?>" class='form-control'>
			</div>

			<div class="form-group">

				<label for="email">Email Address</label>
				<input type="email" name='email' placeholder='Email' id='email' value="<?php echo input::get('email') ?>" class='form-control'>

			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name='password' placeholder='Password' id='password' class='form-control' value=<?php echo input::get("password") ?>>

			</div>

			<div class="form-group">

				<label for="dob">Date of Birth</label>
				<input type="date" name='dob' placeholder='Date of Birth' id='dob' value="<?php echo input::get('dob') ?>" class='form-control'>


			</div>


			<div class="form-group">

				<label for="contact">Contact</label>
				<input type="tel" name='contact' placeholder='Contact eg 0508025370' id='contact' value="<?php echo input::get('contact') ?>" class="form-control">
			</div>

			<div class="form-group">
				<label for="address">Address</label>
				<input type="text" name='address' placeholder='Address eg Dansoman, Accra' id='address' value="<?php echo input::get('address') ?>" class='form-control'>

			</div>



			<div class="form-group">

				<label for="gender">Gender</label>
				<select name="gender" id="" class='form-control'>

					<option value="male">Male</option>
					<option value="female">Female</option>
				</select>

			</div>

			<button type='submit' name='submit' class='btn btn-primary btn-lg'>Register</button> <span>Or</span> <a href="login.php" class='btn btn-default'>Login</a>

		</form>

	</div>
</section>




<?php 

require_once "footer.php";

?>