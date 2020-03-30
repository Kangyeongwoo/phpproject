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

    $q = "UPDATE postdata SET author='$author', title='$title', description='$description', category='$category' WHERE idpostdata='$idpostdata'";


    $mysqli->query( $q);

    $mysqli->close();

    header('Location: ./main.html?categoryid=3');

    exit();


  }

}



?>
