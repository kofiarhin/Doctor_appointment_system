<?php 


	class Transactions {

		
		private $db = null;

		public function __construct() {


			$this->db  = db::get_instance();
		}
	}