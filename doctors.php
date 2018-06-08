<?php 

require_once "header.php";

?>


<?php 


if($role != "admin") {

	redirect::to("login.php");
}


$doctors = $user->all_doctors();

?>
	
	<h1 class="display-4 page-header text-center">Admin: All Doctors</h1>

	

<?php 

	
if($doctors) {


	?>
	

	<div class="container">

	<div class="row">
		
		<div class="col-md-4">
			<input type="text" name='doctor' placeholder="Search Doctor" class="form-control">
		</div>
	</div>

	<table class="table table-hover">
		
		<thead>
			<th>#</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Specialty</th>
			<th>Action</th>
		</thead>

		<?php 

				foreach($doctors as $doctor) {


					?>
						<tr>
							<td><?php echo $doctor->doctor_id; ?></td>
							<td><?php echo $doctor->first_name; ?></td>
							<td><?php echo $doctor->last_name; ?></td>
							<td><?php echo $doctor->email; ?></td>
							<td><?php echo $doctor->specialty_name; ?></td>
							<td><a href="view_doctor_profile.php?doctor_id=<?php echo  $doctor->doctor_id; ?>" class='link'>View</a></td>
						</tr>

					<?php 
				}

		 ?>
	</table>


	<div class="button-wrapper">
		
		<button href="" class='btn btn-primary btn-lg' id="load_more">Load More</button>
	</div>


	<!--==== 

	<div class="row">
		

		<?php 

		foreach($doctors as $doctor) {


			?>

			<div class="col-md-3">

				<?php 

							$profile_path = "img/default.jpg";



							if($doctor->profile_status) {

								$profile = new Doctor($doctor->doctor_id);

								$profile_pic = $profile->get_profile_pic();


								$profile_path = "img/".$profile_pic;
								


								
							}

				 ?>

				<div class="face" style="background-image: url(<?php echo $profile_path; ?>)"></div>
				<div class="content">
					<p class="lead">Name: <?php echo $doctor->first_name." ".$doctor->last_name; ?></p>
					<p class="email">Email: <span><?php echo $doctor->email; ?></span></p>
					<p class="text">Specialty: <?php echo $doctor->specialty_name; ?></p>
					<a href="view_doctor_profile.php?doctor_id=<?php echo  $doctor->doctor_id; ?>" class='btn btn-info'>View</a>
				</div>
			</div>

			<?php 
		}

		?>


	</div>  end row =======-->


	</div>

	<?php 
}


?>

<?php 


require_once "footer.php";


?>