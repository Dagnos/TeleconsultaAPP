<?php
class Database {
	public static $db;
	public static $con;
	function Database(){
		$this->user="sa";$this->pass="royal2016";$this->host="localhost";$this->ddbb="AGRUPADORESFACT";
	}

	function connect(){
		//$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb);
		$serverName = "10.0.0.32"; //serverName\instanceName
		$connectionInfo = array( "Database"=>"AGRUPADORESFACT", "UID"=>"sa", "PWD"=>"royal2016");
		$con = sqlsrv_connect( $serverName, $connectionInfo);
		return $con;
	}

	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}
	
}
?>
