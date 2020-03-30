<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}
session_start();
extract($_POST);

         if($_SESSION['usernickname']==$author){

         $q = "DELETE FROM chapterdata WHERE idchapterdata='$idchapterdata'";

         $mysqli->query( $q);

         $q2 = "SELECT * FROM chapterdata WHERE chapter_fictionid='$fictionid' ";
         $result2 = $mysqli->query( $q2);

         while($board2 = $result2->fetch_array())
         {
           if($board2['chapter_number']>$chapternumber){
           $newidchapterdata=$board2['idchapterdata'];
           $dfcapternumber=$board2['chapter_number'];
           $newchpaternumber=$dfcapternumber-1;

           $q3 = "UPDATE chapterdata SET chapter_number='$newchpaternumber' WHERE idchapterdata='$newidchapterdata'";

           $mysqli->query($q3);
           }
         }

         $q4="UPDATE fictiondata SET fiction_totalchapter= fiction_totalchapter - 1 WHERE idfictiondata='$fictionid'";
         $mysqli->query( $q4);

         $mysqli->close();

         header('Location: ./fictionhome.html?fictionid='.$fictionid.'');
         exit();



         }else{
         echo '<script>alert("잘못된 접근입니다.");document.location.href="./main.html";</script>';
         }

?>
