<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}
session_start();
extract($_POST);
$uid=$_SESSION['userid'];
$chaptertitletext;
$chapterdescriptiontext;
$authorcommenttext;
$idfictiondata;
$fictionpricecategory;
$fictionstartpricechapter;
$writeid;

if(empty($chaptertitletext)||empty($chapterdescriptiontext)){

 echo '<script>alert("입력값이 없습니다");document.location.href="./fictionhome.html?fictionid='.$idfictiondata.'";</script>';

}else{


        date_default_timezone_set('Asia/Seoul');
        $chapterdate = date("Y-m-d H:i:s");
        if($writeid=="1"){
        $q2 = "SELECT * FROM chapterdata WHERE chapter_fictionid='$idfictiondata' order by chapter_number desc limit 1";
        $result2 = $mysqli->query( $q2) or die("Last error: {$mysqli->error}\n");
        $mychapter =$result2->fetch_array();
        $dfchapternumber=$mychapter["chapter_number"];
        $dfchapterid=$mychapter["idchapterdata"];
        if(empty($mychapter["chapter_number"])){
          $chapternumber=1;
        }
        else{
        $chapternumber=$dfchapternumber+1;
        }
        if($fictionpricecategory=="유료"&&$chapternumber>=$fictionstartpricechapter){
          $chaptercategory="유료";
        }else{
          $chaptercategory="무료";
        }

        $q = "INSERT INTO chapterdata ( chapter_fictionid, chapter_description, chapter_authorcomment, chapter_title, chapter_date, chapter_category ,chapter_number ) VALUES ('$idfictiondata', '$chapterdescriptiontext', '$authorcommenttext','$chaptertitletext','$chapterdate','$chaptercategory','$chapternumber')";

        $mysqli->query($q);

        $q3="UPDATE fictiondata SET fiction_totalchapter= fiction_totalchapter + 1 , fiction_newdate ='$chapterdate' WHERE idfictiondata='$idfictiondata'";
        $mysqli->query( $q3);


        if($chaptercategory="유료"){

          $q4="SELECT * FROM chapterdata WHERE chapter_fictionid='$idfictiondata' order by idchapterdata desc limit 1";
          $result = $mysqli->query($q4);
          $newchapter = $result->fetch_array();
          $newchapterdata = $newchapter['idchapterdata'];

          $q5="INSERT INTO buydata (buy_userid, buy_chapterid, buy_fictionid ,buy_date) VALUES ('$uid','$newchapterdata','$idfictiondata','$chapterdate')";
          $mysqli->query( $q5);

        }else{

        }


        $mysqli->close();

        header('Location: ./fictionhome.html?fictionid='.$idfictiondata.'');

        exit();

        }elseif($writeid=="2"){

          $q2 = "SELECT * FROM chapternoticedata WHERE chapternotice_fictionid='$idfictiondata' order by chapternotice_number desc limit 1";
          $result2 = $mysqli->query( $q2) or die("Last error: {$mysqli->error}\n");
          $mychapter =$result2->fetch_array();
          $dfchapternoticenumber=$mychapter["chapternotice_number"];
          if(empty($mychapter["chapternotice_number"])){
            $chapternoticenumber=1;
          }
          else{
          $chapternoticenumber=$dfchapternoticenumber+1;
          }
          $q = "INSERT INTO chapternoticedata ( chapternotice_fictionid, chapternotice_description, chapternotice_title, chapternotice_date, chapternotice_number ) VALUES ('$idfictiondata', '$chapterdescriptiontext','$chaptertitletext','$chapterdate','$chapternoticenumber')";

          $mysqli->query($q);

          $mysqli->close();

          header('Location: ./fictionhome.html?fictionid='.$idfictiondata.'');

          exit();

        }else{
        }


}

?>
