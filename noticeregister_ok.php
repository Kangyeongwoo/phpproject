<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}

extract($_POST);

if(empty($title)){
   echo '<script>alert("제목이 없습니다.");document.location.href="./main.html?categoryid=3";</script>';
}else{

  if(empty($description)){
    echo '<script>alert("내용이 없습니다.");document.location.href="./main.html?categoryid=3";</script>';
  }else{


     date_default_timezone_set('Asia/Seoul');
     $date = date("Y-m-d H:i:s");
     $q = "INSERT INTO postdata ( author, title, description, category, date ) VALUES ( '$author', '$title', '$description','$category','$date' )";


     $mysqli->query( $q);

     $mysqli->close();

     header('Location: ./main.html?categoryid=3');

     exit();

  }
}
?>
