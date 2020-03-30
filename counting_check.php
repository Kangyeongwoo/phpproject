<?php
	include_once ('./dbconfig.php');
  $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
  session_start();
  extract($_POST);
  $dfuserid=$_SESSION['userid'];
  $wallet;
  $requestuserid;
  $countingstate;
  $bank;
  $banknumber;
  $username;
  $userphone;
	$useremail;

  if(is_numeric($banknumber)==true&&is_numeric($userphone)==true){
		if($requestuserid==$dfuserid && $countingstate=="off"){
	    $q="UPDATE userprofill SET countingstate = 'on' WHERE id='$requestuserid'";
	    $mysqli->query($q);

	    $q2="INSERT INTO countingdata (requestuserid,username,wallet,bank,banknumber,userphone,useremail) VALUES ('$requestuserid','$username','$wallet','$bank','$banknumber','$userphone','$useremail')";
	    $mysqli->query($q2);
	    ?>
	    <script type="text/javascript">
	      document.location.href="userpage.html?usercategoryid=4&myfictioncategoryid=3";
	    </script>
	    <?php
	  }
	}else if(is_numeric($banknumber)==false&&is_numeric($userphone)==true){
		echo '<script>alert("계좌번호를 숫자형식으로 입력해주세요");document.location.href="./userpage.html?usercategoryid=4&myfictioncategoryid=3";</script>';
	}else if(is_numeric($banknumber)==true&&is_numeric($userphone)==false){
		echo '<script>alert("핸드폰번호를 숫자형식으로 입력해주세요");document.location.href="./userpage.html?usercategoryid=4&myfictioncategoryid=3";</script>';
	}else{
		echo '<script>alert(" 숫자형식으로 입력해주세요");document.location.href="./userpage.html?usercategoryid=4&myfictioncategoryid=3";</script>';

	}






?>
