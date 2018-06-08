<?php 


require_once "header.php";

?>

<div class="container">


	<h1 class="display-4 page-header text-center">Request Details</h1>



	<?php 	


	if(!$user->logged_in()) {

		echo 'not logged in';
	}

	$request_id = input::get('request_id');


	$request = new Request($request_id);

				//var_dump($request);

				//check if user wants to update request info

	if(input::exist('post', 'submit')) {


		$fields = array(

			'complaint' =>  input::get('complaint'),
			'related_symptoms' => input::get('related_symptoms'),
			'duration' => input::get('duration')

		);



		$update = $request->update($fields);

		if($update) {

			redirect::to('patient_dashboard.php');
		} else {


			?>

			<p class="erorr"> There was a problem updating account</p>


			<?php 
		}
	}





	if($request->exist()) {


					//var_dump($request->data());

		?>

		<div class="request-unit">

			<form action="" method='post' class='main-form'>


				<div class="form-group">

					<label for="status class="text-capitalize">Request Status: <span class='text-capitalize' style='font-size: 30px; margin-left: 20px'><?php echo $request->data()->status_name; ?></span></label>

					<?php 

										//if status is completed show the approve button
										//update the appointments table to approve
										//update the request table to approve


					$request_status = $request->data()->status_name;



					?>

				</div>


				<div class="form-group">
					<label for="complaint">Complaint</label>
					<textarea name="complaint" id="" <?php if($request_status == 'completed' || $request_status == 'approved') {

						echo "disabled";
					} ?> cols="30" rows="10" class='form-control'><?php echo $request->data()->complaint; ?></textarea>

				</div>

				<div class="form-group">

					<label for="related-symptoms">Related Symptoms</label>

					<textarea name="related_symptoms" id=""  <?php if($request_status == 'completed' || $request_status =='approved') {

						echo "disabled";
					} ?> cols="30" rows="10" class="form-control"><?php echo $request->data()->related_symptoms; ?></textarea>

				</div>


				<div class="form-group">

					<label for="duration">Duration</label>

					<input type="text" name='duration' <?php if($request_status == "completed" || $request_status =="approved"){
						echo "disabled";
					} ?> value ="<?php echo $request->data()->duration; ?>" class='form-control'>

				</div>


				<div class="form-group">
					<label for="specialty">Specialty</label>
					<input type="text" disabled name='spcialty' value ="<?php echo $request->data()->specialty_name; ?>" class="form-control">

				</div>

				<div class="form-group">

					<label for="medical-file" style="display: block; margin-bottom: 20px;"><a href="view_file.php?file_name=<?php echo $request->data()->medical_file;  ?>">Medical File</a></label>
					
					<?php 


							//if request status is open or assigned show save changes button else show approval button


							if($request_status == "completed") {

							?>

								<a href="patient_approve.php?request_id=<?php echo $request->data()->request_id; ?>" class="btn btn-lg btn-success btn-block">Approve Request</a>


							<?php
							} else if($request_status == "assigned" || $request_status =="pending") {

								?>

									<button type='submit' name='submit' class='btn btn-primary btn-block btn-lg'>Update Changes</button>


								 <?php 
							}


					 ?>
					

				</div>

			</form>

		</div>		


		<?php 
	} else {

		?>

		<p class="info">No Request</p>

		<?php 
	}




	?>



</div>


<?php 


require_once "footer.php";

?>