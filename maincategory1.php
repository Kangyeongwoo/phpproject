<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
$page = $_GET['page'];
if(empty($page)){
  $page=1;
}
if(empty($_GET["subcategoryid"])){
  $dfsubcategoryid ="1";
}else{
  $dfsubcategoryid = $_GET["subcategoryid"];
  if($dfsubcategoryid==="1"||$dfsubcategoryid==="2"||$dfsubcategoryid==="3"||$dfsubcategoryid==="4"||$dfsubcategoryid==="5"){

  }else{
    echo '<script>alert("잘못된 접근입니다.");document.location.href="./main.html";</script>';

  }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    .fictioncategorybar_container{
      width: 800px;
      display: inline-block;
      background-color: white;
      margin-top: 5px;
      margin-bottom: 5px;

    }
    .fictioncategorybar{

      width: 800px;
      height: auto;
      background-color: white;
     display: grid;
     grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
     grid-template-rows: 40px;

    }

    .fictionpricecategory_container{
      width: 800px;
      height: 40px;
      background-color: white;
      display: inline-block;
      margin-top: 5px;
      margin-bottom: 1px;
    }
    .fictionpricecategory{
      width: 800px;
      height: auto;
      background-color: white;
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      grid-template-rows: 30px;
    }
    .fictionpagelist{
      width:800px;
      height: auto;
      background-color: white;
      display: inline-block;
      margin-bottom: 10px;

    }
    .fictionpagegrid{
      display: grid;
      box-shadow: 2px 2px 2px #d3d3d3;
      grid-template-columns: 1fr 3fr;
      grid-template-rows: 25px 50px 25px;
      margin-bottom: 30px;
      margin-left: 20px;
      margin-right: 20px;
      margin-top: 30px;
    }
    .fictionpage_image{
      grid-row: 1/4;
      grid-column: 1/2;

    }
     .fictionpage_tilte{
       grid-row: 1/2;
       grid-column: 2/3;
       font-size:18px;
       font-weight:bold;
       margin-left: 20px;
     }.fictionpage_description{
       grid-row: 2/3;
        grid-column: 2/3;
        font-size:15px;
        margin-left: 20px;
     }.fictionpage_detail{
       grid-row: 3/4;
         grid-column: 2/3;
         font-size:15px;
        margin-left: 20px;
     }
     #page{
       margin-top:2px;
     }
    </style>
  </head>
  <body>
    <section>
      <div class="fictioncategorybar_container">
        <div class="fictioncategorybar" >
          <?php
          if($dfsubcategoryid==="1"){
           ?>
            <form class="fictioncategory_fantasy" action="main.html" method="get">
               <input type="hidden" name="categoryid" value="1">
               <input type="hidden" name="subcategoryid" value="1">
               <input type="submit" name="" class="btn btn-default btcustom2" value="판타지" style="width:160px;">
            </form>
          <?php }else{
          ?>
          <form class="fictioncategory_fantasy" action="main.html" method="get">
             <input type="hidden" name="categoryid" value="1">
             <input type="hidden" name="subcategoryid" value="1">
             <input type="submit" name="" class="btn btn-default btcustom1" value="판타지" style="width:160px;">
          </form>
          <?php
          } ?>
          <?php
          if($dfsubcategoryid==="2"){
           ?>
            <form class="fictioncategory_todayfantasy" action="main.html" method="get">
              <input type="hidden" name="categoryid" value="1">
              <input type="hidden" name="subcategoryid" value="2">
              <input type="submit" name="" value="현대판타지" class="btn btn-default btcustom2" style="width:160px;">
            </form>
          <?php }else{
          ?>
          <form class="fictioncategory_todayfantasy" action="main.html" method="get">
            <input type="hidden" name="categoryid" value="1">
            <input type="hidden" name="subcategoryid" value="2">
            <input type="submit" name="" value="현대판타지" class="btn btn-default btcustom1" style="width:160px;">
          </form>
          <?php
          } ?>
          <?php
          if($dfsubcategoryid==="3"){
           ?>
             <form class="fictioncategory_lomancefantasy" action="main.html" method="get">
               <input type="hidden" name="categoryid" value="1">
               <input type="hidden" name="subcategoryid" value="3">
               <input type="submit" name="" value="로맨스판타지" class="btn btn-default btcustom2" style="width:160px;">
             </form>
           <?php }else{
           ?>
           <form class="fictioncategory_lomancefantasy" action="main.html" method="get">
             <input type="hidden" name="categoryid" value="1">
             <input type="hidden" name="subcategoryid" value="3">
             <input type="submit" name="" value="로맨스판타지" class="btn btn-default btcustom1" style="width:160px;">
           </form>
           <?php
           } ?>
           <?php
           if($dfsubcategoryid==="4"){
            ?>
             <form class="fictioncategory_muhub" action="main.html" method="get">
               <input type="hidden" name="categoryid" value="1">
               <input type="hidden" name="subcategoryid" value="4">
               <input type="submit" name="" value="무협" class="btn btn-default btcustom2" style="width:160px;">
             </form>
           <?php }else{
           ?>
           <form class="fictioncategory_muhub" action="main.html" method="get">
             <input type="hidden" name="categoryid" value="1">
             <input type="hidden" name="subcategoryid" value="4">
             <input type="submit" name="" value="무협" class="btn btn-default btcustom1" style="width:160px;">
           </form>
           <?php
           } ?>
           <?php
           if($dfsubcategoryid==="5"){
            ?>
            <form class="fictioncategory_lomance" action="main.html" method="get">
               <input type="hidden" name="categoryid" value="1">
               <input type="hidden" name="subcategoryid" value="5">
               <input type="submit" name="" value="로맨스" class="btn btn-default btcustom2" style="width:160px;">
             </form>
           <?php }else{
           ?>
           <form class="fictioncategory_lomance" action="main.html" method="get">
              <input type="hidden" name="categoryid" value="1">
              <input type="hidden" name="subcategoryid" value="5">
              <input type="submit" name="" value="로맨스" class="btn btn-default btcustom1" style="width:160px;">
            </form>
           <?php
           } ?>

        </div>
      </div>

      <div class="promotionzone">
        <img src="./siteimage/sitemainimage.jpg" alt="메인" draggable="false" style="width: 800px; height: 300px;">
      </div>


        <div class="fictionpagelist">
      <?php


         if($dfsubcategoryid==="1"){
           $realsub="판타지";
         }elseif($dfsubcategoryid==="2"){
            $realsub="현대판타지";
         }elseif($dfsubcategoryid==="3"){
            $realsub="로맨스판타지";
         }elseif($dfsubcategoryid==="4"){
            $realsub="무협";
         }elseif($dfsubcategoryid==="5"){
            $realsub="로맨스";
         }


                 //페이징 위한 카운트

                 $q3 = "SELECT COUNT(*) as cnt FROM fictiondata WHERE fiction_genre='$realsub' AND fiction_pricecategory='무료' ";
                 $result3 = $mysqli->query($q3);
                 $row=mysqli_fetch_assoc($result3);

                 $allpost = $row['cnt']; //전체 게시글의 수

                 $onepage=10; // 한 페이지에 보여줄 게시글의 수.

                 $total_page = ceil($allpost / $onepage); //전체 페이지의 수

                 if(is_numeric($page)==false||$page<0||$page>$total_page&&$total_page!=0){
                   echo '<script>alert("잘못된 접근입니다.");document.location.href="./main.html?categoryid=1";</script>';
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
                 //페이징 데이터 끝


         $sort = $_GET['sort'];
         if(empty($sort)){
           $sort="1";
         }elseif($sort==="1"||$sort==="2"||$sort==="3"){

         }else{
           echo '<script>alert("잘못된 접근입니다.");document.location.href="./main.html";</script>';
         }
         ?>
         <?php
         if($sort==="1"){?>
           <select name="fiction_sort" id="fiction_sort" style="float:left;margin-top:2px;margin-left:20px;" onchange="javascript:myListener(this);">
             <option id="count" value="1" selected="selected" >조회수 순</option>
             <option id="favorite" value="2" >선호작 순</option>
             <option id="new" value="3" >최신순</option>
           </select>
         <?php }elseif($sort==="2"){ ?>
           <select name="fiction_sort" id="fiction_sort" style="float:left;margin-top:2px;margin-left:20px;" onchange="javascript:myListener(this);">
             <option id="count" value="1" >조회수 순</option>
             <option id="favorite" value="2" selected="selected" >선호작 순</option>
             <option id="new" value="3" >최신순</option>
           </select>
         <?php }elseif($sort==="3"){ ?>
           <select name="fiction_sort" id="fiction_sort" style="float:left;margin-top:2px;margin-left:20px;" onchange="javascript:myListener(this);">
             <option id="count" value="1" >조회수 순</option>
             <option id="favorite" value="2"  >선호작 순</option>
             <option id="new" value="3" selected="selected" >최신순</option>
           </select>
         <?php } ?>
         <script>
        function myListener(obj) {
           if(obj.value=="1"){
              location.href="main.html?categoryid=1&subcategoryid=<?php echo $dfsubcategoryid ?>&sort=1";
           }else if(obj.value=="2"){
              location.href="main.html?categoryid=1&subcategoryid=<?php echo $dfsubcategoryid ?>&sort=2";
           }else if(obj.value=="3"){
              location.href="main.html?categoryid=1&subcategoryid=<?php echo $dfsubcategoryid ?>&sort=3";
           }
         }
       </script>
         <?php
         if($sort==="1"){
           $q = "SELECT * FROM fictiondata WHERE fiction_genre='$realsub' AND fiction_pricecategory='무료' order by fiction_count desc limit $limit_start,$onepage";
         }elseif($sort==="2"){
           $q = "SELECT * FROM fictiondata WHERE fiction_genre='$realsub' AND fiction_pricecategory='무료' order by fiction_favorite desc limit $limit_start,$onepage";
         }elseif($sort==="3"){
           $q = "SELECT * FROM fictiondata WHERE fiction_genre='$realsub' AND fiction_pricecategory='무료' order by fiction_newdate desc limit $limit_start,$onepage";

         }


         $result = $mysqli->query( $q);

         if($result->num_rows === 0 ){ ?>
             <p style=" padding-top:50px; background-color:#D8D8D8;text-align:center;height:150px;margin-bottom: -0px;font-size:30px;"> 등록된 작품이 없습니다.</p>
             <script type="text/javascript">
                 $('#fiction_sort').css("display","none");
             </script>
       <?php  }else{
         date_default_timezone_set('Asia/Seoul');
         $curdate = date("Y-m-d");
         while($myfictionlist =$result->fetch_array()){
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


       <div class="fictionpagegrid" style=" cursor: pointer;" onClick="fictionlist_<?php echo $myfictionlist["idfictiondata"]; ?>_click();">
          <form class="" name="fictionlistfrm_<?php echo $myfictionlist["idfictiondata"]; ?>" action="./fictionhome.html" method="get">
          <input type="hidden" name="fictionid" value="<?php echo $myfictionlist["idfictiondata"]; ?>">
          </form>
          <script>
          function fictionlist_<?php echo $myfictionlist["idfictiondata"]; ?>_click(){
            document.fictionlistfrm_<?php echo $myfictionlist["idfictiondata"]; ?>.submit();
          }
          </script>

        <div class="fictionpage_image" >
            <img src="<?php echo $myfictionlist["fiction_imagepath"]; ?>" alt="" draggable="false" style="width: 100%; height: 100%;">
        </div>
        <div class="fictionpage_tilte" >
          <?php
            if($curdate==$date[0]){?>
              <img style="float:left;margin-top:4px;margin-right:4px;" src="./siteimage/newimage.png" alt="">
          <?php   }else{

            }
          ?>
          <p style="float:left;margin-right:10px;">[<?php echo $myfictionlist["fiction_pricecategory"]; ?>]</p>

          <p style="float:left"><?php echo $myfictionlist["fiction_title"]; ?></p>
          </div>
        <div class="fictionpage_description" >
           <p style="float:left"><?php echo $myfictionlist["fiction_description"]; ?></p>
        </div>
        <div class="fictionpage_detail" >
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
    }//데이터가 있으면 ?>
    <div class="" id="page">
     <!-- 처음 버튼 -->
      <?php
         if($page<=1){
      ?>
           <span>처음</span>
      <?php
         }else{
      ?>
           <a href="./main.html?categoryid=1&subcategoryid=<?php echo $dfsubcategoryid; ?>&sort=<?php echo $sort; ?>&page=1">처음</a>

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
           <a href="./main.html?categoryid=1&subcategoryid=<?php echo $dfsubcategoryid; ?>&sort=<?php echo $sort; ?>&page=<?php echo $prev_block; ?>">이전</a>

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
             <a href="./main.html?categoryid=1&subcategoryid=<?php echo $dfsubcategoryid; ?>&sort=<?php echo $sort ?>&page=<?php echo $i; ?>">[<?php echo $i; ?>]</a>
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
         <a href="./main.html?categoryid=1&subcategoryid=<?php echo $dfsubcategoryid; ?>&sort=<?php echo $sort ?>&page=<?php echo $next_block; ?>">다음</a>
       <?php } ?>
      <!-- 마지막 버튼 -->
      <?php if($page>=$total_page){ ?>
        <span>마지막</span>
     <?php }else{ ?>
        <a href="./main.html?categoryid=1&subcategoryid=<?php echo $dfsubcategoryid; ?>&sort=<?php echo $sort ?>&page=<?php echo $total_page; ?>">마지막</a>
     <?php } ?>
    </div>
   <!--페이징 끝-->

  <?php }?> <!-- 웹소설 리스트끝 -->
    </div>
      </div>
    </section>
  </body>
</html>
