<?php
session_start();
$_SESSION['userid'];
$_SESSION['usernickname'];
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://cdn.ckeditor.com/ckeditor5/12.3.0/classic/ckeditor.js"></script>
    <title>웹 페이지 레이아웃</title>

    <style >
    .list-table {
    margin-top: 60px;
      }
      .list-table thead th{
      height:40px;
      border-top:2px solid #09C;
      border-bottom:1px solid #CCC;
      font-weight: bold;
      font-size: 17px;
      }
      .list-table tbody td{
      text-align:center;
      padding:10px 0;
      border-bottom:1px solid #CCC; height:20px;
      font-size: 14px
      }
      .boardtable_container{
      width:800px;
      display: inline-block;
      background-color: white;
      margin-top:10px;
      margin-bottom:10px;
      padding-left: 10px;
      padding-right: 10px;
      }
      .noticeread_container{
        width: 800px;
        display: inline-block;
        background-color: white;
        margin-top:10px;
        margin-bottom:10px;
        padding-left: 10px;
        padding-right: 10px;
        text-align: center;
      }
      .noticereadgrid{

        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: auto 40px auto;
      }
      .noticeread_title{
        padding-top: 10px;
        grid-row: 1/2;
      }
      .noticeread_detail{
      grid-row: 2/3;
      border-bottom: 1px solid gray;
      }
      .noticeread_description{
      grid-row: 3/4;
      }
      .board_write{
        width:800px;
        height: auto;
        background-color: white;
        display: inline-block;
        margin-top: 10px;
        margin-bottom: 10px;
      }
      #write_area{
        display: grid;
        grid-template-columns: 1fr 3fr;
        grid-template-rows: 60px; 40px 40px auto 40px;
      }
      .write_title{
        display: inline-block;

        grid-column: 1/3;
        grid-row: 1/2;
      }
      .in_categorytext{
        display: inline-block;
        border-top: 1px solid gray;
        border-right: 1px solid gray;
        padding-right:10px;
        padding-top:10px;
        grid-column: 1/2;
        grid-row: 2/3;
      }
      .in_category{
        display: inline-block;
          border-top: 1px solid gray;
        padding-left: 10px;
        grid-column: 2/3;
        grid-row: 2/3;
      }
      .in_titletext{
        border-right: 1px solid gray;
        padding-right:10px;
        padding-top:10px;
        display: inline-block;
        grid-column: 1/2;
        grid-row: 3/4;
      }
      .in_title{
        display: inline-block;
        padding-left: 10px;
        padding-right:10px;

        grid-column: 2/3;
        grid-row: 3/4;
      }
      .in_descriptiontext{
        border-right: 1px solid gray;
        padding-right:10px;
        padding-top:10px;
        display: inline-block;
        grid-column: 1/2;
        grid-row: 4/5;
      }
      .in_description{
        padding-top: 10px;
        padding-left: 10px;
        padding-right:10px;
        display: inline-block;
        grid-column: 2/3;
        grid-row: 4/5;
      }
      .bt_se{
        display: inline-block;
        grid-column: 1/3;
        grid-row: 5/6;
        padding-top: 10px;
        padding-bottom: 10px;
      }
      .comment_containerout{
        display: inline-block;
        width:800px;
        background-color: white;
      }
      .comment_container{
        display: inline-block;
        width:700px;
        background-color: white;
      }
      .commentgrid{
        display: grid;
        padding-top: 5px;
        grid-template-columns: 1fr 4fr;
        grid-template-rows: 40px auto 40px;
        border-bottom: 1px solid gray;
      }
      .comment_nickname{
         grid-column: 1/2 ;
         grid-row: 1/2;
         font-size: 15px;
         font-weight: bold;
         border-right: 1px dotted gray;
      }
      .comment_date{
        grid-column: 1/2;
        grid-row: 2/3;
        font-size: 12px;
        color:gray;
        border-right: 1px dotted gray;
      }
      .comment_description{
        grid-column: 2/3;
        grid-row: 1/3;

      }
      .comment_bt{
        grid-column: 2/3;
        grid-row: 3/4;
      }
      .commentwrite_container{
        display: inline-block;
        width:800px;
        background-color: white;
        text-align: center;
        padding-top: 50px;
      }


      .ck.ck-editor {
    max-width: 600px;
    text-align: left;
}
.ck-editor__editable {
    min-height: 300px;
}
figure img{
  width:100%;
}
#page{
  margin-top:5px;
}
#subpage{
  margin-top:5px;
}

    </style>

  </head>
  <body>
  <section>
  <script src="//code.jquery.com/jquery.min.js" ></script>
  <?php
  $dfwritecategory=$_POST['writecategory'];
  $dfsubnoticecategory=$_GET['subnoticecategory'];
  $page = $_GET['page'];
  if(empty($page)){
    $page=1;
  }
  if(empty($dfwritecategory)){

      if (empty($dfsubnoticecategory)===false) {
        //게시글 읽으러 들어갈때
          $q = "SELECT * FROM postdata WHERE idpostdata='$dfsubnoticecategory'";
          $result = $mysqli->query($q);
          $board = $result->fetch_array(MYSQLI_ASSOC);
              $idpostdata=$board["idpostdata"];
              if(empty($idpostdata)){
                echo '<script>alert("잘못된 접근입니다.");document.location.href="./main.html?categoryid=3";</script>';
              }
              $title=$board["title"];

              $category=$board['category'];
              $author=$board['author'];
              $dateorigin=$board['date'];
              $count=$board['count'];
              $description=$board['description'];
              $commentcount=$board['commentcount'];
          ?>
          <div class="noticeread_container">
            <div class="noticereadgrid">
              <div class="noticeread_title">
                <p style="display:inline-block;float:left;font-weight:bold;">[<?php echo $category; ?>] </p>
                <p style="display:inline-block;float:left;font-weight:bold;"><?php echo $title; ?></p>
                <?php
                if($_SESSION['usernickname']===$author){
                 ?>
                <form class="" name="noticefrm" action="noticedelete_ok.php" method="post">
                    <input type="hidden" name="idpostdata" value="<?php echo $idpostdata ?>">
                    <input type="hidden" name="author" value="<?php echo $author ?>">
                </form>
                <input type="button" style="float:right;margin-bottom:10px;" name="" class="btn btn-outline-dark" value="글 삭제"  onclick="noticedelete();">
                <script type="text/javascript">
                  function noticedelete(){
                    var result_js = confirm("정말로 삭제하시겠습니까?");
                    if(result_js==true){
                      document.noticefrm.submit();
                    }else if(result_js==false){

                    }
                  }
                </script>
                <form class="" action="./main.html?categoryid=3&subnoticecategory=<?php echo $idpostdata; ?>" method="post">
                  <input type="hidden" name="writecategory" value="2">
                  <input type="submit" style="float:right;margin-right:5px;" name="" class="btn btn-outline-dark" value="글 수정">
                </form>
               <?php }?>
              </div>
              <div class="noticeread_detail">
               <pre style="display:inline-block;float:left;margin-right:5px;">글쓴이: </pre>
               <pre style="display:inline-block;float:left;"><?php echo $author; ?></pre>

               <pre style="display:inline-block;float:right;"><?php echo $count; ?></pre>
               <pre style="display:inline-block;float:right;margin-right:5px;">조회: </pre>
               <pre style="display:inline-block;float:right;margin-right:20px;"><?php echo $dateorigin; ?></pre>
               <pre style="display:inline-block;float:right;margin-right:5px;">작성일: </pre>
              </div>
              <div class="noticeread_description" style="width:720px;margin-left:30px;margin-bottom:20px;">
               <div style="word-break:break-all;padding-top:20px;padding-left:10px;padding-right:10px;text-align:left"><?php echo $description; ?></div>
              </div>
            </div>
          </div>

          <div class="comment_containerout">
          <!-- 댓글 보이는 곳 -->
          <?php
          //페이징 위한 카운트
          $subpage = $_GET['subpage'];
          if(empty($subpage)){
            $subpage=1;
          }

          $q4 = "SELECT COUNT(*) as cnt FROM commentdata WHERE postdataid='$idpostdata' ";
          $result4 = $mysqli->query($q4);
          $row2=mysqli_fetch_assoc($result4);

          $allpost2 = $row2['cnt']; //전체 게시글의 수

          $onepage2=15; // 한 페이지에 보여줄 게시글의 수.

          $total_page2 = ceil($allpost2 / $onepage2); //전체 페이지의 수

          if(is_numeric($subpage)==false||$subpage<0||$subpage>$total_page2&&$total_page2!=0){
            echo '<script>alert("잘못된 접근입니다.");document.location.href="./main.html?categoryid=1";</script>';
          }

          $limit_start2=($onepage2*($subpage-1));

          $block_num2=10;

          $block2=ceil($subpage/$block_num2);
          $block_start2=(($block2 -1)*$block_num2)+1;
          $block_end2=$block_start2+$block_num2-1;

          if($block_end2 > $total_page2){
            $block_end2=$total_page2;
          }
          $total_block2=ceil($total_page2/$block_num2);
          //페이징 데이터 끝

          ?>
           <div class="comment_container">
             <div class="" style="border-bottom:1px solid blue;">
               <h4 style="padding-top:10px;padding-bottom:10px;text-align:left;">Comment '<?php echo $commentcount; ?></h4>
             </div>
             <?php



             $q2 = "SELECT * FROM commentdata WHERE postdataid='$idpostdata' order by idcommentdata asc limit $limit_start2,$onepage2";
             $result2 = $mysqli->query( $q2);

             while($board2 = $result2->fetch_array())
             { $idcommentdata=$board2['idcommentdata'];
               $commentauthor=$board2['author'];
               ?>
             <div class="commentgrid">
               <div class="comment_nickname">

                    <p><?php echo $board2['author']; ?></p>
               </div>
               <div class="comment_date">
                    <p><?php echo $board2['date']; ?></p>
               </div>
               <div class="comment_description">
                  <p style="word-break:break-all;text-align:left;padding-left:10px;"><?php echo $board2['description']; ?></p>
               </div>
               <div class="comment_bt">
                   <?php if(empty($_SESSION['usernickname'])){ ?>
                  <!--  <a href="#" style="float:right;padding-right:10px;" onclick="alert('먼저 로그인을 해주세요'); return false;">답댓글</a> -->
                  <?php }else{?>
                  <!-- <a href="#" style="float:right;padding-right:10px;">답댓글</a> -->
                   <?php if($_SESSION['usernickname']===$board2['author']){ ?>
                     <a href="#" style="float:right;padding-right:10px;" onclick="commentdelete_<?php echo $idcommentdata; ?>();">삭제</a>
                      <form class="" name="commentdeletefrm_<?php echo $idcommentdata; ?>" action="commentdelete_ok.php" method="post">
                        <input type="hidden" name="idcommentdata" value="<?php echo $idcommentdata; ?>">
                        <input type="hidden" name="commentauthor" value="<?php echo $commentauthor; ?>">
                        <input type="hidden" name="idpostdata" value="<?php echo $idpostdata; ?>">
                        <input type="hidden" name="dfsubnoticecategory" value="<?php echo $dfsubnoticecategory; ?>">
                        <script type="text/javascript">
                          function commentdelete_<?php echo $idcommentdata; ?>(){
                            var result_js2 = confirm("정말로 삭제하시겠습니까?");
                            if(result_js2==true){
                              document.commentdeletefrm_<?php echo $idcommentdata; ?>.submit();
                            }else if(result_js2==false){

                            }
                          }
                        </script>
                      </form>

                     <?php } ?>
                  <?php } ?>
               </div>
             </div>
           <?php } //아래부터 댓글페이징

           if(!empty($allpost2)){ ?>

           <div class="" id="subpage">
            <!-- 처음 버튼 -->
             <?php
                if($subpage<=1){
             ?>
                  <span>처음</span>
             <?php
                }else{
             ?>
                  <a href="./main.html?categoryid=3&subnoticecategory=<?php echo $dfsubnoticecategory; ?>&page=<?php echo $page; ?>&subpage=1">처음</a>

             <?php } ?>

             <!-- 이전 버튼 -->
             <?php
                if($block2<=1){
                 echo "";
             ?>
             <?php
                }else{
                  $prev_block2 = $block_start2-1;
             ?>
                  <a href="./main.html?categoryid=3&subnoticecategory=<?php echo $dfsubnoticecategory; ?>&page=<?php echo $page; ?>&subpage=<?php echo $prev_block2; ?>">이전</a>

             <?php } ?>

             <!-- 숫자 버튼 -->
             <?php
                for($i=$block_start2; $i<=$block_end2; $i++){
                  if($subpage==$i){
             ?>
                     <span>[<?php echo $i; ?>]</span>
             <?php
                  }else{
             ?>
                    <a href="./main.html?categoryid=3&subnoticecategory=<?php echo $dfsubnoticecategory; ?>&page=<?php echo $page; ?>&subpage=<?php echo $i; ?>">[<?php echo $i; ?>]</a>
             <?php
                  }
                }
             ?>
            <!-- 다음 버튼 -->
             <?php if($block2 >= $total_block2){
               echo "";
             }else{
               $next_block2=$block_end2 +1;
                ?>
                <a href="./main.html?categoryid=3&subnoticecategory=<?php echo $dfsubnoticecategory; ?>&page=<?php echo $page; ?>&subpage=<?php echo $next_block2; ?>">다음</a>
              <?php } ?>
             <!-- 마지막 버튼 -->
             <?php if($subpage>=$total_page2){ ?>
               <span>마지막</span>
            <?php }else{ ?>
               <a href="./main.html?categoryid=3&subnoticecategory=<?php echo $dfsubnoticecategory; ?>&page=<?php echo $page; ?>&subpage=<?php echo $total_page2; ?>">마지막</a>
            <?php } ?>
           </div>
           <!--페이징 끝-->
         <?php }else{} ?>
           </div>
          </div>
           <div class="commentwrite_container">
             <form class="" name="commentregisterfrm" action="commentregister_ok.php" method="post">
               <input type="hidden" name="commentauthor" value="<?php echo $_SESSION['usernickname'];?>">
               <input type="hidden" name="commentpostid" value="<?php echo $idpostdata; ?>">
               <p style="text-align:left;font-size:20px;padding-left: 30px;font-weight:bold;">댓글 작성</p>
               <textarea name="commentdescription" id="commentdescription" rows="8" cols="80" style="width:750px;" placeholder="500자 이내"></textarea>
               <script type="text/javascript">
               $('#commentdescription').on('keyup', function() {

                 if($(this).val().length >500 ) {

                   alert("글자수는 500자 이내로 제한됩니다.");

                   $(this).val($(this).val().substring(0, 500));

                 }

               });
               </script>


               <?php if(empty($_SESSION['usernickname'])){ ?>
               <input type="button" name="" style="margin-top:10px;margin-bottom:10px;" class="btn btn-outline-dark" value="댓글 작성" onclick="loginalert();">
               <script type="text/javascript">
                 function loginalert(){
                   alert("먼저 로그인을 해주세요");
                 }
               </script>
             <?php }else{ ?>
               <input type="button" name="" style="margin-top:10px;margin-bottom:10px;" class="btn btn-outline-dark" value="댓글 작성" onclick="commentregister_click();">
               <script type="text/javascript">
                 function commentregister_click(){
                   var comment = $('#commentdescription').val();
                   if(!comment){
                    alert("내용을 입력해주세요");
                   }else{
                   document.commentregisterfrm.submit();
                   }
                 }
               </script>

             <?php } ?>
             </form>

           </div>
  <?php
}else{}


  ?>
  <!-- 게시물 보이는 곳 -->
            <div class="boardtable_container">
            <h4 style="float:left;margin-top:10px;">추천하기</h4>
            <?php
                    if(empty($_SESSION['usernickname'])===false){
                      ?>
                    <div id="write_btn" style="float:right;margin-top:10px;">
                      <form class="" action="./main.html?categoryid=3" method="post">
                        <input type="hidden" name="writecategory" value="1">
                        <input type="submit" name="" class="btn btn-outline-dark" value="글쓰기">
                      </form>
                    </div>
                    <?php
                  }else{}
                    ?>
        <table class="list-table">
          <thead>
              <tr>
                    <th width="70">번호</th>
                    <th width="70">분류</th>
                    <th width="500">제목</th>
                    <th width="120">글쓴이</th>
                    <th width="100">작성일</th>
                    <th width="100">조회수</th>
                </tr>
            </thead>
            <?php

              //페이징 위한 카운트
              $q3 = "SELECT COUNT(*) as cnt FROM postdata order by idpostdata desc";
              $result3 = $mysqli->query($q3);
              $row=mysqli_fetch_assoc($result3);

            	$allpost = $row['cnt']; //전체 게시글의 수

            	$onepage=10; // 한 페이지에 보여줄 게시글의 수.

            	$total_page = ceil($allpost / $onepage); //전체 페이지의 수

              if(is_numeric($page)==false||$page<0||$page>$total_page&&$total_page!=0){
                echo '<script>alert("잘못된 접근입니다.");document.location.href="./main.html?categoryid=3";</script>';
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



              $q = "SELECT * FROM postdata order by idpostdata desc limit $limit_start,$onepage";

              $result = $mysqli->query( $q);

              if($result->num_rows === 0 ){ ?>
                  <p style=" padding-top:50px; background-color:white;text-align:center;height:150px;margin-bottom: -0px;font-size:30px;"> 등록된 게시물이 없습니다.</p>
            <?php  }else{

              while($board = $result->fetch_array())
                {
                  $title=$board["title"];
                  $idpostdata = $board['idpostdata'];
                  $dateorigin=$board['date'];
                  $date=explode(' ',$dateorigin);
                  date_default_timezone_set('Asia/Seoul');
                  $curdate = date("Y-m-d");
                  if(strlen($title)>50)
                  {
                    $title=str_replace($board["title"],mb_substr($board["title"],0,50,"utf-8")."...",$board["title"]); //title이 30을 넘어서면 ...표시
                  }
            ?>
          <tbody>
            <tr>
              <td width="70"><?php echo $board['idpostdata']; ?></td>
              <td width="70"><?php echo $board['category']; ?></td>
              <td width="500"><a id="readcount_<?php echo $board['idpostdata']; ?>" style="cursor:pointer" ><?php echo $title;?> +<?php echo $board['commentcount']; ?></a></td>

               <script type="text/javascript">
                    $('#readcount_<?php echo $board['idpostdata']; ?>').click( function (){
                    var idpostdata_re = "<?php echo $board['idpostdata']; ?>";
                    var boardname = "postboard";
                    var udata={"boardname":boardname , "idpostdata_re":idpostdata_re};
                    $.ajax({
                      url: 'post_check.php',
                      type: "post",
                      data: udata,
                    }).done(function(data) {

                     location.href="./main.html?categoryid=3&subnoticecategory=<?php echo $idpostdata; ?>&page=<?php echo $page; ?>";

                    })

                });
               </script>

              <td width="120"><?php echo $board['author']; ?></td>
              <?php if($curdate===$date[0]){ ?>
              <td width="100"><?php echo $date[1]; ?></td>
              <?php }else{ ?>
              <td width="100"><?php echo $date[0]; ?></td>
              <?php } ?>
              <td width="100"><?php echo $board['count']; ?></td>
            </tr>
          </tbody>
          <?php }
        } ?>
        </table>
        <!--페이징-->
          <div class="" id="page">
           <!-- 처음 버튼 -->
            <?php
               if($page<=1){
            ?>
                 <span>처음</span>
            <?php
               }else{
            ?>
                 <a href="./main.html?categoryid=3&page=1">처음</a>

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
                 <a href="./main.html?categoryid=3&page=<?php echo $prev_block; ?>">이전</a>

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
                   <a href="./main.html?categoryid=3&page=<?php echo $i; ?>">[<?php echo $i; ?>]</a>
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
               <a href="./main.html?categoryid=3&page=<?php echo $next_block; ?>">다음</a>
             <?php } ?>
            <!-- 마지막 버튼 -->
            <?php if($page>=$total_page){ ?>
              <span>마지막</span>
           <?php }else{ ?>
              <a href="./main.html?categoryid=3&page=<?php echo $total_page; ?>">마지막</a>
           <?php } ?>
          </div>
         <!--페이징 끝-->


      </div>


</div>


<?php
}elseif($dfwritecategory==="1"){
 ?>
 <!--게시글 쓰기 -->
  <form action="noticeregister_ok.php" name="noticeregisterfrm" method="post">
 <div class="board_write">

           <div id="write_area">
                 <div class="write_title">
                   <h4 style="float:left;padding-left:10px;padding-top:10px;">게시글 작성</h4>
                 </div>
                 <div class="in_categorytext">
                   <pre style="float:right">게시글 분류</pre>
                 </div>
                 <div class="in_category">
                   <select name="category" style="float:left;margin-top:7px;">
                       <option value="판타지">판타지</option>
                       <option value="현대판타지">현대판타지</option>
                       <option value="로맨스판타지">로맨스판타지</option>
                       <option value="무협">무협</option>
                       <option value="로맨스">로맨스</option>


                   </select>
                  </div>
                    <div class="in_titletext">
                      <pre style="float:right">제목(50자 이내)</pre>
                    </div>
                   <div class="in_title">
                       <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" style="width:600px;margin-top:5px;" required></textarea>
                        <script type="text/javascript">
                        $('#utitle').on('keyup', function() {

                          if($(this).val().length >50 ) {

                            alert("글자수는 50자 이내로 제한됩니다.");

                            $(this).val($(this).val().substring(0, 50));

                          }

                        });
                        </script>
                   </div>
                   <div >
                       <input type="hidden" name="author" id="uauthor" value="<?php echo $dfusernickname ?>">
                   </div>
                   <div class="in_descriptiontext">
                     <pre style="float:right">내용</pre>
                   </div>

                   <div class="in_description">
                     <textarea name="description" id="editor" style="display:none;"></textarea>

    <!--
                    <textarea name="description" id="udescription" placeholder="내용" style="width:100%;min-height:300px;height:auto" required></textarea>

                       <script type="text/javascript">
                       $('#udescription').on('keyup', function() {

                         if($(this).val().length >1000 ) {

                           alert("글자수는 1000자 이내로 제한됩니다.");

                           $(this).val($(this).val().substring(0, 1000));

                         }

                       });
                       </script>
                       //   if($('#udescription').val().length>100){
                       //     document.noticeregisterfrm.submit();
                       //   }else{
                       //     alert("내용은 100자 이상 입력해야합니다.");
                       //   }
-->
                   </div>

                   <div class="bt_se">
                     <input type="button" name="" class="btn btn-outline-dark" value="게시글 등록"  onclick="noticeregister();">
                     <script type="text/javascript">

                       function noticeregister(){
                         var titlecheck = $('#utitle').val();
                        if(!titlecheck){
                         alert("제목을 입력해주세요");
                         }else{
                           if(getDataFromTheEditor().length!=0){
                         var result_js = confirm("정말로 등록하시겠습니까?");

                         if(result_js==true){
                                    document.noticeregisterfrm.submit();
                          }else if(result_js==false){

                          }

                         }else{
                           alert("내용을 입력해주세요");
                         }

                       }
                       }
                     </script>
                     <input type="button" name="" class="btn btn-outline-dark" value="돌아가기" onclick="location.href='./main.html?categoryid=3'">

                   </div>


           </div>
       </div>

</form>

<?php
//게시글 수정
}elseif($dfwritecategory==="2"){
  $q = "SELECT * FROM postdata WHERE idpostdata='$dfsubnoticecategory'";
  $result = $mysqli->query($q);
  $board = $result->fetch_array(MYSQLI_ASSOC);
      $idpostdata=$board["idpostdata"];
      $title=$board["title"];
      $category=$board['category'];
      $author=$board['author'];
      $date=$board['date'];
      $count=$board['count'];
      $description=$board['description'];
 ?>
 <form action="noticemodify_ok.php" name="noticemodifyfrm" method="post">
<div class="board_write">
          <input type="hidden" name="idpostdata" value="<?php echo $idpostdata; ?>">
          <div id="write_area">
                <div class="write_title">
                  <h4 style="float:left;padding-left:10px;padding-top:10px;">게시글 수정</h4>
                </div>
                <div class="in_categorytext">
                  <pre style="float:right">게시글 분류</pre>
                </div>
                <div class="in_category">
                  <select name="category" style="float:left;margin-top:7px;">
                    <option value="판타지">판타지</option>
                    <option value="현대판타지">현대판타지</option>
                    <option value="로맨스판타지">로맨스판타지</option>
                    <option value="무협">무협</option>
                    <option value="로맨스">로맨스</option>

                  </select>
                 </div>
                   <div class="in_titletext">
                    <pre style="float:right">제목(50자 이내)</pre>
                   </div>
                  <div class="in_title">

                      <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" style="width:600px;margin-top:5px;" required><?php echo $title; ?></textarea>
                       <script type="text/javascript">
                       $('#utitle').on('keyup', function() {

                         if($(this).val().length >50 ) {

                           alert("글자수는 50자 이내로 제한됩니다.");

                           $(this).val($(this).val().substring(0, 50));

                         }

                       });
                       </script>
                  </div>
                  <div >
                      <input type="hidden" name="author" id="uauthor" value="<?php echo $dfusernickname; ?>">
                  </div>
                  <div class="in_descriptiontext">
                    <pre style="float:right">내용</pre>
                  </div>
                  <div class="in_description">

                    <textarea name="description" id="editor" style="display:none;" style="width:100%;min-height:300px;height:auto" required><?php echo $description; ?></textarea>

                  </div>

                  <div class="bt_se">

                      <input type="button" name="" class="btn btn-outline-dark" value="글 수정"  onclick="noticemodify();">
                      <script type="text/javascript">
                        function noticemodify(){
                          var titlecheck = $('#utitle').val();
                          if(getDataFromTheEditor().length!=0){
                            if(!titlecheck){

                             alert("제목을 입력해주세요");

                            }else{

                              var result_js = confirm("정말로 수정하시겠습니까?");
                              if(result_js==true){
                                document.noticemodifyfrm.submit();
                              }else if(result_js==false){

                              }

                            }

                          }else{
                            alert("내용을 입력해주세요");
                          }
                        }
                      </script>
                      <input type="button" name="" class="btn btn-outline-dark" value="돌아가기" onclick="location.href='./main.html?categoryid=3&subnoticecategory=<?php echo $dfsubnoticecategory; ?>'">

                  </div>


          </div>
      </div>

</form>

<?php
}
 ?>

   </section>
   <script>
   let theEditor;
       ClassicEditor
           .create( document.querySelector( '#editor' ),{
             language: 'ko',
             cloudServices: {
               tokenUrl: 'https://40771.cke-cs.com/token/dev/GayqKAD24SB7FboAEVpawi6vyhEyjYKDIx9rAdWK1lgdgE4gwPN3GmEUBE8L',
               uploadUrl: 'https://40771.cke-cs.com/easyimage/upload/'
             }

           } )
           .then( editor => {
                      theEditor = editor;

                   } )
           .catch( error => {
               console.error( error );
           } );
           function getDataFromTheEditor() {
             return theEditor.getData();
           }

   </script>
  </body>
</html>
