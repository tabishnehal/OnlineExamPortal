<?php
	session_start();
$em=$_SESSION["email"];
require 'require/connection.php';
$sql=<<<EOF
update student set loginvalue=0 where email='$em';
EOF;
	$ret=pg_query($db,$sql);
   	if(!$ret){
     	echo pg_last_error($db);   
   	}
   unset($_SESSION["email"]);
   unset($_SESSION["start_time"]);
   unset($_SESSION["end_time"]);
   unset($_SESSION["Password"]);
   unset($_SESSION['Question']);
   unset($_SESSION['a']);
   unset($_SESSION['b']);
   unset($_SESSION['c']);
   unset($_SESSION['d']);
   unset($_SESSION['id']);
   unset($_SESSION['response']);
   unset($_SESSION['qn']);
header('location:monitor.php');
?>
