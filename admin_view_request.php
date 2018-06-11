<?php 


require_once "header.php";


?>



<?php 


$request_id = input::get('request_id');


echo $request_id;
$request = new Request($request_id);


//var_dump($request);
$appointment = new Appointment;

//var_dump($request->data());


/*

if(!$request->exist()) {

	redirect::to('admin_dashboard.php');
}


*/


$patient_id = $request->data()->patient_id;


$patient = new Patient($patient_id);

$profile_path = "img/default.jpg";


if($patient->exist()) {


	$profile_pic = $patient->patient_picture();

	$profile_path = "img/".$profile_pic;
}

?>

<div class="container">

	<h1 class="title">Admin - View Request</h1>


	<div class="request-unit">


		<?php 

				//set the profile picture

		

		?>


		<?php 


		 			//check if assignment


		if(input::exist('post', 'asign')) {





			$fields = array(


				'doctor_id' => input::get("doctor_id"),
				'request_id' => input::get('request_id')

			);

			$assignment  = $appointment->assign($fields);

			if($assignment) {

				redirect::to('request_dashboard.php');
			} else {

				?>

				<p class="error">There was a problem assigning to doctor please try again</p>


				<?php
			}


		}

		?>

		
		<div class="face" style='background-image: url(<?php echo $profile_path; ?>);'></div>


		<div class="content">


			<form action="" method='post' class='awesome-form'>

				


				<?php 

													//check status if status  == 1 asssign to doctor who is available


				$status = $request->data()->request_status;


				if($status == 1) {


					$specialty = $request->data()->specialty_id;






					$doctors = $user->get_doctor($specialty);

					if($doctors) {


						?>

						<label for="">Assign to: </label>
						<select name="doctor_id" id="">

							<?php 

							foreach($doctors as $doctor) {


								?>


								<option value="<?php echo $doctor->doctor_id; ?>">Dr <?php echo $doctor->first_name." ".$doctor->last_name; ?></option>

								<?php
							}


							?>

						</select>


						<button type='submit' name='asign'>Assign</button>


						<?php

					} else {


							$specialist = $user->specialties($specialty);


							?>

							<label>There are no <?php echo $specialist; ?> in the system</label>

							<?php 
					}


				} else {


					$assignment = $appointment->get_assignment(input::get('request_id'));

					if($assignment) {


						
						?>


						<label class="text">Assigned To: <a href="view_doctor_profile.php?doctor_id=<?php echo $assignment->doctor_id; ?>">Dr <?php echo $assignment->first_name." ".$assignment->last_name; ?></a> </label>

						<?php 
					}
				}

				?>




				<label for="complaint">Complaint</label>	
				<textarea  disabled name="" id="" cols="30" rows="10"> <?php echo $request->data()->complaint; ?></textarea>

				<label for="related symptoms">Related Symptoms</label>



				<textarea name="related symptoms" disabled id="" cols="30" rows="10"><?php echo $request->data()->related_symptoms; ?></textarea>


				<label for="medical-file"><a href="view_file.php?file_name"> View Medical File</a></label>

			</form>


		</div>


	</div>

</div>

<?php 


require_once "footer.php";

?>