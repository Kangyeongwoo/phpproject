<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}
session_start();
extract($_POST);

         if($_SESSION['usernickname']===$commentauthor){

         $q = "DELETE FROM commentdata WHERE idcommentdata='$idcommentdata'";

         $mysqli->query( $q);



         $q3="UPDATE postdata SET commentcount=commentcount -1 WHERE idpostdata='$idpostdata'";

         $mysqli->query( $q3);



         $mysqli->close();

         header('Location: ./main.html?categoryid=3&subnoticecategory='.$dfsubnoticecategory.'');
         exit();



         }else{
         echo '<script>alert("잘못된 접근입니다.");document.location.href="./main.html";</script>';
         }

?>
