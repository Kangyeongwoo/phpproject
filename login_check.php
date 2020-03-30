<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}
session_start();
extract($_POST);

$q = "SELECT * FROM userprofill WHERE id='$userid'";
$result = $mysqli->query( $q);


if($result->num_rows==1) {
    //해당 ID 의 회원이 존재할 경우
    // 암호가 맞는지를 확인
    if($checkbox==="1"){
      //기억하기 되어 있으면 쿠키생성
      $cookiename="rememberID";
      if(empty($_COOKIE[$cookiename])){
        setcookie($cookiename,$userid, time() + (86400*30), "/");
      }else{
        setcookie($cookiename,$userid, time() + (86400*30), "/");
      }

    }else{
      $cookiename="rememberID";
      if(empty($_COOKIE[$cookiename])){

      }else{

        setcookie($cookiename, "", time() - 3600,"/");
      }
    }


    $row = $result->fetch_array(MYSQLI_ASSOC);
    if( $row['password'] == $password1 ) {
        // 올바른 정보
        $usernickname=$row['nickname'];

    //    header('Location: http://localhost:8082/phpproject/main.html');

    $_SESSION['userid']=$userid;
    $_SESSION['usernickname']=$usernickname;

    ?>

        <form class="logindata" name="frm" action="main.html" method="post">
        <!--  <input type="hidden" name="loginid" value="  "> -->
        </form>
        <script type="text/javascript">
          document.frm.submit();
        </script>

    <?php
        exit();
    }



    else {
        // 암호가 틀렸음

          echo '<script>alert("암호가 틀렸습니다.");document.location.href="./login.html";</script>';
    }

}
else {
    // 없거나, 비정상

  echo '<script>alert("아이디가 존재하지 않습니다.");document.location.href="./login.html";</script>';
}

?>
