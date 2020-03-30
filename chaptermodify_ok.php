<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}

extract($_POST);

if(empty($chaptertitletext)||empty($chapterdescriptiontext)){

 echo '<script>alert("입력값이 없습니다");document.location.href="./fictionhome.html?fictionid='.$idfictiondata.'";</script>';

}else{


$q = "UPDATE chapterdata SET chapter_title='$chaptertitletext', chapter_description='$chapterdescriptiontext', chapter_authorcomment='$authorcommenttext' WHERE chapter_fictionid='$idfictiondata' AND chapter_number='$chapternumber'";

$mysqli->query( $q);

$mysqli->close();

header('Location: ./fictionhome.html?fictionid='.$idfictiondata.'&chapter='.$chapternumber);

exit();

}


?>
