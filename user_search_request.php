<?php 


	require_once "core/init.php";

	$search = input::get('search');


	$request = new Request;




	if($search == "") {

			$app_data = $request->get_all_request();

			//var_dump($app_data);
	} else {

			$app_data = $request->search($search);
	}





	if($app_data) {


			?>


				<table class="table">
					
					<thead>
						<th>Request ID</th>
						<th>Request Date</th>
						<th>Patient Name</th>
						<th>Request Status</th>
						<th>Action</th>
					</thead>

					<?php 

							foreach($app_data as $data) {


									//var_dump($data);

								?>
					
									<tr>
										<td><?php echo $data->request_id; ?></td>

										<td><?php echo  format_date($data->request_date); ?></td>
										<td><?php echo $data->first_name." ".$data->last_name; ?></td>

										<td><?php echo $data->status_name; ?></td>
										<td><a href="admin_view_request?request_id=<?php echo $data->request_id;?>">View</a></td>
									</tr>

								<?php 

							}

					 ?>
				</table>



			<?php


	}
 











 ?>