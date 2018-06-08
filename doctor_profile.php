<?php 

		require_once "header.php";

 ?>



	<?php 

			if(!$user->logged_in()) {

				redirect::to('login.php');
			}


			$doctor = new Doctor;

			if(!$doctor->exist()) {


				redirect::to('route.php');
			}



			$profile_path = "img/default.jpg";

			if($doctor->profile_check()) {

				$profile_path = "img/".$doctor->get_profile_pic();

				
			} 

			
		

	 ?>



	 <?php 


	 		if(input::exist()) {


	 	

	 			$update = $doctor->update_profile(input::get('file'));

	 			if($update) {

	 				redirect::to('doctor_profile.php');
	 			} 
	 		}

	  ?>

	<div class="container">


		<h1 class="page-header display-4 text-center">Patient Profile</h1>
		

		<div class="profile">
			<div class="face-wrapper">
				
					<div class="face" style="background-image: url(<?php echo $profile_path; ?>);"></div>


					<form action="" method='post' enctype="multipart/form-data">
						<div class="form-group">
						<input type="file" name='file' class="form-control">
						</div>
						<button name='submit' name='submit' class='btn btn-info btn-lg'>Replace</button>
					</form>

			</div>


			<div class="content">
				

				<p class="name">Name: <?php echo $doctor->data()->first_name." ".$doctor->data()->last_name; ?></p>
				<p class="email">Email Address: <?php echo $doctor->data()->email; ?></p>
				<p class="email">Contact: 0<?php echo $doctor->data()->contact; ?></p>
				<p class="specialty">Specialty:	<?php echo $doctor->data()->specialty_name; ?></p>
				<p class="address"> Address: <?php echo $doctor->data()->address; ?></p>

				<a href="edit_doctor_info.php" class='btn btn-lg btn-info'>Edit Profile</a>
			</div>
		</div>

	</div>

 <?php 

 		require_once "footer.php";

  ?>