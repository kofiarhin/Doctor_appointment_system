<?php 


require_once "header.php";


if(!$user->logged_in()) {

	redirect::to('login.php');



}


	//if user is not a patient rediret to the route file to reroute to user dasshboard
if($role != 'patient') {

	redirect::to('route.php');
}



$patient = new Patient;

$patient_request = $patient->all_request();





?>

<div class="container">

	<h1 class="display-5 text-center page-header"> Request History </h1>

	

	

	<table class='table table-hover'>

		<thead class="thead-blue">
			<tr>
				<th>Request ID</th>
				<th>Requesst Date</th>
				<th>Type of Specialist</th>
				<th>Request Status</th>
				<th>Action</th>
			</tr>

		</thead>




		<?php 

		if($patient_request) {

							//var_dump($patient_requets[0]);

			foreach($patient_request as $patient_request) {

				$request_id = $patient_request->request_id;

				?>

				<tr>
					<td><?php echo $request_id; ?></td>
					<td><?php echo format_date($patient_request->request_date) ?></td>
					<td><?php echo $patient_request->specialty_name; ?></td>
					<td><?php echo  $patient_request->status_name; ?></td>

					<td><a href="patient_view_request.php?request_id=<?php echo $request_id; ?>">View</a></td>

				</tr>

				<?php 
			}


		} else {

			?>

			<p class="info">You are yet to make request</p>

			<?php 
		}


		?>

		

	</table>



</div>

<?php 


require_once "footer.php";


?>