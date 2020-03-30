<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}
session_start();
extract($_POST);

         if($_SESSION['usernickname']==$author){

         $q = "DELETE FROM chapternoticedata WHERE idchapternoticedata='$idchapterdata'";



         $mysqli->query( $q);


         $mysqli->close();

         header('Location: ./fictionhome.html?fictionid='.$fictionid.'');
         exit();



         }else{
         echo '<script>alert("잘못된 접근입니다.");document.location.href="./main.html";</script>';
         }

?>
