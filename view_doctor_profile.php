<?php 

		require_once "header.php";

 ?>


	<?php 

			if($role !='admin') {

				redirect::to("login.php");
			}


			$doctor_id = input::get('doctor_id');


			$doctor = new Doctor($doctor_id);

			//var_dump($doctor);


			if($doctor->exist()) {


					//var_dump($doctor->data());

				?>

			<h1 class="display-4 page-header text-center">Doctor Profile</h1>
				
				<div class="profile">
					

					<?php 
							//profile check

							$profile_path = "img/default.jpg";

							if($doctor->profile_check()) {

								$profile_pic = $doctor->get_profile_pic();

								$profile_path = "img/".$profile_pic;
							}

					 ?>
					<div class="face" style='background-image: url(<?php echo $profile_path; ?>)'></div>

					<div class="content">
						<p class="lead">Name: <?php echo $doctor->data()->first_name." ".$doctor->data()->last_name; ?></p>

						<p class="specialty text">Specialty: <?php echo $doctor->data()->specialty_name; ?></p>
						<p class='email'>Email: <?php echo $doctor->data()->email; ?></p>
						<p>Contact: 0<?php echo $doctor->data()->contact; ?></p>

						<p>Address: <?php echo $doctor->data()->address; ?></p>

						<p style="margin-bottom: 20px">Date of Birth: <?php echo format_date($doctor->data()->dob); ?></p>

						<a href="delete_user.php?user_id=<?php echo $doctor->data()->user_id; ?>" class="btn btn-primary btn-lg" style="margin-bottom: 20px" >Delete User</a>
					</div>
				</div>




				<?php 
			}

	 ?>

 <?php 


 		require_once "footer.php";

  ?>