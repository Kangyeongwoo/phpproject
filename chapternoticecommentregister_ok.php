<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}

extract($_POST);

$commentauthor;
$fictionid;
$chapter;
$commentdescription;
date_default_timezone_set('Asia/Seoul');
$commentdate = date("Y-m-d H:i:s");

$q = "INSERT INTO chapternoticecommentdata ( author, description, chapternoticedataid, date ,fictiondataid ) VALUES ( '$commentauthor', '$commentdescription', '$chapter','$commentdate','$fictionid')";
$mysqli->query( $q);

$q3="UPDATE chapternoticedata SET chapternotice_commentcount= chapternotice_commentcount + 1 WHERE chapternotice_fictionid='$fictionid' AND chapternotice_number='$chapter'";
$mysqli->query( $q3);




$mysqli->close();

header('Location: fictionhome.html?fictionid='.$fictionid.'&notice='.$chapter.'');

exit();

?>
