<?php 

	
	require_once "header.php";


 ?>

		<!--====  login Page =======-->

		<section id="login">

		

			<h1 class="display-5 text-center page-header">Login</h1>


			<?php 

					//check user has successfully created account

					if(session::exist('account_created')) {

						?>
							
							<p class="success"><?php echo session::flash('account_created'); ?></p>

						<?php 

					}



			 ?>

			<?php 

					//check if user has submitted a data

					if(input::exist()) {

						$email = input::get('email');
						$password = input::get('password');


		

						$login = $user->login ($email, $password);

						if($login) {

							redirect::to('route.php');
						} else {


							?>

								<p class="error">Invalid username/password combination</p>


							<?php 
						}


					}

			 ?>


			
			<form action="" method='post' class='medium-form bordered'>
				
				<div class="form-group">
					<label for="email">Email Address</label>
					
				<input type="email" name='email' placeholder='Email Address' value = "<?php echo input::get('email') ?>" class='form-control'>
					
				</div>

				<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name='password' placeholder='Password' class='form-control'>
				</div>

					 <button type='submit' name='submit' class='btn btn-primary btn-lg'>Login</button> <span>or</span><a href="register.php" class='btn btn-default btn-lg'>Register</a>
				</form>


		</section>





 <?php 


 		require_once "footer.php";

  ?>