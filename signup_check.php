<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}
extract($_POST);


if(empty($userid) || empty($password1) || empty($usernickname)){

 echo '<script>alert("입력값이 비어있습니다.");document.location.href="./signup.html";</script>';

}else{

if($password1==$password2){

$q = "INSERT INTO userprofill ( id, password, nickname ) VALUES ( '$userid', '$password1', '$usernickname' )";


$mysqli->query( $q);

$mysqli->close();

//echo '<script>alert("회원가입 성공");</script>';

header('Location: ./login.html');
exit();

}
else{
echo '<script>alert("비밀번호를 똑같이 입력해주세요");document.location.href="./signup.html";</script>';

}


}



?>
