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
    .buylist_out{
      display:inline-block;
      background-color:white;
      width:800px;
      height:auto;

    }
    .buylist{
      display:inline-block;
      background-color:white;
      width:500px;
      height:auto;
      margin-bottom:10px;
      margin-top:10px;
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
    </style>
  </head>
  <body>
    <section>

      <?php
      $page = $_GET['page'];
      if(empty($page)){
        $page=1;
      }
      ?>

<div class="buylist_out">


<div class="buylist" style="text-align:center;">
 <?php
 $q2 = "SELECT * FROM userprofill WHERE id='$dfuserid' ";
 $result2 = $mysqli->query( $q2);
 $member =$result2->fetch_array();
 $wallet=$member['wallet'];
 $countingstate=$member['countingstate'];
 ?>

 <form class="countingrequestfrm" id="countingrequestfrm" action="countingrequest_ok.php" method="post">
   <div class="" style="margin-bottom:10px;background-color:#e9e9e9;padding-top:10px;padding-bottom:10px;">
     <p style="font-weight:bold;font-size:20px;">정산 신청 가능 금액</p>
     <p><?php echo $wallet; ?> 원</p>

     <?php if($countingstate=="off"){
     if($wallet >= 0&&$wallet <1000){
       ?>
       <input type="button" name="" value="정산 신청" disabled>
     <?php }else{ ?>
        <input type="text" name="wallet" id="wallet" value="" placeholder="금액을 입력해주세요" onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' required > 원

        <script>
function onlyNumber(event){
event = event || window.event;
var keyID = (event.which) ? event.which : event.keyCode;
if ( (keyID >= 48 && keyID <= 57) || (keyID >= 96 && keyID <= 105) || keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 )
return;
else
return false;
}

function removeChar(event) {
event = event || window.event;
var keyID = (event.which) ? event.which : event.keyCode;
if ( keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 )
return;
else
event.target.value = event.target.value.replace(/[^0-9]/g, "");
}
</script>
        <p></p>
        <input type="button" name="" value="정산 신청" onclick="countingrequest();">
     <?php } ?>
   <?php }else{ ?>
     <input type="button" name="" value="정산 신청중" disabled>
     <p><br>*정산 취소를 원하시면 bookchain@naver.com 으로 메일을 보내주세요</p>
   <?php } ?>
     <p><br>* 정산 신청은 1000원 이상부터 가능합니다.</p>
    <!-- <input type="hidden" name="wallet" value="<?php echo $wallet; ?>"> -->
      <input type="hidden" name="requestuserid" value="<?php echo $dfuserid; ?>">
      <input type="hidden" name="countingstate" value="<?php echo $countingstate; ?>">
     <script type="text/javascript">
       function countingrequest(){
         if($('#wallet').val()>=1000){
         var result_js3 = confirm("정산을 신청하시겠습니까?");
         if(result_js3==true){
           $('#countingrequestfrm').submit();
         }else if(result_js3==false){

         }
       }else{
         alert("신청금액은 1000원 이상이어야합니다.");
       }
       }

     </script>
   </div>
 </form>


      <table class="list-buytable" >
        <thead>
            <tr>
                  <th width="200">작품명</th>
                  <th width="400">총 판매건수</th>


            </tr>

        </thead>
          <?php
                    $q3 = "SELECT COUNT(*) as cnt FROM fictiondata  WHERE fiction_author='$dfnickname' AND fiction_pricecategory='유료' order by idfictiondata desc";
                      $result3 = $mysqli->query($q3);

                      if($result3->num_rows === 0 ){ ?>
                          <p style=" padding-top:50px; background-color:#D8D8D8;text-align:center;height:150px;margin-bottom: -0px;font-size:30px;"> 등록된 작품이 없습니다.</p>
                    <?php  }else{


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



             $q = "SELECT * FROM fictiondata WHERE fiction_author='$dfnickname' AND fiction_pricecategory='유료' order by idfictiondata desc  limit $limit_start,$onepage ";
             $result = $mysqli->query( $q);

             while($mybuylist =$result->fetch_array()){

          ?>

         <tbody >

          <tr >

            <td width="200"><?php echo $mybuylist['fiction_title']; ?></td>

            <td width="400"><?php echo $mybuylist['fiction_coin']; ?></td>

          </tr>

        </tbody>

      <?php }} ?>
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
             <a href="./userpage.html?usercategoryid=4&myfictioncategoryid=3&page=1">처음</a>

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
             <a href="./userpage.html?usercategoryid=4&myfictioncategoryid=3&page=<?php echo $prev_block; ?>">이전</a>

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
               <a href="./userpage.html?usercategoryid=4&myfictioncategoryid=3&page=<?php echo $i; ?>">[<?php echo $i; ?>]</a>
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
           <a href="./userpage.html?usercategoryid=4&myfictioncategoryid=3&page=<?php echo $next_block; ?>">다음</a>
         <?php } ?>
        <!-- 마지막 버튼 -->
        <?php if($page>=$total_page){ ?>
          <span>마지막</span>
       <?php }else{ ?>
          <a href="./userpage.html?usercategoryid=4&myfictioncategoryid=3&page=<?php echo $total_page; ?>">마지막</a>
       <?php } ?>
      </div>
<?php }else{} ?>

   </div>

  </div>

    </section>
  </body>
</html>
