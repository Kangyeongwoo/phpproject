<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
session_start();
$_SESSION['userid'];
$dfuid=$_SESSION['userid'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">

    .popfiction{
      width: 800px;
      background-color: white;
      margin-top: 5px;
      margin-bottom: 10px;
      display:inline-block;
    }

    .fictiongrid{
      display: grid;
      box-shadow: 2px 2px 2px #d3d3d3;
      grid-template-columns: 1fr 3fr;
      grid-template-rows: 25px 50px 25px;
      margin-bottom: 30px;
      margin-left: 20px;
      margin-right: 20px;
      margin-top: 30px;
    }
    .fiction_image{
      grid-row: 1/4;
      grid-column: 1/2;

    }
     .fiction_tilte{
       grid-row: 1/2;
       grid-column: 2/3;
       font-size:18px;
       font-weight:bold;
       margin-left: 20px;
     }.fiction_description{
       grid-row: 2/3;
        grid-column: 2/3;
        font-size:15px;
        margin-left: 20px;
     }.fiction_detail{
       grid-row: 3/4;
         grid-column: 2/3;
         font-size:15px;
        margin-left: 20px;
     }
     .popbook{
       width: 800px;
       background-color: white;
       margin-top: 5px;
       display:inline-block;
     }
     .bookgrid{
       display: grid;
       grid-template-columns: 1fr 3fr;
       grid-template-rows: 25px 50px 25px;
       margin-bottom: 10px;
       margin-left: 20px;
       margin-right: 20px;
       margin-top: 10px;
     }
     .book_image{
       grid-row: 1/4;
       grid-column: 1/2;

     }
      .book_tilte{
        grid-row: 1/2;
        grid-column: 2/3;
        font-size:18px;
        font-weight:bold;
        margin-left: 20px;
      }.book_description{
        grid-row: 2/3;
         grid-column: 2/3;
         font-size:15px;
         margin-left: 20px;
      }.book_detail{
        grid-row: 3/4;
          grid-column: 2/3;
          font-size:15px;
         margin-left: 20px;
      }#page{
        text-align: center;
        margin-top:3px;
      }
    </style>
  </head>
  <body>
    <section>
      <?php
       $page=$_GET['page'];
       if(empty($page)){
         $page=1;
       }
        ?>
      <!-- 웹소설 -->
      <div class="popfiction" style="text-align:LEFT;">



        <!-- 웹소설 리스트 -->
        <?php

        $q3 = "SELECT COUNT(*) as cnt FROM favoritefictiondata WHERE favoritefiction_userid='$dfuid'";
        $result3 = $mysqli->query($q3);
        $row=mysqli_fetch_assoc($result3);

        $allpost = $row['cnt']; //전체 게시글의 수

        $onepage=10; // 한 페이지에 보여줄 게시글의 수.

        $total_page = ceil($allpost / $onepage); //전체 페이지의 수

        if(is_numeric($page)==false||$page<0||$page>$total_page&&$total_page!=0){
          ?>
          <script type="text/javascript">
            alert("잘못된 접근입니다.");
            location.href="./main.html";
          </script>
          <?php
        }

        $limit_start=($onepage*($page-1));

        $block_num=10;

        $block=ceil($page/$block_num);
        $block_start=(($block -1)*$block_num)+1;
        $block_end=$block_start+$block_num-1;

        if($block_end > $total_page){
          $block_end=$total_page;
        }
        $total_block=ceil($total_page/$block_num);


        $q2 = "SELECT * FROM favoritefictiondata WHERE favoritefiction_userid='$dfuid' order by idfavoritefictiondata desc limit $limit_start,$onepage ";
        $result2 = $mysqli->query( $q2);
        if($result2->num_rows === 0 ){ ?>
            <p style=" padding-top:50px; background-color:#D8D8D8;text-align:center;height:150px;margin-bottom: -0px;font-size:30px;"> 등록된 작품이 없습니다.</p>
      <?php  }else{
        date_default_timezone_set('Asia/Seoul');
        $curdate = date("Y-m-d");

        while($myfictionlist2 =$result2->fetch_array()){
          $dffid = $myfictionlist2["favoritefiction_fictionid"];
          $q = "SELECT * FROM fictiondata WHERE idfictiondata='$dffid'";
          $result = $mysqli->query( $q);
          $myfictionlist =$result->fetch_array();
          $myfictionlist["idfictiondata"];
          $myfictionlist["fiction_imagepath"];
          $myfictionlist["fiction_title"];
          $myfictionlist["fiction_pricecategory"];
          $myfictionlist["fiction_description"];
          $myfictionlist["fiction_count"];
          $myfictionlist["fiction_genre"];
          $myfictionlist["fiction_author"];
          $dateorigin=$myfictionlist['fiction_newdate'];
          $date=explode(' ',$dateorigin);

        ?>


         <div class="fictiongrid" style=" cursor: pointer;" onClick="fictionlist_<?php echo $myfictionlist["idfictiondata"]; ?>_click();">
            <form class="" name="fictionlistfrm_<?php echo $myfictionlist["idfictiondata"]; ?>" action="./fictionhome.html" method="get">
            <input type="hidden" name="fictionid" value="<?php echo $myfictionlist["idfictiondata"]; ?>">
            </form>
            <script>
            function fictionlist_<?php echo $myfictionlist["idfictiondata"]; ?>_click(){
              document.fictionlistfrm_<?php echo $myfictionlist["idfictiondata"]; ?>.submit();
            }
            </script>

          <div class="fiction_image" >
              <img src="<?php echo $myfictionlist["fiction_imagepath"]; ?>" alt="" draggable="false" style="width: 100%; height: 100%;">
          </div>
          <div class="fiction_tilte" >
            <?php
              if($curdate==$date[0]){?>
                <img style="float:left;margin-top:4px;margin-right:4px;" src="./siteimage/newimage.png" alt="">
            <?php   }else{

              }
            ?>
            <p style="float:left;margin-right:10px;">[<?php echo $myfictionlist["fiction_pricecategory"]; ?>]</p>

            <p style="float:left"><?php echo $myfictionlist["fiction_title"]; ?></p>
                </div>
          <div class="fiction_description" >
             <p style="float:left"><?php echo $myfictionlist["fiction_description"]; ?></p>
          </div>
          <div class="fiction_detail" >
              <i style="float:left;margin-right:5px;">
                 <img src="./siteimage/view.png" alt="" style="max-height:15px;">
              </i>
              <p style="float:left;margin-right:10px;"><?php echo $myfictionlist["fiction_count"]; ?> </p>
              <i style="float:left;margin-right:5px;">
                 <img src="./siteimage/star.png" alt="" style="max-height:15px;">
              </i>
              <p style="float:left;margin-right:10px;"><?php echo $myfictionlist["fiction_favorite"]; ?> </p>
              <p style="float:left;margin-right:10px;"> | <?php echo $myfictionlist["fiction_genre"]; ?>  |</p>
              <p style="float:left">  <?php echo $myfictionlist["fiction_author"]; ?></p>
          </div>

        </div>
       <!-- 웹소설 리스트끝 -->
        <?php
      }
    }?>

       <!-- 웹소설 리스트끝 -->
       <?php if(!empty($allpost)){ ?>
               <div class="" id="page">
                <!-- 처음 버튼 -->
                 <?php
                    if($page<=1){
                 ?>
                      <span>처음</span>
                 <?php
                    }else{
                 ?>
                      <a href="./userpage.html?usercategoryid=2&page=1">처음</a>

                 <?php } ?>

                 <!-- 이전 버튼 -->
                 <?php
                    if($block<=1){
                     echo "";
                 ?>
                 <?php
                    }else{
                      $prev_block = $block_start-1;
                 ?>
                      <a href="./userpage.html?usercategoryid=2&page=<?php echo $prev_block; ?>">이전</a>

                 <?php } ?>

                 <!-- 숫자 버튼 -->
                 <?php
                    for($i=$block_start; $i<=$block_end; $i++){
                      if($page==$i){
                 ?>
                         <span>[<?php echo $i; ?>]</span>
                 <?php
                      }else{
                 ?>
                        <a href="./userpage.html?usercategoryid=2&page=<?php echo $i; ?>">[<?php echo $i; ?>]</a>
                 <?php
                      }
                    }
                 ?>
                <!-- 다음 버튼 -->
                 <?php if($block >= $total_block){
                   echo "";
                 }else{
                   $next_block=$block_end +1;
                    ?>
                    <a href="./userpage.html?usercategoryid=2&page=<?php echo $next_block; ?>">다음</a>
                  <?php } ?>
                 <!-- 마지막 버튼 -->
                 <?php if($page>=$total_page){ ?>
                   <span>마지막</span>
                <?php }else{ ?>
                   <a href="./userpage.html?usercategoryid=2&page=<?php echo $total_page; ?>">마지막</a>
                <?php } ?>
               </div>
       <?php }else{} ?>




      </div><!-- 웹소설끝 -->






    </section>
  </body>
</html>
