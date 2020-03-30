<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}
session_start();
extract($_POST);
$fictionid;
$fictionauthor;


         if($_SESSION['usernickname']==$fictionauthor){




          $q3 = "DELETE FROM chaptercommentdata WHERE fictiondataid='$fictionid'";

          $mysqli->query( $q3);
        

          $q5 = "DELETE FROM chapternoticecommentdata WHERE fictiondataid='$fictionid'";

          $mysqli->query( $q5);


         $q6 = "DELETE FROM chapterdata WHERE chapter_fictionid='$fictionid'";

         $mysqli->query( $q6);

         $q7 = "DELETE FROM chapternoticedata WHERE chapternotice_fictionid='$fictionid'";

         $mysqli->query( $q7);

         $q8 = "DELETE FROM favoritefictiondata WHERE favoritefiction_fictionid='$fictionid'";

         $mysqli->query( $q8);


         $q = "DELETE FROM fictiondata WHERE idfictiondata='$fictionid'";

         $mysqli->query( $q);

         $mysqli->close();

         header('Location: ./userpage.html?usercategoryid=4&myfictioncategoryid=1');
         exit();



         }else{
         echo '<script>alert("잘못된 접근입니다.");document.location.href="./main.html";</script>';
         }

?>
