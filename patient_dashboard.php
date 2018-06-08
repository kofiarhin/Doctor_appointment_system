<?php 

		require_once "header.php";

 ?>

	
	<?php 


			if(!$user->logged_in()) {

				redirect::to('login.php');
			}




	 ?>


	 <div class="container">


	 			<h1 class="display-5 page-header text-center">Patient Dashboard</h1>
	 	
				<?php 

						if(session::exist('request')) {

							?>


					<p class="success"><?php echo session::flash('request'); ?></p>

							<?php 

						}



					if(session::exist('update')) {

						?>


							<p class="success"><?php echo session::flash('update') ?></p>

						<?php
					}


					if(session::exist('approve')) {

						?>
					
						<p class="success"><?php echo session::flash('approve'); ?></p>

						<?php 
					}




				 ?>
				<div class="thumb-wrapper">
					<a href="patient_profile.php" class="thumb-unit">Profile</a>
					<a href="make_request.php" class="thumb-unit">Make Request</a>
					<a href="patient_request.php" class="thumb-unit">Requests</a>
					
				</div>


	 </div>



 <?php 

 		require_once "footer.php";

  ?>