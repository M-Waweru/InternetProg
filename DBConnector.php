<?php 
	define ('DB_SERVER', 'localhost');
	define ('DB_USER', 'root');
	define ('DB_PASS', '');
	define ('DB_NAME', 'btc3205');

	class DBConnector{
		public $conn;

		function  __construct(){
			$this->conn = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die("Error: ".mysql_error($this->conn));
			mysql_select_db($this->conn,DB_NAME);
			// print_r($this->conn);
			// echo "Connected";
		}

		public function closeDatabase(){
			mysql_close($this->conn);
			return 1;
		}
	}
 ?>