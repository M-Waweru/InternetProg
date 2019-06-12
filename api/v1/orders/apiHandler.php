<?php 
	include_once '../../../DBConnector.php';

	class ApiHandler {
		private $meal_name;
		private $meal_units;
		private $unit_price;
		private $status;
		private $user_api_key;

		public function setMealName($meal_name){
			$this->meal_name = $meal_name;
		}

		public function getMealName(){
			return $this->meal_name;
		}

		public function setMealUnits($meal_units){
			$this->meal_units = $meal_units;
		}

		public function getMealUnits(){
			return $this->meal_units;
		}

		public function setUnitPrice($unit_price){
			$this->unit_price = $unit_price;
		}

		public function getUnitPrice(){
			return $this->unit_price;
		}

		public function setStatus($status){
			$this->status = $status;
		}

		public function getStatus(){
			return $this->status;
		}

		public function setUserApiKey($key){
			$this->key = $key;
		}

		public function getUserApiKey(){
			return $this->key;
		}

		public function createOrder(){
			$con = new DBConnector();
			$res = mysql_query("insert into orders (order_name, units, unit_price, order_status) values('$this->meal_name','$this->meal_units','$this->unit_price','$this->status')") or die ("Error". mysql_error());
			return $res;
		}

		public function checkOrderStatus(){

		}

		public function fetchAllOrders(){

		}

		public function checkApiKey(){
			return true;
		}

		public function checkContetType(){
			
		}
	}

 ?>