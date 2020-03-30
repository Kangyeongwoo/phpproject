<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
session_start();
$_SESSION['userid'];
$_SESSION['usernickname'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>웹 페이지 레이아웃</title>
    <style>
        *{
          font-family: Sans-Serif;
        }
        header{
            /*  border : 2px solid red; */
            text-align:center;
            line-height: 55px;
            height : 60px;
            font-size : 30px;
            font-style : Italic;
            text-align: center;
        }
        nav{
          /*  border : 2px solid blue; */
            height : 50px;
            font-size : 30px;
            margin-bottom: 20px;
            text-align: center;
        }
        section{

            width: auto;
            height : auto;
            background-color:#D8D8D8;
            text-align:center;
            min-height: 550px;


        }

       .navul{
            text-align:center;
            display:inline-block;
        }
        .navli{
            display:inline-block;
            font-size: 15px;
            width: 150px;
        }

        .headfunc{
          display:block;

        }

        .eventzone{
         margin-top: 5px;

        }

           #usercategorycontainer{
             margin-top: 10px;
           }
           #usercategorycontainer ul{
             list-style: none;
             margin: 0px;
             padding: 0px;
           }
           #usercategorycontainer ul li{
             background-color: white;
             width:150px;
             height: 25px;
             line-height: 25px;
             text-align: center;
             border: 1px solid gray;
             color: black;
             font-size: 15px;
             margin: 0px;
             padding: 0px;
           }
           #usercategorycontainer ul li:hover{
             background-color: #85C1E9;
             margin: 0px;
             padding: 0px;
           }
           #usercategorycontainer ul ul{
             display: none;
             margin: 0px;
             padding: 0px;
           }
           #usercategorycontainer ul li:hover > ul{
             display: block;
             margin: -1px;
             padding: 0px;
           }
           .btcustom1{
             color:gray;
           }
           .btcustom2{
             font-weight:bold;
           }

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
    </style>
