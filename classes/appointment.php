<?php 


class Appointment {


	private $db = null,
			$data = array();

	public function __construct($appointment_id = false) {


		$this->db = db::get_instance();

		if($appointment_id) {

			$this->find_appointment($appointment_id);
		}



	}


	public function find_appointment($appointment_id) {


		

		$sql = "select *, appointments.id as appointment_id from appointments 
	

		inner join requests

		on appointments.request_id = requests.id

		where appointments.id = ?";

		$fields  = array(

			'id' => $appointment_id

		);

		$query = $this->db->query($sql, $fields);

		if($query->count()) {

			$this->data = $query->first();


			return true;
		}

		return false;
	}



	public function exist() {


			return(!empty($this->data)) ? true : false;
	}


	public function data() {


		return $this->data;
	}




	public function assign($fields) {


		$assignment = $this->db->insert('appointments', $fields);

		if($assignment) {


			session::put("assigned", "Request has been successfully assigned");

								//update the
			var_dump($fields);

			$update = $this->db->update("requests", array('request_status' => 2), array('id', '=', $fields['request_id']));

			if($update) {

				return true;
			
			}

		}

		return false;


	}




	public function approve($appointment_id = false) {

	
		if(!$appointment_id) {


			if($this->exist()) {


					//update appointment status to completed
					//request status too approveved

				$appointment_id = $this->data()->appointment_id;

				$request_id = $this->data()->request_id;

				//var_dump($this->data());

				$fields = array(

						'appointment_status' => 5

				);
				$app_update = $this->db->update("appointments", $fields , array('id', '=', $appointment_id));


				if($app_update) {


						$fields  = array(

								'request_status' => 5
						);
						$request_update = $this->db->update('requests', $fields, array('id', '=', $request_id));


						if($request_update) {


								//echo "request approved";

								session::flash('payment', "payment approved successfully");

								return true;
						}

				}

			}
		}


		return false;
	} 

	public function get_assignment($request_id) {

		$sql = "select * from appointments 


		inner join users
		on appointments.doctor_id = users.id


		where appointments.request_id = ? ";

		$fields = array(

			"request_id" => $request_id

		);

		$query = $this->db->query($sql, $fields);


		if($query->count()) {

			return $query->first();
		}

		return false;
	}

	


	public function get_doctor_appointment($doctor_id) {



			$sql = "select *, appointments.id as appointment_id  from appointments 

	
				inner join requests
				on appointments.request_id = requests.id

				inner join users
				on requests.patient_id = users.id
		

			where appointments.doctor_id = ? and appointments.appointment_status = ?";



			$fields = array(


				'doctor_id' => $doctor_id,
				'appointment_status' => 1

			);


			$query = $this->db->query($sql, $fields);

			if($query->count()) {

				return $query->result();
			}


			return false;
			
	}



	public function completed($request_id) {


		//update appointment
		//update request

		if($update_appointment = $this->db->update("appointments", array('appointment_status' => 4), 
			array('request_id', '=', $request_id))) {


					if($request_update = $this->db->update('requests', array("request_status" => 4) , array('id', '=', $request_id))) {


						session::put('complete', "You have successfully completed request!");

						return true;
					}
		}
	
	

		return false;



	}




	public function get_assigned() {



			$sql = 'select *, appointments.id as appointment_id from appointments 

			left join doctors

			on appointments.doctor_id = doctors.doctor_id

			inner join requests

			on appointments.request_id = requests.id

			where appointments.appointment_status = ?';


			$fields = array(


				'appointment_status' => 1

			);


			$query = $this->db->query($sql, $fields);

			if($query->count()) {

				return $query->result();
			}

			return false;
	}



	public function get_all_appointments($doctor_id) {

			if($doctor_id) {


				$sql = "select *, appointments.id as appointment_id from appointments

				inner join requests on

				appointments.request_id = requests.id


				left join appointment_status

				on appointments.appointment_status = appointment_status.id

				where appointments.doctor_id = ?";

				$fields = array(

					'doctor_id' => $doctor_id
				);

				$query = $this->db->query($sql, $fields);

				if($query->count()) {


					return $query->result();
				}


			} else {


				$sql = "select * from appointments


					inner join requests on

					appointments.request_id = requests.id
				";
				$query = $this->query($sql);

				if($query->count()) {

					return $query->result();
				}
			}


			return false;

	}



	//get all transaction where status is completed

	public function get_completed() {


		$sql = "select *, appointments.id as appointment_id from appointments
		inner join requests
		on appointments.request_id = requests.id 

		where appointments.appointment_status = ?";

		$fields = array(

				'appointment_status' => 4

		);

		$query = $this->db->query($sql, $fields);

		if($query->count()) {

			return $query->result();
		}

		return false;
	}


	public function update($fields) {


			$appointment_id = $fields['appointment_id'];

			$doctor_id = $fields['doctor_id'];

			$app_fields = array(

				'doctor_id' => $doctor_id

			);



			$update = $this->db->update("appointments", $app_fields, array('id', '=', $appointment_id));


			if($update) {


				session::put("home", "You have successfully reassinged apppointment to new Doctor");

				return true;
			}

			return false;


	}
}