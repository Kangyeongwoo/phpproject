<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}

$uid = $_POST["uid"];
$favoritefictiondata=$_POST["favoritefictiondata"];

$q ="SELECT * FROM favoritefictiondata WHERE favoritefiction_userid='$uid' AND favoritefiction_fictionid='$favoritefictiondata'";

$result = $mysqli->query( $q);
$member =$result->fetch_array();

if(empty($member)) {

  $q2 = "INSERT INTO favoritefictiondata ( favoritefiction_userid, favoritefiction_fictionid ) VALUES ( '$uid', '$favoritefictiondata' )";

  $mysqli->query( $q2);

  $q3="UPDATE fictiondata SET fiction_favorite = fiction_favorite + 1 WHERE idfictiondata='$favoritefictiondata'";
  $mysqli->query( $q3);

  $q4 ="SELECT fiction_favorite FROM fictiondata WHERE idfictiondata='$favoritefictiondata'";

  $result2 = $mysqli->query( $q4);
  $member2 =$result2->fetch_array();

  echo "ok,";
  echo $member2["fiction_favorite"];
  $mysqli->close();





}else{


    $q2 = "DELETE FROM favoritefictiondata WHERE favoritefiction_userid='$uid' AND favoritefiction_fictionid='$favoritefictiondata'";
    $mysqli->query( $q2);

    $q3="UPDATE fictiondata SET fiction_favorite= fiction_favorite - 1 WHERE idfictiondata='$favoritefictiondata'";
    $mysqli->query( $q3);

    $q4 ="SELECT fiction_favorite FROM fictiondata WHERE idfictiondata='$favoritefictiondata'";

    $result2 = $mysqli->query( $q4);
    $member2 =$result2->fetch_array();

    echo "no,";
    echo $member2["fiction_favorite"];
    $mysqli->close();



}

?>
