<?php 


		require_once 'header.php';


 ?>


	<?php 



			if(session::exist('complete')) {


					?>

					<p class="success"><?php echo session::flash('complete') ?></p>
					<?php
			} 



			if(session::exist('assigned')) {

					?>
				<p class="success"><?php echo session::flash('assigned') ?></p>


				<?php 
			}
  
	 ?>

	<div class="container">
		
				<div class="thumb-wrapper">
					
					<a href="doctor_profile.php" class="thumb-unit">Profile</a>
					<a href="doctor_appointments.php" class="thumb-unit">Appointments</a>
					<a href="doctor_transactions.php" class="thumb-unit">Transactions</a>

				</div>


	</div>

 <?php 


 	require_once "footer.php";

  ?>