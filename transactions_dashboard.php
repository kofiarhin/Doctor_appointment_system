<?php 


	require_once "header.php";


 ?>

 			<div class="container">


			<h1 class='display-4 text-center page-header'>Admin View: Completed Appointments</h1>
			<?php 




					//get all transactions where status is

					$appointment = new Appointment;



					$completed = $appointment->get_completed();


					if($completed) {


							foreach($completed as $app_data) {


								//var_dump($app_data);
								//grab the patient

								$patient_id = $app_data->patient_id;
								$doctor_id = $app_data->doctor_id;


								$doctor = new Doctor($doctor_id);
								$patient = new Patient($patient_id);

								$appointment_id = $app_data->appointment_id;



								if($patient->exist() && $doctor->exist()) {


									$patient_data = $patient->data();

									$doctor_data = $doctor->data();


									$patient_name = $patient_data->first_name." ".$patient_data->last_name;
									$doctor_name= $doctor_data->first_name." ".$doctor_data->last_name;
								}


									

									

									

								
							}

							?>


								<table class="awesome-table">
									
										
										<tr>
											<th>Appointment ID</th>
											<th>Pateint Name</th>
											<th>Doctor Name</th>
											<th>Action</th>
										</tr>


										<tr>
											<td>32</td>
											<td><?php echo $patient_name; ?></td>
											<td>Dr <?php echo $doctor_name ?></td>
											<td><a href="admin_view_appointment.php?appointment_id=<?php echo $appointment_id; ?>">View</a></td>
										</tr>


								</table>


							<?php 

					} else {


						?>


							<p class="info">No Transactions to approve</p>

						<?php					}


			 ?>





			


			 </div>

 <?php 


 			require_once "footer.php";


  ?>