<?php

class Executor {

	public static function doit($sql){
		$con = Database::getCon();
		if(Core::$debug_sql){
			print "<pre>".$sql."</pre>";
		}
		return array(sqlsrv_query($con,$sql));
	}
}
?>