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
       .myfictioncategory_container{
         margin-top:10px;
         width: 800px;
         background-color: white;
         display: inline-block;
         margin-bottom: 5px;
       }
       .myfictioncategory{
         display: grid;
         grid-template-columns: 1fr 1fr 1fr;
         grid-template-rows: 40px;
       }

       .usernewfiction_container{
         display:inline-block;
         width: 800px;
         margin-top:5px;
          background-color: white;
       }
       .usernewfiction{
         padding-top:20px;
         width: 800px;
         height: auto;

         display:grid;

         grid-template-columns: 1fr 2fr;
         grid-template-rows: 60px 60px 60px auto auto auto auto 60px ;
       }
       .usernewfiction_title{
         border-right:2px solid black;
         border-top:1px solid gray;
         padding-right:5px;
         padding-top: 5px;
         grid-row: 1/2;
         grid-column: 1/2;

       }
       .usernewfiction_titletext{
         border-top:1px solid gray;
          padding-top: 5px;
         padding-left:5px;
         grid-row: 1/2;
         grid-column: 2/3;

       }
       .usernewfiction_pricecate{
         padding-top: 5px;
        border-right:2px solid black;
        border-top:1px solid gray;
        padding-right:5px;
        grid-row: 2/3;
        grid-column: 1/2;
       }

       .usernewfiction_pricecatebox{
         padding-top: 5px;
        border-top:1px solid gray;
        padding-left:5px;
        grid-row: 2/3;
        grid-column: 2/3;
       }

       .usernewfiction_cate{
          padding-top: 5px;
         border-right:2px solid black;
         border-top:1px solid gray;
         padding-right:5px;
         grid-row: 3/4;
         grid-column: 1/2;

       }
       .usernewfiction_catebox{
          padding-top: 5px;
         border-top:1px solid gray;
         padding-left:5px;
         grid-row: 3/4;
         grid-column: 2/3;

       }.usernewfiction_description2{
          padding-top: 5px;
         border-right:2px solid black;
         border-top:1px solid gray;
         padding-right:5px;
         grid-row: 4/5;
         grid-column: 1/2;
       }
       .usernewfiction_descriptiontext2{
          padding-top: 5px;
         border-top:1px solid gray;
         padding-left:5px;
         grid-row: 4/5;
         grid-column: 2/3;
       }
       .usernewfiction_description{
          padding-top: 5px;
         border-right:2px solid black;
         border-top:1px solid gray;
         padding-right:5px;
         grid-row: 5/6;
         grid-column: 1/2;
       }
       .usernewfiction_descriptiontext{
          padding-top: 5px;
         border-top:1px solid gray;
         padding-left:5px;
         grid-row: 5/6;
         grid-column: 2/3;
       }
       .usernewfiction_image{
          padding-top: 5px;
         border-right:2px solid black;
         border-top:1px solid gray;
         padding-right:5px;
         grid-row: 6/7;
         grid-column: 1/2;
       }
       .usernewfiction_imageselect{
          padding-top: 5px;
         border-top:1px solid gray;
         padding-left:5px;
         grid-row: 6/7;
         grid-column: 2/3;
       }
       .usernewfiction_button{
          padding-top: 5px;
         border-top:1px solid gray;
         grid-row: 7/8;
         grid-column: 1/3;
       }
       /* 내 작품목록 */
       .myfictionlist{
         width:800px;
         height:auto;
         background-color: white;
         display: inline-block;
         margin-top:5px;
         margin-bottom: 10px;
       }
       .myfictionlistgrid{
         display: grid;
         box-shadow: 2px 2px 2px #d3d3d3;
         grid-template-columns: 1fr 3fr;
         grid-template-rows: 25px 50px 25px;
         margin-bottom: 30px;
         margin-left: 20px;
         margin-right: 20px;
         margin-top: 30px;
       }
       .myfictionlist_image{
         grid-row: 1/4;
         grid-column: 1/2;

       }
        .myfictionlist_tilte{
          grid-row: 1/2;
          grid-column: 2/3;
          font-size:18px;
          font-weight:bold;
          margin-left: 20px;
        }.myfictionlist_description{
          grid-row: 2/3;
           grid-column: 2/3;
           font-size:15px;
           margin-left: 20px;
        }.myfictionlist_detail{
          grid-row: 3/4;
            grid-column: 2/3;
            font-size:15px;
           margin-left: 20px;
        }
        .image_default{
          display: grid;
          grid-template-rows: 40px 40px;
        }.image_default1{
          grid-row: 1/2;
        }.image_default2{
          grid-row: 2/3;
        }.image_defaultcontainer{
          display: inline-block;
        }#fiction_title{
          width:514px;
        }#ufiction_description{
          width:514px;min-height:300px;height:auto;
        }#ufiction_description2{
          width:514px;
        }
     </style>
  </head>
  <body>
    <section>
      <script src="//code.jquery.com/jquery.min.js"></script>
      <?php
       $page=$_GET['page'];
       if(empty($page)){
         $page=1;
       }
        ?>
      <?php
      $senickname = $_SESSION['usernickname'];
      $dffictionid = $_GET['fictionid'];

      $dfmyfictioncategoryid=1;
       $dfmyfictioncategoryid = $_GET['myfictioncategoryid'];
       ?>
       <div class="myfictioncategory_container" id="category_control1">
         <div class="myfictioncategory" id="category_control2" >
           <div class="" id="category_control3">
             <?php if($dfmyfictioncategoryid==1){?>
             <form class="" action="userpage.html" method="get">
               <input type="hidden" name="usercategoryid" value="4">
               <input type="hidden" name="myfictioncategoryid" value="1">
               <input type="submit"id="category_control5" name="" class="btn btn-default btcustom2"  value="내 작품목록">
             </form>
           <?php }else{?>
             <form class="" action="userpage.html" method="get">
               <input type="hidden" name="usercategoryid" value="4">
               <input type="hidden" name="myfictioncategoryid" value="1">
               <input type="submit"id="category_control5" name="" class="btn btn-default btcustom1"  value="내 작품목록">
             </form>
           <?php } ?>
           </div>
           <div class="" id="category_control4">
             <?php if($dfmyfictioncategoryid==2){ ?>
             <form class="" action="userpage.html" method="get">
               <input type="hidden" name="usercategoryid" value="4">
               <input type="hidden" name="myfictioncategoryid" value="2">
               <input type="submit"id="category_control6" name="" class="btn btn-default btcustom2" value="새작품 등록">
             </form>
           <?php }else{ ?>
             <form class="" action="userpage.html" method="get">
               <input type="hidden" name="usercategoryid" value="4">
               <input type="hidden" name="myfictioncategoryid" value="2">
               <input type="submit" id="category_control6" name="" class="btn btn-default btcustom1" value="새작품 등록">
             </form>
           <?php } ?>
           </div>
           <div class="" >
             <?php if($dfmyfictioncategoryid==3){ ?>
             <form class="" action="userpage.html" method="get">
               <input type="hidden" name="usercategoryid" value="4">
               <input type="hidden" name="myfictioncategoryid" value="3">
               <input type="submit" name="" class="btn btn-default btcustom2" value="작품 정산">
             </form>
           <?php }else{ ?>
             <form class="" action="userpage.html" method="get">
               <input type="hidden" name="usercategoryid" value="4">
               <input type="hidden" name="myfictioncategoryid" value="3">
               <input type="submit"  name="" class="btn btn-default btcustom1" value="작품 정산">
             </form>
           <?php } ?>
           </div>
         </div>
       </div>

       <div class="myfictionlist">
      <?php
       if($dfmyfictioncategoryid==="1"){
        ?>


        <?php


                $q3 = "SELECT COUNT(*) as cnt  FROM fictiondata WHERE fiction_author='$senickname'";
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





         $q = "SELECT * FROM fictiondata WHERE fiction_author='$senickname' order by idfictiondata desc limit $limit_start,$onepage";
         $result = $mysqli->query( $q);
         if($result->num_rows === 0 ){ ?>
             <p style=" padding-top:50px; background-color:#D8D8D8;text-align:center;height:150px;margin-bottom: -0px;font-size:30px;"> 등록된 작품이 없습니다.</p>
       <?php  }else{

         while($myfictionlist =$result->fetch_array()){
           $myfictionlist["idfictiondata"];
           $myfictionlist["fiction_imagepath"];
           $myfictionlist["fiction_title"];
           $myfictionlist["fiction_pricecategory"];
           $myfictionlist["fiction_description"];
           $myfictionlist["fiction_count"];
           $myfictionlist["fiction_genre"];
           $myfictionlist["fiction_author"];
          /* style=" cursor: pointer;" onClick="myfictionlist_<?php echo $myfictionlist["idfictiondata"]; ?>_click();"*/
      ?>


       <div class="myfictionlistgrid"  >

          <form class="" name="myfictionlistfrm_<?php echo $myfictionlist["idfictiondata"]; ?>" action="./fictionhome.html" method="get">
          <input type="hidden" name="fictionid" value="<?php echo $myfictionlist["idfictiondata"]; ?>">
          </form>
          <script>
          function myfictionlist_<?php echo $myfictionlist["idfictiondata"]; ?>_click(){
            document.myfictionlistfrm_<?php echo $myfictionlist["idfictiondata"]; ?>.submit();
          }
          </script>

        <div class="myfictionlist_image" >
            <img src="<?php echo $myfictionlist["fiction_imagepath"]; ?>" alt="" draggable="false" style="width: 100%; height: 100%;">
        </div>
        <div class="myfictionlist_tilte" >
          <p style="float:left;margin-right:10px;">[<?php echo $myfictionlist["fiction_pricecategory"]; ?>]</p>

          <p style="float:left"><?php echo $myfictionlist["fiction_title"]; ?></p>
        </div>
        <div class="myfictionlist_description" >
           <p style="float:left;text-align:left;width:400px;"><?php echo $myfictionlist["fiction_description"]; ?></p>
          <div class="" style="display:inline-block;float:right;">
            <form class="chapterregister" action="fictionhome.html" method="get">
              <input type="hidden" name="fictionid" value="<?php echo $myfictionlist["idfictiondata"]; ?>">
              <input  type="submit" style="margin-right:10px;margin-bottom:5px;" name="" value="작품관리">
            </form>
            <form class="" id="fictiondeletefrm" name="" action="fictiondelete_ok.php" method="post">
              <input type="hidden" name="fictionid" value="<?php echo $myfictionlist["idfictiondata"]; ?>">
              <input type="hidden" name="fictionauthor" value="<?php echo $myfictionlist["fiction_author"]; ?>">
              <input type="button" id="fictiondeletebutton" onclick="delete_fiction();" style="float:right;margin-right:10px;" name="" value="작품삭제" >
            </form>
            <script type="text/javascript">
              function delete_fiction(){
                var result_js3 = confirm("정말로 삭제하시겠습니까?");
                if(result_js3==true){
                  $('#fictiondeletefrm').submit();
                }else if(result_js3==false){

                }
              }
            </script>

          </div>

        </div>
        <div class="myfictionlist_detail" >
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
    } ?>

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
                   <a href="./userpage.html?usercategoryid=4&myfictioncategoryid=1&page=1">처음</a>

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
                   <a href="./userpage.html?usercategoryid=4&myfictioncategoryid=1&page=<?php echo $prev_block; ?>">이전</a>

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
                     <a href="./userpage.html?usercategoryid=4&myfictioncategoryid=1&page=<?php echo $i; ?>">[<?php echo $i; ?>]</a>
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
                 <a href="./userpage.html?usercategoryid=4&myfictioncategoryid=1&page=<?php echo $next_block; ?>">다음</a>
               <?php } ?>
              <!-- 마지막 버튼 -->
              <?php if($page>=$total_page){ ?>
                <span>마지막</span>
             <?php }else{ ?>
                <a href="./userpage.html?usercategoryid=4&myfictioncategoryid=1&page=<?php echo $total_page; ?>">마지막</a>
             <?php } ?>
            </div>
    <?php }else{} ?>






