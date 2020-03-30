<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}

extract($_POST);
$originalnickname;


$q = "UPDATE userprofill SET password='$pw1', nickname='$nickname' WHERE id='$uid'";

$mysqli->query( $q);


$q2 = "UPDATE postdata SET author='$nickname' WHERE author='$originalnickname'";

$mysqli->query( $q2);


$q3 = "UPDATE commentdata SET author='$nickname' WHERE author='$originalnickname'";

$mysqli->query( $q3);

$q4 = "UPDATE chaptercommentdata SET author='$nickname' WHERE author='$originalnickname'";

$mysqli->query( $q4);

$q5 = "UPDATE chapternoticecommentdata SET author='$nickname' WHERE author='$originalnickname'";

$mysqli->query( $q5);

$q6 = "UPDATE fictiondata SET fiction_author='$nickname' WHERE fiction_author='$originalnickname'";

$mysqli->query( $q6);

$mysqli->close();

header('Location: ./logout.html');


exit();


?>
