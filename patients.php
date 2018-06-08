<?php 


require_once "header.php";

?>

<section id="patients">


	<div class="container">

		<div class="row">
			
			<div class="col-md-4">

				<input type="text" class="form-control" placeholder="Search Patient..." id='patient_search'>

			</div>

		</div>


		<?php 

		$patients = $user->all_patients();

		if($patients) {




			?>


			<div id="result">
				<table class="table">

					<thead>
						<th>#</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Package</th>
						<th>Action</th>
					</thead>

					<?php 

					foreach($patients as $patient) {

									//var_dump($patient);
						?>

						<tr>
							<td><?php echo $patient->patient_id; ?></td>
							<td><?php echo $patient->first_name; ?></td>
							<td><?php echo $patient->last_name; ?></td>
							<td><?php echo $patient->email; ?></td>
							<td><?php echo $patient->package_name; ?></td>
							<td><a  class='link' href="view_patient_profile.php?user_id=<?php echo $patient->patient_id; ?>">View</a></td>
						</tr>



						<?php 
					}

					?>

				</table>


			</div> <!--====  result=======-->


			<div class="button-wrapper">

				<button class="btn btn-primary btn-lg">Load More</button>
			</div>
			<?php


		} else {



			echo "There are no patients";
		}

		?>

	<!--====  end 


		<div class="profile-wrapper">



			

			<?php 



			$patients = $user->all_patients();


			//var_dump($patients);


			if($patients) {


				foreach($patients as $patient) {

					?>

					<div class="profile-unit">

						<?php 

								$profile_path = "img/default.jpg";

								if($patient->profile_status) {

									$profile  = new Patient($patient->patient_id);


									$profile_pic = $profile->profile_pic();

									$profile_path = "img/".$profile_pic;
								}


						 ?>
						
						<div class="face" style="background-image: url(<?php echo $profile_path; ?>)"></div>

						<div class="content">
							<p class="name"><?php echo $patient->first_name." ".$patient->last_name; ?></p>
							<a  class='link' href="view_patient_profile.php?user_id=<?php echo $patient->patient_id; ?>">View</a>
						</div>
					</div>

					<?php 
				}


			}



			?>

		</div> <!--====  end div wrapper =======-->


		=======-->
	</div>





</section>

<?php 

require_once "footer.php";

?>