<?php

	require_once "header.php";

 ?>



		<?php

				if(!$user->logged_in()) {


					redirect::to('login.php');
				}



				$patient = new Patient;

				$specialties = $user->specialties();

				$patient_data = $patient->data();

				$package_name = $patient_data->package_name;


				$package_visit = $patient->data()->package_visit;

				$patient_visit = $patient->data()->patient_visit;


				$visit_left = $package_visit - $patient_visit;

				$package_id = $patient_data->package_id;

				//echo $visit_left;


			

	



		 ?>




		<h1 class="display-4 page-header text-center">Make Request</span></h1>

		<p class="info">Package Name: <span class='text-info'><?php echo $package_name; ?></span></p>


		<?php 




					if($package_id != 1) {


						?>

							<p class='info'>Visits Left: <span><?php echo $visit_left ?></span></p>

						<?php 
					}

		 ?>

		

		<?php 



		 ?>
		

		 <?php


		 		//check if user has made a request;


		 		$request = new Request();

		 		if($request->passed()) {



		 			if(input::exist('post', 'submit')) {



		 			$file = input::get('file');

		 			$file_name = $file['name'];


		 			if(!$file_name) {

		 				$file_name = "";
		 			} else {

		 				$file_name = File::upload($file);
		 			}




		 			$fields = array(

		 				'specialty_id' => input::get('specialty_id'),
		 				'complaint' => input::get('complaint'),
		 				'related_symptoms' => input::get('related_symptoms'),
		 				'patient_id' => (int) input::get('patient_id'),
		 				'duration' => input::get('duration'),
		 				'medical_file' =>  $file_name,
		 				'request_date' => date('Y-m-d H:i:s'),
		 				'request_status' => 1


		 			);



		 			$create = $request->create($fields);

		 			if($create) {



		 				redirect::to("patient_dashboard.php");
		 			} else {

		 				?>

					<p class="error">There was a problem making request please try again!</p>

		 				<?php
		 			}


		 		}



		 		?>

						 <form action="" class="awesome-form" method='post' enctype="multipart/form-data">

		 	<label for="">Complaint</label>
		 	<textarea name="complaint" id="" cols="30" rows="10" > <?php echo input::get('complaint') ?></textarea>


		 	<label for="">Related Symptoms</label>

		 	<textarea name="related_symptoms" id="" cols="30" rows="10"> <?php echo input::get('related_symptoms') ?></textarea>


		 	<label for="">Specialist</label>

		 	<select name="specialty_id" id="">

		 		<?php if($specialties) {

		 			foreach($specialties as $specialty) {

		 				?>

								<option value="<?php echo $specialty->id ?>"><?php echo $specialty->specialty_name; ?></option>

		 				<?php

		 			}

		 		} ?>

		 	</select>

			<label for="">Durations</label>

		 	<input type="text" name='duration' placeholder='Eg, 3days,  4 weeks, 3 years etc '>

			<label for="">Attach Medical Report(optional)</label>
		 	<input type="file" name='file'>

		 	<input type="hidden" name='patient_id' value="<?php echo $patient->data()->user_id; ?>">


		 	<button type='submit' name='submit'>Make Request</button>
		 </form>


		 		<?php



		 		} else {

		 				foreach($request->errors() as $error) {

		 					?>

					<p class="text-danger text-center"><?php echo $error; ?></p>



		 					<?php
		 				}

						?>

						<div class="link-wrapper">

							<a href="make_payment.php?user_id=<?php echo $patient->data()->patient_id; ?>" class='activate'>Activate Account</a>

						</div>

						<?php

		 		}






		  ?>






 <?php


 	require_once "footer.php";

  ?>
