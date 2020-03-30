<?php
session_start();
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
$dfuserid=$_SESSION['userid'];
$dfnickname = $_SESSION['usernickname'];
$dfmybuylistcategoryid = $_GET['mybuylistcategoryid'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">

    .buylist{
      display:inline-block;
      background-color:white;
      width:800px;
      height:auto;
      margin-bottom:-6px;
    }
      .mybuylist_container{
        margin-top:10px;
        width: 800px;
        background-color: white;
        display: inline-block;
        margin-bottom: 5px;
      }
      .mybuylistcategory{
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 40px;
      }
      .list-buytable thead th{
        text-align: center;
      height:40px;
      border-top:2px solid #09C;
      border-bottom:1px solid #CCC;
      font-weight: bold;
      font-size: 17px;
      }
      .list-buytable tbody td{
      text-align:center;
      padding:10px 0;
      border-bottom:1px solid #CCC; height:20px;
      font-size: 14px
      }
      #page{
        text-align: center;
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
      <div class="mybuylist_container">
        <div class="mybuylistcategory" >
          <div class="">
            <?php if($dfmybuylistcategoryid==1){?>
            <form class="" action="userpage.html" method="get">
              <input type="hidden" name="usercategoryid" value="6">
              <input type="hidden" name="mybuylistcategoryid" value="1">
              <input type="submit" name="" class="btn btn-default btcustom2"  value="콘탠츠 구매 목록">
            </form>
          <?php }else{?>
            <form class="" action="userpage.html" method="get">
              <input type="hidden" name="usercategoryid" value="6">
              <input type="hidden" name="mybuylistcategoryid" value="1">
              <input type="submit" name="" class="btn btn-default btcustom1"  value="콘탠츠 구매 목록">
            </form>
          <?php } ?>
          </div>
          <div class="">
            <?php if($dfmyfictioncategoryid==2){ ?>
            <form class="" action="userpage.html" method="get">
              <input type="hidden" name="usercategoryid" value="6">
              <input type="hidden" name="mybuylistcategoryid" value="2">
              <input type="submit" name="" class="btn btn-default btcustom2" value="결제 내역">
            </form>
          <?php }else{ ?>
            <form class="" action="userpage.html" method="get">
              <input type="hidden" name="usercategoryid" value="6">
              <input type="hidden" name="mybuylistcategoryid" value="2">
              <input type="submit" name="" class="btn btn-default btcustom1" value="결제 내역">
            </form>
          <?php } ?>
          </div>
        </div>
      </div>



      <!-- 결제-->
      <div class="buylist" style="text-align:LEFT;margin-bottom:10px;">

        <!-- 결제 리스트 -->
     <?php if($dfmybuylistcategoryid==="2"){ ?>
        <table class="list-buytable" >
          <thead>
              <tr>
                    <th width="200">결제종류</th>
                    <th width="400">결제금액</th>
                    <th width="200">결제일</th>

              </tr>

          </thead>
            <?php

            $q3 = "SELECT COUNT(*) as cnt FROM chargedata WHERE charge_userid='$dfuserid' order by idchargedata desc";
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


               $q = "SELECT * FROM chargedata WHERE charge_userid='$dfuserid' order by idchargedata desc limit $limit_start,$onepage ";
               $result = $mysqli->query( $q);
               if($result->num_rows === 0 ){ ?>
                   <p style=" padding-top:50px; background-color:#D8D8D8;text-align:center;height:150px;margin-bottom: -0px;font-size:30px;"> 구매 내역이 없습니다.</p>
             <?php  }else{

               while($mybuylist =$result->fetch_array()){

            ?>

           <tbody >

            <tr >
              <td width="200"><?php echo $mybuylist['charge_pay']; ?></td>

              <td width="400"><?php echo $mybuylist['charge_coin']; ?> 원</td>

              <td width="200"><?php echo $mybuylist['charge_date']; ?></td>

            </tr>
          </tbody>

        <?php }
      } ?>
        </table>
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
               <a href="./userpage.html?usercategoryid=6&mybuylistcategoryid=2&page=1">처음</a>

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
               <a href="./userpage.html?usercategoryid=6&mybuylistcategoryid=2&page=<?php echo $prev_block; ?>">이전</a>

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
                 <a href="./userpage.html?usercategoryid=6&mybuylistcategoryid=2&page=<?php echo $i; ?>">[<?php echo $i; ?>]</a>
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
             <a href="./userpage.html?usercategoryid=6&mybuylistcategoryid=2&page=<?php echo $next_block; ?>">다음</a>
           <?php } ?>
          <!-- 마지막 버튼 -->
          <?php if($page>=$total_page){ ?>
            <span>마지막</span>
         <?php }else{ ?>
            <a href="./userpage.html?usercategoryid=6&mybuylistcategoryid=2&page=<?php echo $total_page; ?>">마지막</a>
         <?php } ?>
        </div>
<?php }else{} ?>

     <!-- 콘텐츠 구매내역 -->
      <?php }elseif($dfmybuylistcategoryid==="1"){  ?>
        <table class="list-buytable" >
          <thead>
              <tr>
                    <th width="200">작품명</th>
                    <th width="400">글제목</th>
                    <th width="100">구매금액</th>
                    <th width="100">구매일</th>

              </tr>

          </thead>
            <?php

            $q3 = "SELECT COUNT(*) as cnt FROM buydata WHERE buy_userid='$dfuserid' AND buy_fictiontitle IS NOT NULL order by idbuydata desc ";
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


               $q = "SELECT * FROM buydata WHERE buy_userid='$dfuserid' AND buy_fictiontitle IS NOT NULL order by idbuydata desc limit $limit_start,$onepage";
               $result = $mysqli->query( $q);

               if($result->num_rows === 0 ){ ?>
                   <p style=" padding-top:50px; background-color:#D8D8D8;text-align:center;height:150px;margin-bottom: -0px;font-size:30px;"> 결제 내역이 없습니다.</p>
             <?php  }else{

               while($mybuylist =$result->fetch_array()){

            ?>

           <tbody >

            <tr >
              <td width="200"><?php echo $mybuylist['buy_fictiontitle']; ?></td>

              <td width="400"><?php echo $mybuylist['buy_chaptertitle']; ?></td>

              <td width="100">100원</td>

              <td width="100"><?php echo $mybuylist['buy_date']; ?></td>

            </tr>
          </tbody>

          <?php }
        } ?>
        </table>
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
               <a href="./userpage.html?usercategoryid=6&mybuylistcategoryid=1&page=1">처음</a>

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
               <a href="./userpage.html?usercategoryid=6&mybuylistcategoryid=1&page=<?php echo $prev_block; ?>">이전</a>

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
                 <a href="./userpage.html?usercategoryid=6&mybuylistcategoryid=1&page=<?php echo $i; ?>">[<?php echo $i; ?>]</a>
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
             <a href="./userpage.html?usercategoryid=6&mybuylistcategoryid=1&page=<?php echo $next_block; ?>">다음</a>
           <?php } ?>
          <!-- 마지막 버튼 -->
          <?php if($page>=$total_page){ ?>
            <span>마지막</span>
         <?php }else{ ?>
            <a href="./userpage.html?usercategoryid=6&mybuylistcategoryid=1&page=<?php echo $total_page; ?>">마지막</a>
         <?php } ?>
        </div>
<?php }else{} ?>

      <?php }else{
        echo '<script>alert("잘못된 접근입니다.");document.location.href="./main.html";</script>';
      } ?>

      </div>





    </section>
  </body>
</html>
