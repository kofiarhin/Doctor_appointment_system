<?php 

	require_once "header.php";

 ?>


		<h1 class="display-4 page-header text-center">Patient Profile</h1>

		<?php 

				if(!$user->logged_in()) {

					redirect::to('login.php');
				}


				if(!$user_id  = input::get('user_id')) {

					redirect::to("route.php");
				}


				$patient = new Patient($user_id);

				if($patient->exist()) {

					//var_dump($patient);

					?>

				
						<div class="profile">
							

								<?php 

										$profile_path = "img/default.jpg";

										if($patient->exist()) {

											$patient_data = $patient->data();


											$patient_name  = $patient_data->first_name." ".$patient_data->last_name;

											$package_name = $patient_data->package_name;

											$package_expiry = format_date($patient_data->expiry);
											$email  = $patient_data->email;

											$gender = $patient_data->gender;

											$contact = $patient_data->contact;

											$address = $patient_data->address;

											$dob = format_date($patient_data->dob);


											$visit_left = $patient_data->package_visit - $patient_data->patient_visit;

											//setting the profie path

											$profile_pic = $patient->patient_picture();

											$profile_path = "img/".$profile_pic;


										}

								 ?>

								<div class="face" style='background-image: url(<?php echo $profile_path; ?>)'></div>

								<div class="content">
									
									<p class="lead text-capitalize">Name: <?php echo $patient_name;?></p>
									<p class="email">Email: <?php echo $email; ?></p>
									<p class="contact">Contact: 0<?php echo $contact; ?></p>
									<p class="address">Address: <?php echo $address?></p>
									<p class="dob">Date of Birth: <?php echo $dob; ?></p>

									<p>Package Name: <?php echo $package_name; ?></p>

									<p>Package Expiry: <?php echo $package_expiry; ?></p>

									<p>Visits Left: <?php echo $visit_left; ?></p>

									<a href="delete_user.php?user_id=<?php echo $user_id; ?>" class='link'>Delete</a>

								</div>


						</div>



					<?php
				}

		 ?>

 <?php 


 	require_once "footer.php";

  ?>