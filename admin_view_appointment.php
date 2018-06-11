<?php 


require_once "header.php";

?>


<?php 



$appointment_id = input::get('appointment_id');



$appointment = new Appointment($appointment_id);



if($appointment->exist()) {

	//var_dump($appointment);

	$appointment_data = $appointment->data();

	$specialty_id = $appointment_data->specialty_id;
	$patient_id  = $appointment->data()->patient_id;
	$doctor_id = $appointment->data()->doctor_id;
	$appointment_id = $appointment_data->appointment_id;



	$appointment_status = $appointment_data->appointment_status;



	$patient = new Patient($patient_id);

	$doctor = new Doctor($doctor_id);

	$request_id = $appointment->data()->request_id;






	$patient_data = $patient->data();

	$doctor_data = $doctor->data();

	//var_dump($patient);

	$patient_pic = $patient->patient_picture();

	$doctor_pic = $doctor->profile_picture();


	$patient_name = $patient->data()->first_name." ".$patient->data()->last_name;
	


	$doctor_name = $doctor->data()->first_name." ".$doctor->data()->last_name;

	$complaint = $appointment->data()->complaint;

	$request_date = format_date($appointment->data()->request_date);



	$request = new Request($request_id);

	$request_data =  $request->data();


	$request_status = $request_data->request_status;




	// if appointment is completed and request status is approved  display the approve payment button

	//requet status 4 = approved
	//appointment status  3  = completed


	


	//echo $appointment_status;

	//echo $request_status;



}



?>


<div class="container">
	

	<h1 class='display-4  text-center page-header'>Appointment Details</h1>

	<div class="appointment-unit">


		<div class="face-wrapper">




				<div class="patient-info">
					<h1 class='info-title'>Patient Info</h1>
					<div class="face" style="background-image: url(img/<?php echo $patient_pic ?>)"></div>
					<p class="lead text-capitalize">Name: <?php echo $patient_name; ?></p>
					<p class="contact">Contact: 0<?php echo $patient_data->contact; ?></p>
					<p>Email: <?php echo $patient_data->email; ?></p>
				</div>

				<div class="doctor-info">
					<h1 class="info-title">Doctor Info</h1>
					<div class="face" style='background-image: url(img/<?php echo $doctor_pic; ?>)'></div>
					<p class="lead">Name: Dr <?php echo $doctor_name; ?></p>
					<p class="contact">0<?php echo $doctor_data->contact; ?></p>
					<p class="specialty"><?php echo $doctor_data->specialty_name; ?></p>
					<p>Email: <?php echo $doctor_data->email; ?></p>
				</div>


		</div>

		<div class="content">
			
			<p class='date'>Request Date: <?php echo $request_date; ?></p>
			
			<p class="text">COMPLAINT</p>
			<textarea name="complaint" disabled class='complaint'><?php echo $complaint; ?></textarea>
			<?php 


				//	check appointment status
				//  check request status
				// if patient approve
				// show the apporve button to make paymen;


			 ?>	



			<?php 

					if($appointment_status == 4 && $request_status == 5) {


							?>

									<a href="approve_payment.php?appointment_id=<?php echo $appointment_id; ?>" class='btn btn-success btn-lg'>Approve Payment</a>

							<?php 

					} else if($appointment_status  == 4 && $request_status == 4) {



						?>

							<p class="btn btn-danger btn-lg">Patient Needs to Approve Appointment</p>



						<?php
					} else if ($appointment_status == 1 && $request_status == 2) {


						?>

							<a href="reassign.php?appointment_id=<?php echo $appointment_id; ?>&&specialty_id=<?php echo $specialty_id; ?>" class='btn btn-primary btn-lg'>Reassign</a>

						<?php 
					}

			 ?>	


			<?php 


			 ?>
		</div>


	</div>

</div>
<?php 



require_once "footer.php";



?>