<?php 


require_once "header.php";


if(!$user->logged_in()) {

	redirect::to('login.php');
}


if($role != 'admin') {

	redirect::to('route.php');
}


?>


<div class="container">
	

	<h1 class="display-4 text-center page-header">Request Dashboard</h1>


	<?php 

	if(session::exist('assigned')) {


		?>

		<p class="success">Request Successfully assigned</p>

		<?php 
	}

	?>


	<?php 


	$request = new Request();

	$datas = $request->all_request();





	?>

	

	<?php 

	if($datas) {

		?>

		<table class='awesome-table'>
			
			<tr>
				<th>Patient Name</th>
				<th>Specialist</th>
				<th>Request Status</th>
				<th>Action</th>
			</tr>


			<?php 

			foreach($datas as $data) {

				?>
				
				<tr>
					
					<td><?php echo $data->first_name." ".$data->last_name; ?></td>

					<td><?php echo $data->specialty_name; ?></td>
					<td><?php echo $data->status_name; ?></td>
					<td><a href="admin_view_request.php?request_id=<?php echo $data->request_id; ?>">View</a></td>
				</tr>			

				<?php 
			}

		} else {

			?>
			<p class="info">There are no new Requests</p>
			<?php 
		}

		?>
		
	</table>


</div>

<?php 


require_once "footer.php";

?>