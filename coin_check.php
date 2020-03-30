<?php
	include_once ('./dbconfig.php');
  session_start();
  $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
	$buylist = $_POST["buylist"];
  $fictionid = $_POST["fictionid"];

  $buy_little = explode( ',', $buylist );
  $buy_count = count($buy_little);
  $buy_coin = $buy_count*100;
  $uid= $_SESSION['userid'];
	if(empty($uid)){
		echo '<script>alert("잘못된 접근입니다.");document.location.href="./main.html";</script>';
	}
	
	date_default_timezone_set('Asia/Seoul');
	$buydate = date("Y-m-d H:i:s");

  $q="SELECT * FROM userprofill WHERE id='$uid'";
  $result = $mysqli->query( $q);
  $userdata =$result->fetch_array();
  if($userdata['coin']<$buy_coin){
  ?>
   <script>alert("코인이 부족합니다. 먼저 충전을 해주세요.");
	 document.location.href="./userpage.html?usercategoryid=3";

  // document.location.href="./fictionhome.html?fictionid=<?php echo $fictionid; ?>";
   </script>
  <?php
  }else{
    $q2="SELECT * FROM fictiondata WHERE idfictiondata='$fictionid'";
    $result2 = $mysqli->query( $q2);
    $authordata =$result2->fetch_array();
		$fictiontitle = $authordata['fiction_title'];
		$fictionauthor = $authordata['fiction_author'];

    $q3="UPDATE userprofill SET coin = coin - $buy_coin WHERE id='$uid' ";
    $mysqli->query( $q3);

    $q4="UPDATE fictiondata SET fiction_coin = fiction_coin + $buy_count WHERE idfictiondata='$fictionid' ";
    $mysqli->query( $q4);

		$q5="UPDATE userprofill SET wallet = wallet + $buy_coin WHERE nickname='$fictionauthor' ";
    $mysqli->query( $q5);

    for($i=0; $i<$buy_count;$i++){
    $one = $buy_little[$i];

		$q6="SELECT * FROM chapterdata WHERE idchapterdata='$one'";
    $result3=$mysqli->query( $q6);
		$chapterdata =$result3->fetch_array();
		$chaptertitle= $chapterdata['chapter_title'];

    $q5="INSERT INTO buydata (buy_userid, buy_chapterid, buy_fictionid ,buy_date, buy_fictiontitle, buy_chaptertitle) VALUES ('$uid','$one','$fictionid','$buydate','$fictiontitle','$chaptertitle')";
    $mysqli->query( $q5);
    }
    ?>



     <script>;
		 alert("구매가 완료되었습니다.");
     document.location.href="./fictionhome.html?fictionid=<?php echo $fictionid; ?>";
     </script>
  <?php
  }
?>
