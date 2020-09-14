<?php
//data base detail
define( 'DB_HOST', 'localhost');

define( 'DB_USER', 'root');
define( 'DB_PASS', 'root');
define( 'DB_NAME', 'cexwebuy');



class dbopenconn
	{
		var $connection;
		var $db;
		
		// constructor
		function dbopenconn()
		{
		
		}
		
		function dbconnect()
		{
			$connect = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME) or die("could not connect to server");
			// Check connection
			if ($connect->connect_error) {
			  die("Connection failed: " . $conn->connect_error);
			}
			$this->db = $connect;
			
			
		}
	function insert_query($sqltext,$print="")
		{
			$query = $sqltext;
			$result = ($print == "")?mysqli_query($this->db,$query):$query;
			return $result;
		}
	function select_query($sqltext,$print="")
		{
			
			$query = $sqltext;
		   $result = ($print == "")?mysqli_query($this->db,$query):$query;
			return $result;	
			//return mysqli_query($this->db,$query);
		}
		function numRows($result)
		{
			$rows = mysqli_num_rows($result);
			if ($rows === null) 
			{
				return $this->mysqlRaiseError();
			}
			return $rows;
		}
		
	}
	
	
?>