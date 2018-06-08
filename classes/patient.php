<?php 

	class Patient {

		private $db = null,
				$profile_pic = "default.jpg",
				$visit_left = 0,
				$can_make_request = false,
				$data = array();

		public function __construct($user = null) {



				$this->db = db::get_instance();

				$this->session_name = config::get('session/session_name');


				if(!$user) {

					if(session::exist($this->session_name)) {

							$user = session::get($this->session_name);


							$this->find($user);



							
					}



				} else {

					$this->find($user);

				}


				if($this->profile_check()) {

					$this->profile_pic = $this->profile_pic();
				}

				//var_dump($this);


				if($this->exist()) {

						//get the number of visits left;

						if($this->visit_left()) {


							$this->can_make_request = true;
						}

						return $this;
				}

		}



		public function can_make_request() {

			return $this->can_make_request;
		}


		public function visit_left() {


			if($this->exist()) {


					//var_dump($this->data());


						$patient_data  = $this->data();

						$package_visit = $patient_data->package_visit;

						$patient_visit = $patient_data->patient_visit;


						$this->visit_left = $package_visit - $patient_visit;

						return true;
			}

		}


		public function get_visit_left() {

			if($this->exist()) {

				return $this->visit_left;
			}
		}

		public function find($user) {

			$field = (is_numeric($user)) ? "id": "email";
			$sql = "select *, users.id as user_id from users 

			inner join patients

			on users.id = patients.patient_id

			left join packages

			on patients.package_id = packages.id

			where users.{$field} = ?";

			$fields = array(

				'id' => $user

			);


			$user = $this->db->query($sql, $fields);

			if($user->count()) {

				$this->data = $user->first();

				return true;
			}

			return false;

		}


		public function patient_picture()  {

			return $this->profile_pic;
		}



		public function create_account($fields) {


			
					$salt = hash::salt(32);

					$password = hash::make($fields['password'], $salt);

					$login_fields = array(

						'email' => $fields['email'],
						'password' => $password,
						'salt' => $salt,
						'role' => 'patient'

					);


					$login_insert = $this->db->insert('login', $login_fields);

					if($login_insert) {


						$user_fields = array(

							'first_name' => $fields['first_name'],
							'last_name' => $fields['last_name'],
							'email' => $fields['email'],
							'contact' => $fields['contact'],
							'address' => $fields['address'],
							'dob' => $fields['dob'],
							'gender' => $fields['gender'],
							'joined' => date("Y-m-d H:i:s"),
							'profile_status' => 0

						);

						$user_insert = $this->db->insert('users', $user_fields);

						if($user_insert) {

							$user_id = $this->db->get('users', array('email', '=', $fields['email']));

							if($user_id->count()) {


								$user_id  = $user_id->first()->id;


								$patient_fields = array(

									'patient_id' => $user_id,
									'package_id' => 1,
									'expiry' => date("Y-m-d H:i:s")
								);

								$patient_insert = $this->db->insert('patients', $patient_fields);

								if($patient_insert) {

									session::put("account_created", "Your account ".$fields['email']." was successfully created");
									return true;
								}
							}
						}
					}


					return false;

		} 



		public function update_info($fields) {


				$id = $this->data()->user_id;



				$account_update = $this->db->update('users', $fields, array('id', '=', $id));

				
				if($account_update) {

					session::put("edit", "Profile info saved!");

					return true;
				}

				return false;

		}



		public function profile_check() {

			if($this->exist() ) {

					return ($this->data()->profile_status) ? true : false;

			}
		}


		public function exist() {

			return(!empty($this->data)) ? true : false;
		}


		public function data() {

			return $this->data;
		}

		public function update_profile($file) {

			
			//check if user already has a profile picture
			//insert into database
			//update existing
			//update users table

			$user = $this->db->get('profile_images', array('user_id', '=', $this->data()->user_id));

			if($user->count()) {


				//update existing data;

				$id = $user->first()->id;


				//update the table


				$update = $this->db->update('profile_images', array('file_name' => $file), array('id', '=', $id));

				if($update) {

					echo "profile updated";

					return true;
				}


				
			} else {


				//insert record

				$fields = array(

					'user_id' => $this->data()->user_id,
					'file_name' => $file

				);

				$file_insert = $this->db->insert('profile_images', $fields);

				if($file_insert) {

					//update the user table

					$update = $this->db->update('users', array('profile_status' => 1), array('id', '=', $this->data()->user_id));

					echo "account updated";
					return true;
				}
			}


				return false;	
		}


		public function profile_pic() {


				$file = $this->db->get('profile_images', array('user_id', '=', $this->data()->user_id));

				if($file->count()) {

					$file_name = $file->first()->file_name;

					return $file_name;
				}


				return "default.jpg";

		}


		public function make_request($fields) {


			$request = $this->db->insert('requests', $fields);

			if($request) {

				session::put("request", "You have successfully requested for a Doctor");

				return true;
			}


			return false;


		}



		public function all_request() {


				$sql = "select *, requests.id as request_id from requests  

				left join specialties
				on requests.specialty_id = specialties.id

				left join request_status
				on requests.request_status = request_status.id

				where requests.patient_id = ?";

				$fields = array(

					'patient_id' => $this->data()->user_id
				);


				$query = $this->db->query($sql, $fields);

				if($query->count()) {

					return $query->result();
				}

				return false;

		}


		public function search($search) {


			$sql = "select *, users.id as user_id from users 

			inner join patients

			on users.id = patients.patient_id


			left join packages

			on patients.package_id = packages.id

			where users.first_name like ? or users.last_name like ? or users.id like ? or users.email like ?";

			$fields = array(

				"first_name" => "%$search%",
				"last_name" => "%$search%", 
				"id" => "%$search%",
				"email" => "%$search%"

			);


			$query = $this->db->query($sql, $fields);

			if($query->count()) {


				return $query->result();
			}


			return false;
 

		}
	}