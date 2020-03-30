<?php
	include_once ('./dbconfig.php');
  $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
  session_start();
	$userid = $_SESSION['userid'];
  $boardname = $_POST["boardname"];
  $chapterdata_re =$_POST["chapterdata_re"];
  $fictiondata_re = $_POST["fictiondata_re"];

  $cookiename=$boardname.':'.$fictiondata_re.':'.$chapterdata_re;

  if(empty($userid)==false){

		 $q3 = "SELECT * FROM favoritefictiondata WHERE favoritefiction_userid='$userid' AND favoritefiction_fictionid='$fictiondata_re'";
     $member = $mysqli->query( $q3);
		 $result = $member->fetch_array();
		 if(empty($result)==false){
			 $q4 = "SELECT * FROM readchapterdata WHERE userid='$userid' AND readfictionid='$fictiondata_re'";
	     $member2 = $mysqli->query( $q4);
			 $result2 = $member2->fetch_array();
			 if(empty($result2)){
          $q5 ="INSERT INTO readchapterdata (userid ,readfictionid, readchapternumber) values ('$userid','$fictiondata_re','$chapterdata_re')";
          $mysqli->query( $q5);
			 }else{
          $q6 = "UPDATE readchapterdata SET readchapternumber='$chapterdata_re' WHERE userid='$userid' AND readfictionid='$fictiondata_re'";
          $mysqli->query( $q6);
			 }
		 }
	}


  if(empty($_COOKIE[$cookiename])){
    setcookie($cookiename,$cookiename,time() + (86400), "/");
    $q = "UPDATE chapterdata SET chapter_count = chapter_count + 1 where chapter_fictionid='$fictiondata_re' AND chapter_number='$chapterdata_re'";
    $mysqli->query( $q);

    $q2 = "UPDATE fictiondata SET fiction_count = fiction_count + 1 where idfictiondata='$fictiondata_re'";
    $mysqli->query( $q2);

     $mysqli->close();
    echo $cookiename;
  }else{
    echo $_COOKIE[$cookiename];
  }

?>
