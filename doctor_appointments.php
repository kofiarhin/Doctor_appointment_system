<?php 


	require_once "header.php";


 ?>

	
		<h1 class="title">Doctor's - Appointments</h1>


		<?php 


				if(!$user->logged_in()) {

					redirect::to('login.php');
				}


				$doctor = new Doctor;



				$appointment = new Appointment();


				$doctor_id = $doctor->data()->user_id;



				$app_data = $appointment->get_doctor_appointment($doctor_id);


				if(!$app_data) {

					?>
					

					<p class="info">There are no new appointments for now</p>


					<?php 
				} else {


						?>


				<table class="table table-hover">
					
						<tr>
							<th>Appointment ID</th>
							<th>Patient Name</th>
							<th>Request Date</th>
							<th>Action</th>
						</tr>


						<?php 

								foreach($app_data as $data) {


									$appointment_id = $data->appointment_id;



									?>
										
										<tr>
											<td><?php echo $appointment_id; ?></td>
											<td><?php echo $data->first_name." ".$data->last_name; ?></td>
											<td><?php echo format_date($data->request_date); ?></td>

											<td><a href="doctor_view_request.php?request_id=<?php echo $data->request_id ?>">View</a></td>
										</tr>


									<?php 
								}

						 ?>

				</table>


						<?php 
				}


		 ?>


		

 <?php 


 	require_once "footer.php";


  ?>