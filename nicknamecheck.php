<?php
	include_once ('./dbconfig.php');
  $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
	$usernickname = $_POST["usernickname"];
	$q = "SELECT * FROM userprofill where nickname='$usernickname'";
  $result = $mysqli->query( $q);
  $member =$result->fetch_array();
	if($member==0){
    echo 1;
  }
   else{
    echo 2;
  }
