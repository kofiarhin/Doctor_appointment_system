<?php 

		require_once "header.php";

 ?>






	<section id="dashboard">
		
				<h1 class="display-4 page-header text-center">Admin DashBoard</h1>


				<?php 

					if(session::exist('payment')) {

						?>

							<p class="info"><?php echo session::flash('payment') ?></p>

						<?php
					}
					if(session::exist('update')) {

						?>
					
							<p class="success"><?php echo session::flash('update')?></p>


						<?php 
					}

					if(session::exist('account_created')) {

						?>

							<p class="success"><?php echo session::flash('account_created'); ?></p>

						<?php 
					}


					if(session::exist('assigned')) {


						?>

						<p class="success"><?php echo session::flash("assigned") ?></p>


						<?php 
					}

					if(session::exist('delete')) {


						?>

						<p class="success"><?php echo session::flash("delete") ?></p>


						<?php 
					}


					if(session::exist('home')) {


						?>
						<p class="sucess text-center" style="margin-bottom: 20px"><?php echo session::flash("home"); ?></p>

						<?php 
					}

				 ?>

				<div class="container">
					

					<div class="thumb-wrapper">
						<a href="patients.php" class="thumb-unit">
							Patients
						</a>

						<a href='doctors.php' class="thumb-unit">
							Doctors
						</a>



						<a href='create_doctor.php' class="thumb-unit">
							Register Doctor
						</a>


						<a class="thumb-unit" href='request_dashboard.php'>
								New Requests
						</a>


						<a class="thumb-unit" href="appointments_dashboard.php">
							Appointments
						</a>

						<a href="search_request.php" class='thumb-unit'>All Request</a>



						<a class="thumb-unit" href='transactions_dashboard.php'>
							Approve Transactions
						</a>

						

						

					</div>


				</div>

	</section>

 <?php 


 		require_once "footer.php";


  ?>