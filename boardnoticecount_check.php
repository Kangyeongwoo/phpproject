<?php
	include_once ('./dbconfig.php');
  $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

  $boardname = $_POST["boardname"];
  $chapternoticedata_re =$_POST["chapternoticedata_re"];
  $fictiondata_re = $_POST["fictiondata_re"];

  $cookiename=$boardname.':'.$fictiondata_re.':'.$chapternoticedata_re;

  if(empty($_COOKIE[$cookiename])){
    setcookie($cookiename,$cookiename,time() + (86400), "/");
    $q = "UPDATE chapternoticedata SET chapternotice_count = chapternotice_count + 1 where chapternotice_fictionid='$fictiondata_re' AND chapternotice_number='$chapternoticedata_re'";
    $mysqli->query( $q);

     $mysqli->close();
    echo $cookiename;
  }else{
    echo $_COOKIE[$cookiename];
  }

?>
