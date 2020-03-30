<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}

extract($_POST);

$commentauthor;
$commentpostid;
$commentdescription;
date_default_timezone_set('Asia/Seoul');
$commentdate = date("Y-m-d H:i:s");

if(mb_strlen($commentdescription,"UTF-8")<=500){

$q = "INSERT INTO commentdata ( author, description, postdataid, date ) VALUES ( '$commentauthor', '$commentdescription', '$commentpostid','$commentdate')";

$mysqli->query( $q);


$q3="UPDATE postdata SET commentcount=commentcount +1 WHERE idpostdata='$commentpostid'";
$mysqli->query( $q3);

$mysqli->close();

header('Location: ./main.html?categoryid=3&subnoticecategory='.$commentpostid.'');

exit();

}else{
  header('Location: ./main.html?categoryid=3&subnoticecategory='.$commentpostid.'');
}
?>