<?php  }?>
    </div>
    <?php
  }elseif($dfmyfictioncategoryid==="2"&&empty($dffictionid)){
      ?>

    <form class="" action="usernewfictionregister_check.php" method="post" enctype="multipart/form-data" style="display:inline-block;">
      <div class="usernewfiction_container">
        <div class="usernewfiction">

          <div class="usernewfiction_title">
            <p style="float:right;">작품명</p>
          </div >
          <div class="usernewfiction_titletext">
            <textarea name="fiction_title" id="fiction_title" rows="1" cols="55" placeholder=""  required></textarea>

            <script type="text/javascript">
            $('#fiction_title').on('keyup', function() {

              if($(this).val().length >50 ) {

                alert("글자수는 50자 이내로 제한됩니다.");

                $(this).val($(this).val().substring(0, 50));

              }

            });
            </script>
            </div >
          <div class="usernewfiction_pricecate">
              <p style="float:right;">가격설정</p>
          </div >
          <div class="usernewfiction_pricecatebox">
            <select name="fiction_pricecategory" style="float:left;" onchange="javascript:myListener(this);">
              <option id="free" value="무료" selected="selected">무료</option>
              <option id="notfree" value="유료" onclick="notfree();">유료</option>
            </select>
            <script>
           function myListener(obj) {
              if(obj.value=="유료"){
                $('#notfreecount').css("display","block");
              }else if(obj.value=="무료"){
                $('#notfreecount').css("display","none");
                $('#startprice').val("1");

              }
            }
          </script>


            <div class="" id="notfreecount" style="display:none;">

            <p style="display:inline-block;">유료화 시작 :</p>
            <input type="text" name="fiction_startpricechapter" id="startprice" value="1" placeholder="숫자만 입력해주세요" onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' required >화 부터


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

            </div>

          </div>
          <div class="usernewfiction_cate">
              <p style="float:right;">장르</p>
          </div >
          <div class="usernewfiction_catebox">
            <select name="fiction_genre" style="float:left;">
              <option value="판타지" selected="selected">판타지</option>
              <option value="현대판타지">현대판타지</option>
              <option value="로맨스판타지">로맨스판타지</option>
              <option value="무협">무협</option>
              <option value="로맨스">로맨스</option>
            </select>
          </div>
          <div class="usernewfiction_description2">
              <p style="float:right;">한줄소개 (최대 50자)</p>

          </div>
          <div class="usernewfiction_descriptiontext2">
            <textarea name="fiction_description2" id="ufiction_description2" rows="1" cols="55" placeholder="" maxlength="100" required></textarea>
            <script type="text/javascript">
            $('#ufiction_description2').on('keyup', function() {

              if($(this).val().length >50 ) {

                alert("글자수는 50자 이내로 제한됩니다.");

                $(this).val($(this).val().substring(0, 50));

              }

            });
            </script>
          </div>
          <div class="usernewfiction_description">
              <p style="float:right;">소개글 (최대 400자)</p>
          </div>
          <div class="usernewfiction_descriptiontext">
            <textarea name="fiction_description" id="ufiction_description" placeholder=""  required></textarea>
            <script type="text/javascript">
            $('#ufiction_description').on('keyup', function() {

              if($(this).val().length >400 ) {

                alert("글자수는 400자 이내로 제한됩니다.");

                $(this).val($(this).val().substring(0, 400));

              }

            });
            </script>
          </div>
          <div class="usernewfiction_image">
             <div class="image_defaultcontainer" style="float:right;">


             <div class="image_default" style="float:right;">
               <div class="image_default1" style="float:right;">
                 <p style="float:right;">표지 이미지</p>
               </div>
               <div class="image_default2" style="float:right;">
                 <input type="button" style="float:right;" name="" value="기본 이미지 사용" onclick="defaultimage();">
                 <script type="text/javascript">
                   function defaultimage(){

                     if (/(MSIE|Trident)/.test(navigator.userAgent)) { // ie 일때 input[type=file] init.
                       $("#fileToUpload").replaceWith( $("#fileToUpload").clone(true) );
                      } else { // other browser 일때
                      $("#fileToUpload").val("");
                     }
                     $("#image_section").attr("src","./webfictionimage/fictiondefault.jpg");

                     }
                 </script>
               </div>
             </div>
             </div>
          </div>
          <div class="usernewfiction_imageselect">

            <img src="./webfictionimage/fictiondefault.jpg" id="image_section" style="width:120px;height:80px;margin-bottom:10px;"  alt="">

            <input style="margin-left: 20px;" type='file' name="fileToUpload" id="fileToUpload" />

          <script>
            function readURL(input) {

            if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                $('#image_section').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
            }
          }

          $("#fileToUpload").change(function(){
            readURL(this);
          });
          </script>


          </div>

          <div class="usernewfiction_button">

              <input type="submit" name="submit" value="확인">

              <input type="button" name="" value="취소" onclick="location.href='userpage.html?usercategoryid=4&myfictioncategoryid=1'">

          </div>
        </div>
      </div>
    </form>

    <?php
  }elseif($dfmyfictioncategoryid==="2" && empty($dffictionid)==false  ){
     ?>
     <!-- 수정 -->
     <script type="text/javascript">
       $('#category_control1').css("display","none");
     </script>
     <?php
      $q2 = "SELECT * FROM fictiondata WHERE idfictiondata='$dffictionid'";
      $result2 = $mysqli->query( $q2);
      $myfictionlist = $result2->fetch_array();
        $myfictionlist["idfictiondata"];
        $myfictionlist["fiction_imagepath"];
        $myfictionlist["fiction_title"];
        $myfictionlist["fiction_pricecategory"];
        $myfictionlist["fiction_description"];
        $myfictionlist["fiction_count"];
        $myfictionlist["fiction_genre"];
        $myfictionlist["fiction_author"];
        $myfictionlist["fiction_descriptiondetail"];
        $myfictionlist["fiction_startpricechapter"];
   ?>

     <h4 style="margin-top:20px;">작품 설정 수정</h4>
     <form class="" action="fictionmodify_ok.php" method="post" enctype="multipart/form-data" style="display:inline-block;">
         <input type="hidden" name="fiction_startpricechapter_or" value="<?php echo $myfictionlist["fiction_startpricechapter"]; ?>">
       <input type="hidden" name="idfictiondata" value="<?php echo $myfictionlist["idfictiondata"]; ?>">
       <input type="hidden" name="fiction_imagepath_or" value="<?php echo $myfictionlist["fiction_imagepath"]; ?>">
       <input type="hidden" name="fiction_pricecategory_or" value="<?php echo $myfictionlist["fiction_pricecategory"]; ?>">

       <div class="usernewfiction_container" >


         <div class="usernewfiction">

           <div class="usernewfiction_title">
             <p style="float:right;">작품명 (최대 50자)</p>
           </div >
           <div class="usernewfiction_titletext">
              <textarea name="fiction_title" id="fiction_title" rows="1" cols="55" placeholder=""  required><?php echo $myfictionlist["fiction_title"]; ?></textarea>

              <script type="text/javascript">
              $('#fiction_title').on('keyup', function() {

                if($(this).val().length >50 ) {

                  alert("글자수는 50자 이내로 제한됩니다.");

                  $(this).val($(this).val().substring(0, 50));

                }

              });
              </script>
           </div >
           <div class="usernewfiction_pricecate">
               <p style="float:right;">가격설정</p>
           </div >
           <div class="usernewfiction_pricecatebox">
             <select name="fiction_pricecategory" style="float:left;" onchange="javascript:myListener(this);">
               <?php if($myfictionlist["fiction_pricecategory"]=="무료"){ ?>
                 <option id="free" value="무료" selected="selected">무료</option>
                 <option id="notfree" value="유료">유료</option>

               <?php }else{ ?>
                 <option id="free" value="무료" >무료</option>
                 <option id="notfree" value="유료" selected="selected">유료</option>
               <?php } ?>
             </select>
             <script>
            function myListener(obj) {
               if(obj.value=="유료"){
                 $('#notfreecount').css("display","block");
               }else if(obj.value=="무료"){
                 $('#notfreecount').css("display","none");
                 $('#startprice').val("1");
               }
             }
           </script>

          <?php if($myfictionlist["fiction_pricecategory"]=="무료"){ ?>
             <div class="" id="notfreecount" style="display:none;">

            <?php }else{ ?>
              <div class="" id="notfreecount" style="display:block;">

            <?php } ?>

             <p style="display:inline-block;">유료화 시작 :</p>
             <input type="text" name="fiction_startpricechapter" id="startprice" value="<?php echo $myfictionlist["fiction_startpricechapter"]; ?>" placeholder="숫자만 입력해주세요" required onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)'>화 부터

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
             </div>


           </div>
           <div class="usernewfiction_cate">
               <p style="float:right;">장르</p>
           </div >
           <div class="usernewfiction_catebox">
             <select name="fiction_genre" style="float:left;">
               <?php if($myfictionlist["fiction_genre"]=="판타지"){ ?>
                 <option value="판타지" selected="selected">판타지</option>
                 <option value="현대판타지">현대판타지</option>
                 <option value="로맨스판타지">로맨스판타지</option>
                 <option value="무협">무협</option>
                 <option value="로맨스">로맨스</option>
               <?php }elseif($myfictionlist["fiction_genre"]=="현대판타지"){ ?>
                 <option value="판타지" >판타지</option>
                 <option value="현대판타지" selected="selected">현대판타지</option>
                 <option value="로맨스판타지">로맨스판타지</option>
                 <option value="무협">무협</option>
                 <option value="로맨스">로맨스</option>
              <?php  }elseif($myfictionlist["fiction_genre"]=="로맨스판타지"){ ?>
                <option value="판타지" >판타지</option>
                <option value="현대판타지">현대판타지</option>
                <option value="로맨스판타지" selected="selected">로맨스판타지</option>
                <option value="무협">무협</option>
                <option value="로맨스">로맨스</option>
               <?php }elseif($myfictionlist["fiction_genre"]=="무협"){ ?>
                 <option value="판타지" >판타지</option>
                 <option value="현대판타지">현대판타지</option>
                 <option value="로맨스판타지">로맨스판타지</option>
                 <option value="무협" selected="selected">무협</option>
                 <option value="로맨스">로맨스</option>
              <?php  }elseif($myfictionlist["fiction_genre"]=="로맨스"){ ?>
                <option value="판타지" >판타지</option>
                <option value="현대판타지">현대판타지</option>
                <option value="로맨스판타지">로맨스판타지</option>
                <option value="무협">무협</option>
                <option value="로맨스" selected="selected">로맨스</option>
               <?php }?>

             </select>
           </div>
           <div class="usernewfiction_description2">
               <p style="float:right;">한줄소개 (최대 50자)</p>

           </div>
           <div class="usernewfiction_descriptiontext2">
             <textarea name="fiction_description2" id="ufiction_description2" rows="1" cols="55" placeholder="" maxlength="100" required><?php echo $myfictionlist["fiction_description"]; ?></textarea>
             <script type="text/javascript">
             $('#ufiction_description2').on('keyup', function() {

               if($(this).val().length >50 ) {

                 alert("글자수는 50자 이내로 제한됩니다.");

                 $(this).val($(this).val().substring(0, 50));

               }

             });
             </script>
           </div>
           <div class="usernewfiction_description">
               <p style="float:right;">소개글 (최대 400자)</p>
           </div>
           <div class="usernewfiction_descriptiontext">
             <textarea name="fiction_description" id="ufiction_description" placeholder=""  required><?php echo $myfictionlist["fiction_descriptiondetail"]; ?></textarea>
             <script type="text/javascript">
             $('#ufiction_description').on('keyup', function() {

               if($(this).val().length >400 ) {

                 alert("글자수는 400자 이내로 제한됩니다.");

                 $(this).val($(this).val().substring(0, 400));

               }

             });
             </script>
           </div>
           <div class="usernewfiction_image">
              <div class="image_defaultcontainer" style="float:right;">


              <div class="image_default" style="float:right;">
                <div class="image_default1" style="float:right;">
                  <p style="float:right;">표지 이미지</p>
                </div>
                <div class="image_default2" style="float:right;">
                  <input type="button" style="float:right;" name="" value="기본 이미지 사용" onclick="defaultimage();">
                  <script type="text/javascript">
                    function defaultimage(){

                      if (/(MSIE|Trident)/.test(navigator.userAgent)) { // ie 일때 input[type=file] init.
                        $("#fileToUpload").replaceWith( $("#fileToUpload").clone(true) );
                       } else { // other browser 일때
                       $("#fileToUpload").val("");
                      }
                      $("#image_section").attr("src","./webfictionimage/fictiondefault.jpg");
                                          $('#default_check').val("yes");
                      }
                  </script>
                </div>
              </div>
              </div>
           </div>
           <div class="usernewfiction_imageselect">
             <input type="hidden" name="default_check" id="default_check" value="no">
             <img src="<?php echo $myfictionlist["fiction_imagepath"]; ?>" id="image_section" style="width:120px;height:80px;margin-bottom:10px;"  alt="">

             <input style="margin-left: 20px;" type='file' name="fileToUpload" id="fileToUpload" />

           <script>
             function readURL(input) {

             if (input.files && input.files[0]) {
               var reader = new FileReader();

               reader.onload = function (e) {
                 $('#image_section').attr('src', e.target.result);
               }

               reader.readAsDataURL(input.files[0]);
             }
           }

           $("#fileToUpload").change(function(){
             readURL(this);
           });
           </script>


           </div>

           <div class="usernewfiction_button">

               <input type="submit" name="submit" value="수정">

               <input type="button" name="" value="취소" onclick="location.href='userpage.html?usercategoryid=4&myfictioncategoryid=1'">

           </div>
         </div>
       </div>
     </form>


   <?php }elseif($dfmyfictioncategoryid=="3"){

    include_once ('./userfictionmoney.php');

 }else{
  echo '<script>alert("잘못된 접근입니다.");document.location.href="./main.html";</script>';

 } ?>
    </section>
  </body>
</html>
