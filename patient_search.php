<?php 


		require_once "core/init.php";

		$search = input::get('search');




		$patient = new Patient();


		$data = $patient->search($search);

		if($data) {

			?>

				<table class="table">
					
					<thead>
						<th>#</th>
						<th>First Name</th>
						<th>Last name</th>
						<th>Email</th>
						<th>Package Name</th>
						<th>Action</th>
					</thead>

					<?php 


								foreach($data as $patient) {


										//var_dump($patient);

									?>

										<tr>
											<td><?php echo $patient->user_id; ?></td>
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

			<?php 
		}

 ?>