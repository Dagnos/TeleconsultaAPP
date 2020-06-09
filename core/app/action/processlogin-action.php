<?php

// define('LBROOT',getcwd()); // LegoBox Root ... the server root
// include("core/controller/Database.php");

if(Session::getUID()=="") {

$user = $_POST['username'];
//$pass = sha1(md5($_POST['password']));
$pass = $_POST['password'];
$base = new Database();
$conn = $base->connect();

//$serverName = "10.0.0.32"; //serverName\instanceName
//		$connectionInfo = array( "Database"=>"AGRUPADORESFACT", "UID"=>"sa", "PWD"=>"royal2016");
		//$con = sqlsrv_connect( $serverName, $connectionInfo);
//$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}
 $sql = "select * from Usuario where Usuario = '$user'";
//print $sql;
$query = sqlsrv_query($conn, $sql);
$found = false;
$userid = null;
while($r = sqlsrv_fetch_array($query)){
	$found = true ;
	$userid = $r['Usuario'];
}

if($found==true) {
//	session_start();
//	print $userid;
	$_SESSION['user_id']=$userid ;
//	setcookie('userid',$userid);
//	print $_SESSION['userid'];
	print "Cargando ... $user";
	print "<script>window.location='./';</script>";
}else {
	print "<script>window.location='index.php?view=login';</script>";
}

}else{
	print "<script>window.location='./';</script>";
	
}
?>