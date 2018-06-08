<?php 

require_once "header.php";

?>



<?php 

if(!$user->logged_in()) {

	redirect::to('login.php');
}


$role = $user->data()->role;

if($role != 'patient') {

	redirect::to('route.php');
}




$patient = new Patient();


$visit_left = 0;


if($patient->exist()) {

	$visit_left =  $patient->get_visit_left();
}


$patient_data  = $patient->data();


$profile_path = "img/default.jpg";


if($patient->profile_check()) {

	$profile_path  = 'img/'.$patient->profile_pic();
}





if(input::exist()) {


	$file_name =  File::upload(input::get('file'));


	$update = $patient->update_profile($file_name);

	if($update) {

		redirect::to('patient_profile.php');
	}

}


?>


<div class="container">



	<h1 class="display-5 page-header text-center">Patient Profile</h1>


	<div class="row">

		<div class="col-md-4 offset-md-2">
			
			<div class="face" style="background-image: url(<?php echo $profile_path; ?>)"></div>
			<form action="" method='post' enctype="multipart/form-data">

				<div class="input-group" style="margin-bottom: 20px">
					<input type="file" name='file' class=form-control>

				</div>
				<div class="input-group" >
					<button type="submit" name='submit' class='btn btn-info btn-lg'>update</button>
				</div>
			</form>

		</div>


		<div class="col-md-6">
			
			<div class="content">
				<p class="lead text-capitalize">Name: <?php echo $patient->data()->first_name." ".$patient->data()->last_name; ?></p>
				<p class="text">Email Address: <span><?php echo $patient->data()->email; ?></span></p>
				<p class="email">Address: <?php echo $patient->data()->address; ?></p>
				<p class="contact">Contact: 0<?php echo $patient->data()->contact; ?></p>
				<p class="text">Date of Birth: <?php  echo format_date($patient->data()->dob); ?></p>

				<p class="package">Package: <span><?php echo $patient->data()->package_name; ?></span></p>
				<p class='text'>Visits Left: <span><?php echo $visit_left; ?></span></p>

				<a href="patient_edit.php" class='btn btn-info btn-lg'>Edit Profile</a>
			</div>

		</div>
		
	</div>





</div>
<?php 


require_once "footer.php";


?>