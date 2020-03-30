<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
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
      }
    </style>
  </head>
  <body>
    <section>
      <div class="eventzone" style="z-index:1;">

        <img src="./siteimage/sitemainimage.jpg" alt="메인" draggable="false" style="width: 800px; height: 300px;">

      </div>
      <!-- 웹소설 -->
      <div class="popfiction" style="text-align:LEFT;">
        <?php

           $q2 = "SELECT COUNT(*) as cnt FROM fictiondata";
           $result2 = $mysqli->query($q2);
           $countdata=mysqli_fetch_assoc($result2);
           $totalcount =  $countdata["cnt"];

        ?>
        <!-- 웹소설 타이틀바 -->
         <div class="popfictiontitle" style="display:grid;  grid-template-columns: 1fr 0.1fr;"  >
           <p style="padding-left:5px; padding-top:8px;font-size:16px;">인기소설(<?php echo $totalcount; ?>)</p>
            <input type="button" name="" class="btn btn-default" value="더보기 >" style="width:100px;font-size:16px;" onClick="location.href='main.html?categoryid=1'">
         </div>
        <!-- 웹소설 리스트 -->
        <?php

           $q = "SELECT * FROM fictiondata order by fiction_count desc limit 0,5";
           $result = $mysqli->query( $q);
           if($result->num_rows === 0 ){ ?>
               <p style=" padding-top:50px; background-color:#D8D8D8;text-align:center;height:150px;margin-bottom: -0px;font-size:30px;"> 등록된 작품이 없습니다.</p>
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

      </div><!-- 웹소설끝 -->






    </section>
  </body>
</html>
