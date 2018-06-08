<?php 

		require_once "header.php";


 ?>


 			<div class="container">
 				
				
				<?php 


					$appointment_id = input::get('appointment_id');


					$appointment = new Appointment($appointment_id);


					if($appointment->approve()) {



						?>

								<p class="text-success text-center">Your have successfully approved payment</p>

						<?php 
					}

			 ?>


 			</div>

			

 <?php 


 			require_once "footer.php";


  ?>