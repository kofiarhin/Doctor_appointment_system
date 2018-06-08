<?php 

		require_once "header.php";



 ?>

			<?php 

					$appointment_id = input::get('appointment_id');
					$specialty_id = input::get("specialty_id");

					$doctors = $user->get_doctor($specialty_id);

					//var_dump($doctors);




					
				//check if button cliked

					if(input::exist()) {

						

						$fields = array(

							'appointment_id' => input::get("appointment_id"),

							'doctor_id'  => input::get('doctor_id')

						);

						$appointment = new Appointment;

						$update = $appointment->update($fields);

						if($update) {

							redirect::to('route.php');
						} else {


							?>

		
								<p class="text-danger text-center">There was a problem reassigning to Doctor</p>


							<?php 
						}
					}
				
					
			 ?>

			<div class="container">
				

			 <form action="" method = 'post' class='main-form bordered'>
			 		

			 		<div class="form-group">
			 			

			 			<label for="doctor_id">Reassign To</label>
			 			<select name="doctor_id" id="" class="form-control">

			 				<?php 

			 						if($doctors) {

			 								foreach($doctors as $doctor) {

			 									$doctor_id = $doctor->doctor_id;
			 									$doctor_name = $doctor->first_name." ".$doctor->last_name;

			 									?>
													<option value="<?php echo $doctor_id; ?>">Dr <?php echo $doctor_name; ?></option>

			 									<?php 
			 								}
			 						}

			 				 ?>
			 
			 			</select>
			 		</div>

			 		<input type="hidden" name='appointment_id' value="<?php echo $appointment_id; ?>">

			 		<button type='submit' name='submit' class="btn btn-primary">Assign To Doctor</button>
			 </form>
				
			</div>

 <?php 


 			require_once "footer.php";

  ?>