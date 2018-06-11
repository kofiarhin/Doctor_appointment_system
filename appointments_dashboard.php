<?php 


require_once "header.php";

?>

<div class="container">

	<h1 class="display-4 text-center page-header">Appointment History</h1>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				
				<label for="search">Searh Appoinment</label>
				<input type="text" class="form-control" placeholder='Search Appointment'>
			</div>
		</div>
	</div>

	<?php 


	if(!$user->logged_in()) {


		redirect::to('login.php');

	}


	$appointments = new Appointment;




	$datas = $appointments->get_assigned();


	//var_dump($datas);


	if($datas) {


		//var_dump($datas);



		?>


		<table class="table">

			<thead>
				
				<tr>
					<th>Appointment ID</th>
					<th>Request ID</th>
					<th>Request Date</th>
					<th>Patient Name</th>
					<th>Doctor Name</th>
					<th>Action</th>
				</tr>
			</thead>
			
			<?php 

			foreach($datas as $data) {


				$request_id = $data->request_id;

				$appointment_id = $data->appointment_id;
				$patient_id = $data->patient_id;
				$doctor_id = $data->doctor_id;

				$request_date = $data->request_date;



				$patient = new Patient($patient_id);
				$doctor = new Doctor($doctor_id);




				if($patient->exist() && $doctor->exist()) {


					$patient_data = $patient->data();

					$doctor_data  = $doctor->data();



					$patient_name = $patient_data->first_name." ".$patient_data->last_name;

					$doctor_name = $doctor_data->first_name." ".$doctor_data->last_name;



					?>
					<tr>

						<td><?php echo $appointment_id; ?></td>
						
						<td><?php echo $request_id; ?></td>
						<td><?php echo format_date($request_date);  ?></td>
						<td class='text-capitalize'><?php echo $patient_name; ?></td>

						<td class='text-capitalize'><?php echo $doctor_name; ?></td>
						<td><a href="admin_view_appointment.php?appointment_id=<?php echo $appointment_id; ?>">View</a></td>
					</tr>


					<?php 


				}

			}



			?>

		</table>

		<?php 






	} else {


		?>

		<p class="info">There are no Appointments in the System</p>

		<?php
	}




	?>




	



	


	<?php 



	require_once "footer.php";

	?>