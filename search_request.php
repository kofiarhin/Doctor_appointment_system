<?php 

require_once "header.php";

?>



<?php 

$requests = new Request();

$datas = $requests->get_all_request();

?>


<div class="container">

	<h1 class="display-4 text-center page-header">Admin: Search Request</h1>
	<div class="row">

		<div class="col-md-4">
			<div class="form-group">
				<input type="text" name='search' placeholder="Search for Request" class='form-control' id='request_search'>
			</div>
		</div>
	</div>

	


	<div id="result">

		<div class="row">


			<table class="table">

				<thead>
					<tr>
						<th>Request ID</th>
						<th>Request Date</th>
						<th>Patient Name</th>
						<th>Request Status</th>
						<th>Action</th>
					</tr>
				</thead>


				<?php 


				if($datas) {


					foreach($datas as $data) {

						//var_dump($data);

						$patient_id = $data->patient_id;

						$request_status = $data->request_status;
						$request_status_name= $data->status_name;

						$request_date = format_date($data->request_date);

					

						$patient = new Patient($patient_id);

						

						$request_id = $data->request_id;
						$request_status_name = $data->status_name;

						$patient_data = $patient->data();

						


						$patient_name = $patient_data->first_name." ".$patient_data->last_name;

						?>

						<tr>

							<td><?php echo $request_id; ?></td>

							<td><?php echo $request_date; ?></td>
							<td><?php echo $patient_name; ?></td>
							<td><?php echo $request_status_name; ?></td>
							<td><a href="admin_view_request?request_id=<?php echo $request_id;?>">View</a></td>
						</tr>



						<?php 


					} 
				}


				?>
			</table>


		</div>
	</div> <!--====  end of row =======-->


</div> <!--====  container=======-->


<?php 


require_once "footer.php";

?>