</head>
<body>
  <script src="//code.jquery.com/jquery.min.js"></script>

    <?php
     $dfuserid=$_SESSION['userid'];
     if(empty($_SESSION['userid'])){

     }else{
       $q10="SELECT * FROM userprofill WHERE id='$dfuserid'";
       $result10=$mysqli->query($q10);
       $usercoin=$result10->fetch_array();
     }

    ?>


    <header>

      <span class="headfunc" >



          <?php

          if(!isset($_SESSION['userid']) || !isset($_SESSION['usernickname'])){
            ?>
            <i style="text-align:center;margin-left:320px;">BookChain</i>
          <div class="homelogin-charge" style="float:right;margin-right:5px;">
            <input type="button" class="btn btn-primary" value="로그인" onClick="location.href='login.html'">
          </div>
          <?php
        }else{
          $dfusernickname=$_SESSION['usernickname'];
          ?>
          <i style="text-align:center;margin-left:500px;">BookChain</i>
         <div id="usercategorycontainer" style="z-index:2;float:right;margin-right:5px;">

        <ul >
          <li ><?php echo $dfusernickname; ?><img style="float:right;padding-right:2px;padding-top:3px;" src="./siteimage/down.png" alt="">
            <ul>
            <li><a href="userpage.html?usercategoryid=1">내정보</a></li>
            <li><a href="userpage.html?usercategoryid=2">선호작</a></li>
            <li><a href="userpage.html?usercategoryid=3">충전하기</a></li>
            <li><a href="userpage.html?usercategoryid=4&myfictioncategoryid=1">내작품</a></li>
            <li><a href="userpage.html?usercategoryid=5">내게시글</a></li>
            <li><a href="userpage.html?usercategoryid=6&mybuylistcategoryid=1">구매목록</a></li>
            <li><a href="logout.html">로그아웃</a></li>
          </ul>
        </li>
        </ul>
         </div>

         <div class="" style="font-size:12px;float:right;margin-right:10px;font-weight:bold;cursor:pointer;" onclick="coincharge();">
            내 캐시: <?php echo $usercoin['coin']; ?> 원
         </div>
         <script type="text/javascript">
           function coincharge(){
                location.href="userpage.html?usercategoryid=3"
           }
         </script>

        <?php
        }
        ?>

          <div class="" style="float:right;">
            <form class="" id="searchfrm" name="searchfrm" action="searchpage.php" method="GET">
              <input type="text" style="border:1px solid black;width:150px;height:30px;font-size:20px;" placeholder="작품검색" name="searchtext" value=""><img src="./siteimage/search.png" onclick="search()" style="margin-top:7px;margin-right:30px; height:30px;width:auto;cursor:pointer;border:1px solid black;" alt="">
            </form>
          </div>
          <script type="text/javascript">
            function search(){
                $('#searchfrm').submit();
            }
          </script>

      </span>


    </header>
    <nav>
      <?php
      $dfcategoryid = $_GET["categoryid"];

      ?>
        <ul class="navul">
          <li class="navli"><form class="" action="./main.html" method="get">
            <?php
            if(empty($dfcategoryid)){
            ?>
            <input type="submit" class="btn btn-default btcustom1" name="" value="홈" style="width:100px;">
            <?php
             }else{
            ?>
            <input type="submit" class="btn btn-default btcustom2" name="" value="홈" style="width:100px;">
            <?php
            }
            ?>

            </form></li>
          <li class="navli"><form class="" action="./main.html" method="get">
            <?php
            if($dfcategoryid==="1"){
            ?>
            <input type="hidden" name="categoryid" value="1">
            <input type="submit" class="btn btn-default btcustom2" name="" value="무료웹소설" style="width:100px;">
            <?php
             }else{
            ?>
            <input type="hidden" name="categoryid" value="1">
            <input type="submit" class="btn btn-default btcustom1" name="" value="무료웹소설" style="width:100px;">
            <?php
            }
            ?></form>
            </li>

          <li class="navli"><form class="" action="./main.html" method="get">
            <?php
            if($dfcategoryid==="2"){
            ?>
            <input type="hidden" name="categoryid" value="2">
            <input type="submit" class="btn btn-default btcustom2" name="" value="유료웹소설" style="width:100px;">
            <?php
             }else{

            ?>
            <input type="hidden" name="categoryid" value="2">
            <input type="submit" class="btn btn-default btcustom1" name="" value="유료웹소설" style="width:100px;">
            <?php
            }
            ?></form>
            </li>

            <li class="navli"><form class="" action="./main.html" method="get">
              <?php
              if($dfcategoryid==="3"){

              ?>
              <input type="hidden" name="categoryid" value="3">
              <input type="submit" class="btn btn-default btcustom2" name="" value="추천게시판" style="width:100px;">
              <?php
               }else{

              ?>
              <input type="hidden" name="categoryid" value="3">
              <input type="submit" class="btn btn-default btcustom1" name="" value="추천게시판" style="width:100px;">
              <?php
              }
              ?>
              </form>
            </li>
            <?php
            if(empty( $dfusernickname )===false){
            ?>
            <li class="navli" style="border-left:1px solid gray"><form class="" action="./userpage.html" method="get">
              <input type="hidden" name="usercategoryid" value="2">
              <input type="submit" class="btn btn-default btcustom1" name="" value="선호작" style="width:100px;">
              </form></li>
            <li class="navli"><form class="" action="./userpage.html" method="get">
              <input type="hidden" name="usercategoryid" value="4">
              <input type="hidden" name="myfictioncategoryid" value="1">
              <input type="submit" class="btn btn-default btcustom1" name="" value="내 작품" style="width:100px;">
              </form></li>
            <?php
            }
            ?>
        </ul>
    </nav>

    <main>

      <section>
        <?php
          $searchtext=$_GET['searchtext'];
        ?>


        <!-- 웹소설 -->
        <div class="popfiction" style="text-align:LEFT;">
          <h4 style="text-align:center;margin-top:10px;">검색 결과</h4>
          <!-- 웹소설 리스트 -->
          <?php

             $q = "SELECT * FROM fictiondata WHERE fiction_title like '%$searchtext%' order by idfictiondata desc";
             $result = $mysqli->query( $q);
          if($result->num_rows === 0 ){ ?>
              <p style=" padding-top:50px; background-color:#D8D8D8;text-align:center;height:150px;margin-bottom: -0px;font-size:30px;"> 검색 결과가 없습니다.</p>
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

    </main>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
