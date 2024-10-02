<?php 
/**
 * 
 */
class Database{

	private $server;
	private $user;	
	private $pwd;	
	private $db;
	public $conn;	
	function __construct(){
		$this->dbconnect();
	}

	function dbconnect(){
		$this->server = "localhost";
		$this->user = "root";
		$this->pwd = "";
		$this->db = "ngweisheng";

		$this->conn = new mysqli($this->server,$this->user,$this->pwd,$this->db);

		return $this->conn;
	}

	// 	function dbconnect(){
	// 	$this->server = "server621.iseencloud.com";
	// 	$this->user = "jomjomco_ngweisheng";
	// 	$this->pwd = "1215weisheng";
	// 	$this->db = "jomjomco_ngweisheng_market";

	// 	$this->conn = new mysqli($this->server,$this->user,$this->pwd,$this->db);

	// 	return $this->conn;
	// }
}


?>