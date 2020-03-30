<?php
	include_once ('./dbconfig.php');
  $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

  $boardname = $_POST["boardname"];
  $idpostdata_re =$_POST["idpostdata_re"];


  $cookiename=$boardname.':'.$idpostdata_re;

  if(empty($_COOKIE[$cookiename])){
    setcookie($cookiename,$cookiename,time() + (86400), "/");
    $q = "UPDATE postdata SET count = count + 1 where idpostdata='$idpostdata_re'";
    $mysqli->query( $q);
    $mysqli->close();
    echo $cookiename;
  }else{
    echo $_COOKIE[$cookiename];
  }

?>
