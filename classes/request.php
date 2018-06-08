<?php


	class Request {


		private $db = null,
				$errors = array(),
				$passed = false,
				$session_name;




		public function __construct($request_id = null) {

			$this->db = db::get_instance();

			$this->session_name = config::get('session/session_name');

			if($request_id) {



				$this->find_request($request_id);

			}


			if(session::exist($this->session_name)) {

				$this->check(session::get($this->session_name));
			}
		}






		public function check($user) {

			$sql = "select * from users

			inner join patients

			on users.id = patients.patient_id

			left join packages

			on patients.package_id = packages.id

			where users.email = ?";


			$fields = array(

				'email' => $user

			);


			$query = $this->db->query($sql, $fields);


			if($query->count()) {

				//var_dump($query);

				$query_data = $query->first();

				$expiry = $query_data->expiry;

				$package_visit = $query->first()->package_visit;
				$package_id = $query->first()->package_id;
				$patient_visit = $query->first()->patient_visit;



				if($package_id == 1) {

					$this->add_error("You need to activate Account!");


				} else {


					if($patient_visit >= $package_visit) {


						$this->add_error("You have reached the maximum number of visits from a Doctor");

					} else if ($this->expiry($expiry)) {


						$this->add_error("Your accuont has expired");
					}




				}



			}


			if(empty($this->errors)) {

				$this->passed = true;
			}


			return $this;


		}



		public function add_error($error)  {

				$this->errors[] = $error;
		}


		public function passed() {

			return $this->passed;
		}


		public function expiry($expiry) {


				$date  = new DateTime;

				$expiry_check = clone ($date);

				$expiry_check = new DateTime($expiry);

				if($expiry_check < $date) {

					return true;
				}


				return false;
		

		}

		public function get_assigned() {

			$sql = "select *, requests.id as request_id from requests 

			inner join users
			on requests.patient_id = users.id


			where requests.request_status = ?";

			$fields = array(

				'request_status' => 2

			);

			$query = $this->db->query($sql, $fields);

			if($query->count()) {

				return $query->result();
			}

			return false;
		}



 		public function create($fields) {

			$user_requests = $this->db->insert('requests', $fields);

			if($user_requests) {

				//update the number of visits left for patients;


				//start from here

				session::put("request", "You have successfully requested for a Doctor");

				//echo "incraase the number of patient_visit to one";

				//grab current patient visit
				//and increase by 1;

				//var_dump($fields);

				$patient_id = $fields['patient_id'];


				$patient = $this->db->get('patients', array('patient_id', '=', $patient_id));

				if($patient->count()) {


					$patient_visit = $patient->first()->patient_visit;

					$new_patient_visit  = $patient_visit + 1;

						//update the patient table  with new visit
						$fields = array(

							'patient_visit' => $new_patient_visit

						);

						$update = $this->db->update('patients', $fields, array('patient_id', '=', $patient_id));


						return true;

				}

			}

			return false;
		}



		public function errors() {

			return $this->errors;
		}


		public function find_request($request_id) {


			$sql = "select *, requests.id as request_id from requests


			left join specialties on

			requests.specialty_id = specialties.id


			left join request_status
			on requests.request_status = request_status.id

			where requests.id = ?";


			$fields = array(


				'id' => $request_id

			);

			$query = $this->db->query($sql, $fields);

			if($query->count()) {

				$this->data =  $query->first();
			}

			return false;
		}


		public function update($fields) {


				echo $this->data()->request_id;


				$update = $this->db->update('requests', $fields, array('id', '=', $this->data()->request_id));


				//$update = $this->db->update('requests', $fields, $this->data()->request_id);

				if($update) {


					session::put("update", "Your request was succesfully updated");
					return true;
				}

				return false;

		}


		public function all_request() {

			/*

			$sql = "select *, requests.id as request_id from requests

					inner join users
					on requests.patient_id = users.id

					left join specialties
					on requests.specialty_id = specialties.id

					left join request_status
					on requests.request_status = request_status.id


				";

			$query = $this->db->query($sql);

			*/


			$sql = "select *, requests.id as request_id from requests

					inner join users
					on requests.patient_id = users.id

					left join specialties
					on requests.specialty_id = specialties.id

					left join request_status
					on requests.request_status = request_status.id

			where requests.request_status = ?";

			$fields = array(

				'request_status' => 1
			);

			$query  = $this->db->query($sql, $fields);



			if($query->count()) {

				return $query->result();
			}

			return false;

		}

		public function data() {

			return $this->data;
		}


		public function exist() {

			return (!empty($this->data)) ? true : false;
		}


		public function approve($request_id) {


				//update the appointments table
				//update request table to approve


				$request_update = $this->db->update('requests', array('request_status' => 5), array('id', '=', $request_id));


					if($request_update) {

						session::put("approve", "You have successfully approved appointment");
						return true;
					}
				/*

				$appointment_update = $this->db->update('appointments', array("appointment_status" => 4), array('request_id', '=', $request_id));

				if($appointment_update) {

					
				}


				*/


				return false;
		}


		public function get_all_request() {


				$sql  = "select *, requests.id as request_id from requests

				inner join request_status



				on requests.request_status = request_status.id


				inner join users
				on requests.patient_id = users.id

					
			
				";

				$query = $this->db->query($sql);

				if($query->count()) {

					if($query->count()) {


						//var_dump($query->result());
						return $query->result();
					}

				}


				return false;
		}


		public function  search($search) {

		

				$sql = "select *, requests.id as request_id from users 

				inner join patients

				on users.id = patients.patient_id

				inner join requests on

				users.id = requests.patient_id

				left join packages
				on patients.package_id = packages.id

				left join request_status

				on requests.request_status = request_status.id

				where users.first_name like ? or users.last_name like ? or address like ?";

				$fields = array(


					'first_name' => "%$search%",
					"last_name" => "%$search%",
					"address" => "%$search%"
				);


				$query = $this->db->query($sql, $fields);

				if($query->count()) {

					return $query->result();
				}


				return false;
		}
	}
