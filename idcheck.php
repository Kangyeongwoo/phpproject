<?php
	include_once ('./dbconfig.php');
  $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
	$uid = $_POST["uid"];
	$q = "SELECT * FROM userprofill where id='$uid'";
  $result = $mysqli->query( $q);
  $member =$result->fetch_array();
	if($member==0){
    echo 1;
  }
   else{
    echo 2;
  }
?>
