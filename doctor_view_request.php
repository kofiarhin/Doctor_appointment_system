<?php 


require_once "header.php";

?>



<?php 


				//check if user is logged in

if(!$user->logged_in()) {

	redirect::to('index.php');
}




if(!$request_id = input::get('request_id')) {

	redirect::to('route.php');
}



$request = new Request($request_id);

//var_dump($request);

//var_dump($request);



$profile_path = "img/default.jpg";




$patient = new Patient($request->data()->patient_id);


if($patient->exist()) {

	$patient_data = $patient->data();

	$patient_name = $patient_data->first_name." ".$patient_data->last_name;

	$dob = $patient_data->dob;
	$address = $patient_data->address;
	$contact = $patient_data->contact;
	$gender = $patient_data->gender;

	$profile_pic = $patient->patient_picture();

	$profile_path = "img/".$profile_pic;


}
//var_dump($patient);


	if(input::exist()) {


		//re-write the update class so you can do something like $update = $this->db->update('users', $fields, $where); // array('request_id', '=', 32);
		/*
		$fields = array(


				'appointment_id' => input::get('appointment_id'),
				'appointment_status' => 3

		);

		*/


		$appointment = new Appointment;

		$complete = $appointment->completed($request_id);

		if($complete) {

			redirect::to('route.php');
		} else {

			?>

					<p class="error">There was a problem completing your task contact the administrator</p>
			<?php 
		}
	}


?>



<div class="container">

	<h1 class="title">Doctor- View Patient Request</h1>

	<div class="request-unit">

		<div class="face" style="background-image: url(<?php echo $profile_path; ?>)"></div>

		<div class="content">

			<form action="" class="inner-form" method='post'>

				<label for="name" class='text-capitalize lead'>Name: <?php echo $patient_name;?></label>

				<label for="dob">Date of Birth: <?php echo  format_date($dob); ?></label>
				<label for="contact">Contact: 0<?php echo $contact;?></label>

				<label for="address text-capitalize">Address: <?php echo $address; ?></label>

				<label for="gender" class='text-capitalize'>Gender: <?php echo $gender; ?></label>
				<label for="complaint">Complaint</label>
				<textarea name="complaint" id="" cols="30" rows="10" disabled=""><?php echo $request->data()->complaint; ?></textarea>


				<label for="related Symptoms">Related Symptoms</label>

				<textarea name="" id="" cols="30" rows="10" disabled=""><?php echo $request->data()->related_symptoms; ?></textarea>

				<label for=""><a href="view_file.php?file_name=<?php echo $request->data()->medical_file; ?>">Medical Files</a></label>


				<button type='submit' name='submit'>Completed</button>


			</form>


		</div>
	</div>



</div>

<?php 


require_once "footer.php";

?>