<?php 


require_once "header.php";

?>


<?php 


			//var_dump($user);
			//echo "transactions completed and their status";


$doctor = new Doctor;


$appointment = new Appointment();

$doctor_id = $doctor->data()->user_id;



			//get appointments of doctor;
			//doctor can search for appointment 
$app_data = $appointment->get_all_appointments($doctor_id);

if($app_data) {

	?>
	<div class="container">

		<table class="table">
			<thead>
				<th>Appointment ID</th>
				<th>Patient Name</th>
				<th>Appointment Status</th>
				<th>Action</th>
			</thead>

			<?php 

			foreach($app_data as $data) {

										//var_dump($data);
				$patient_id = $data->patient_id;
				$doctor_id = $data->doctor_id;
				$appointment_id = $data->appointment_id;

				$appointment_status_name = $data->appointment_status_name;



										//get patient details

				$patient = new Patient($patient_id);


				$patient_name = "";



				if($patient->exist() ) {

					$patient_data = $patient->data();



					$patient_name = $patient_data->first_name." ".$patient_data->last_name;
				}




				?>

				<tr>

					<td><?php echo $appointment_id; ?></td>
					<td><?php echo $patient_name; ?></td>
					<td><?php echo $appointment_status_name; ?></td>
					<td><a href="#">View</a></td>
				</tr>


				<?php 
			}

			?>

		</table>


	</div>

	<?php 
}



			//var_dump($doctor);

			//grab appointment where status is either completed or approved





?>


<?php 


require_once "footer.php";

?>