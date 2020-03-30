<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

$boardname = $_POST["boardname"];
$chapterdata_re =$_POST["chapterdata_re"];
$fictiondata_re = $_POST["fictiondata_re"];
$idchapterdata = $_POST["idchapterdata"];
$dfuserid = $_POST["dfuserid"];

$cookiename=$boardname.':'.$fictiondata_re.':'.$chapterdata_re;


  $q4="SELECT buy_chapterid FROM buydata WHERE buy_userid='$dfuserid'";
  $result4=$mysqli->query($q4);
  $buy_chapterlist = array();
  while($mybuylist=$result4->fetch_array()){
    array_push($buy_chapterlist, $mybuylist['buy_chapterid']);
  }

  if(in_array($idchapterdata,$buy_chapterlist)){


    if(empty($dfuserid)==false){

  		 $q3 = "SELECT * FROM favoritefictiondata WHERE favoritefiction_userid='$dfuserid' AND favoritefiction_fictionid='$fictiondata_re'";
       $member = $mysqli->query( $q3);
  		 $result = $member->fetch_array();
  		 if(empty($result)==false){
  			 $q7 = "SELECT * FROM readchapterdata WHERE userid='$dfuserid' AND readfictionid='$fictiondata_re'";
  	     $member7 = $mysqli->query( $q7);
  			 $result7 = $member7->fetch_array();
  			 if(empty($result7)){
            $q5 ="INSERT INTO readchapterdata (userid ,readfictionid, readchapternumber) values ('$dfuserid','$fictiondata_re','$chapterdata_re')";
            $mysqli->query( $q5);
  			 }else{
            $q6 = "UPDATE readchapterdata SET readchapternumber='$chapterdata_re' WHERE userid='$dfuserid' AND readfictionid='$fictiondata_re'";
            $mysqli->query( $q6);
  			 }
  		 }
  	}

    if(empty($_COOKIE[$cookiename])){
      setcookie($cookiename,$cookiename,time() + (86400 * 30), "/");
      $q = "UPDATE chapterdata SET chapter_count = chapter_count + 1 where chapter_fictionid='$fictiondata_re' AND chapter_number='$chapterdata_re'";
      $mysqli->query( $q);

      $q2 = "UPDATE fictiondata SET fiction_count = fiction_count + 1 where idfictiondata='$fictiondata_re'";
      $mysqli->query( $q2);

       $mysqli->close();
      echo $cookiename;
    }else{
      echo $_COOKIE[$cookiename];
    }

  }else{
    echo "no";
  }



 ?>
