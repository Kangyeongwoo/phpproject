<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}
session_start();
extract($_POST);

         if($_SESSION['usernickname']===$commentauthor){

         $q = "DELETE FROM chapternoticecommentdata WHERE idchapternoticecommentdata='$idchaptercommentdata'";

         $mysqli->query( $q);



         $q3="UPDATE chapternoticedata SET chapternotice_commentcount= chapternotice_commentcount - 1 WHERE chapternotice_fictionid='$fictionid' AND chapternotice_number='$chapter'";

         $mysqli->query( $q3);

         $mysqli->close();


         header('Location: fictionhome.html?fictionid='.$fictionid.'&notice='.$chapter.'');
          exit();



         }else{
         echo '<script>alert("잘못된 접근입니다.");document.location.href="./main.html";</script>';
         }

?>
