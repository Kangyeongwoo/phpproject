<div class="fictionintro_container">
  <div class="fictionintro_grid">
    <div class="fictionhome_image">
        <img src="<?php echo $myfictionlist["fiction_imagepath"]; ?>" alt="" draggable="false" style="width: 100%; height: 100%;">
    </div>
    <div class="fictionhome_title">
        <p style="float:left;"><?php echo $myfictionlist["fiction_title"]; ?></p>
    </div>
    <div class="fictionhome_author">
        <p style="float:left;"><?php echo $myfictionlist["fiction_author"]; ?></p>
    </div>
    <div class="fictionhome_button">
      <input type="button" class="btn btn-outline-dark"  name="" value="첫화보기" style="float:right;" onclick="readcount_start();">
      <?php
      $q9 = "SELECT * FROM chapterdata WHERE chapter_fictionid='$dffictionid' AND chapter_number=1";
      $result9 = $mysqli->query( $q9);
      $chapterprice=$result9->fetch_array();

      if(empty($chapterprice)){

      }else{
        if($chapterprice["chapter_category"]=="무료"){ ?>

          <script type="text/javascript">
             function readcount_start(){
                     var boardname = "fiction";
                     var chapterdata_re = 1;
                     var fictiondata_re ="<?php echo $myfictionlist["idfictiondata"]; ?>";
                     var udata={"boardname":boardname , "chapterdata_re":chapterdata_re , "fictiondata_re":fictiondata_re };
                     $.ajax({
                       url: "boardcount_check.php",
                       type: "post",
                       data: udata,
                     }).done(function(data) {

                      location.href="./fictionhome.html?fictionid=<?php echo $dffictionid; ?>&chapter=1";

                     });
                 }
           </script>

        <?php }elseif($chapterprice["chapter_category"]=="유료"){ ?>

          <script type="text/javascript">
          function readcount_start(){
                  var boardname = "fiction";
                  var chapterdata_re =1;
                  var fictiondata_re ="<?php echo $myfictionlist["idfictiondata"]; ?>";
                  var dfuserid = "<?php echo $dfuserid; ?>";
                  var idchapterdata="<?php echo $chapterprice['idchapterdata']; ?>"
                  var udata={"boardname":boardname , "chapterdata_re":chapterdata_re , "fictiondata_re":fictiondata_re, "dfuserid":dfuserid, "idchapterdata":idchapterdata };
                  $.ajax({
                    url: "buylist_check.php",
                    type: "post",
                    data: udata,
                  }).done(function(data) {
                   if(data=="no"){
                     alert("먼저 작품을 구매해야 합니다.");
                   }else{
                    location.href="./fictionhome.html?fictionid=<?php echo $dffictionid; ?>&chapter=1";
                   }
                  });
              }
          </script>

     <?php   }
      }
      ?>   <?php if(empty($_SESSION["userid"])){ ?>
      <button type="button" id="favoritebutton" class="btn btn-outline-dark" style="float:right;margin-right:10px;" name="button" onclick="favorite_not();"><img src="./siteimage/star.png" style="margin-right:10px;" alt=""><?php echo $myfictionlist["fiction_favorite"];?> 명</button>
         <script type="text/javascript">
           function favorite_not(){
             alert("먼저 로그인을 해주세요");
           }
         </script>
       <?php }else{
         $q8="SELECT * FROM favoritefictiondata WHERE favoritefiction_userid='$dfuserid' AND favoritefiction_fictionid='$dffictionid'";
         $fav=$mysqli->query($q8);
         $favorite=$fav->fetch_array();
         if(empty($favorite)){ ?>
           <button type="button" id="favoritebutton" class="btn btn-outline-dark" style="float:right;margin-right:10px;" name="button" onclick="check_favorite();"><img style="margin-right:10px;" id="star" src="./siteimage/star.png" alt=""><span id="starval"><?php echo $myfictionlist["fiction_favorite"];?> 명</span></button>
        <?php   }else{ ?>
           <button type="button" id="favoritebutton" class="btn btn-outline-dark" style="float:right;margin-right:10px;" name="button" onclick="check_favorite();"><img style="margin-right:10px;" id="star" src="./siteimage/star2.png" alt=""><span id="starval"><?php echo $myfictionlist["fiction_favorite"];?> 명</span></button>

        <?php  }

         ?>
         <script type="text/javascript">
            function check_favorite(){
                    var uid ="<?php echo $_SESSION['userid']; ?>";
                    var favoritefictiondata ="<?php echo $myfictionlist["idfictiondata"]; ?>";
                    var udata={"uid":uid , "favoritefictiondata":favoritefictiondata };
                    $.ajax({
                      url: "favoritefiction_check.php",
                      type: "post",
                      data: udata,
                    }).done(function(data) {

                        var datasplit = data.split(',');

                         if(datasplit[0]=="no"){
                           $('#star').attr("src","./siteimage/star.png");
                           $('#starval').text(datasplit[1]+" 명");
                         }else{
                           $('#star').attr("src","./siteimage/star2.png");
                            $('#starval').text(datasplit[1]+" 명");
                         }


                    });
                }
          </script>
       <?php } ?>
       </div>
  </div>
</div>

<?php
$q4 = "SELECT * FROM chapternoticedata WHERE chapternotice_fictionid='$dffictionid' AND chapternotice_number='$dfnotice'";
$result4 = $mysqli->query( $q4);
$readfictionlist =$result4->fetch_array();
  if(empty($readfictionlist["idchapternoticedata"])){
    echo '<script>alert("잘못된 접근입니다.");document.location.href="./main.html";</script>';

  }
  $readfictionlist["chapternotice_title"];
  $readfictionlist["chapternotice_description"];


?>
<?php if($_SESSION['usernickname']==$myfictionlist["fiction_author"]){ ?>
<div class="fictionread_bt">
  <form class="" action="fictionhome.html?fictionid=<?php echo $dffictionid; ?>&writeid=4" method="post">
    <input type="hidden" name="chaptertitle_mo" value="<?php echo $readfictionlist["chapternotice_title"]; ?>">
    <input type="hidden" name="chapterdescription_mo" value="<?php echo $readfictionlist["chapternotice_description"]; ?>">
    <input type="hidden" name="fictionid_mo" value="<?php echo $dffictionid; ?>">
    <input type="hidden" name="chapternumber_mo" value="<?php echo $dfnotice; ?>">
<input type="hidden" name="idchapterdata_mo" value="<?php echo $readfictionlist["idchapternoticedata"];; ?>">
    <input type="submit" name="" style="float:right;margin:3px" class="btn btn-outline-dark" value="수정">
  </form>
  <form class="" name="chapterdeletefrm" action="chapternoticedelete_ok.php" method="post">
    <input type="hidden" name="idchapterdata" value="<?php echo $readfictionlist["idchapternoticedata"]; ?>">
    <input type="hidden" name="fictionid" value="<?php echo $dffictionid; ?>">
    <input type="hidden" name="chapternumber" value="<?php echo $dfnotice ?>">
    <input type="hidden" name="author" value="<?php echo $myfictionlist["fiction_author"]; ?>">
    <input type="button" name="" style="float:right;margin:3px" value="삭제" class="btn btn-outline-dark" onclick="chapterdelete();">
    <script type="text/javascript">
      function chapterdelete(){
        var result_js3 = confirm("정말로 삭제하시겠습니까?");
        if(result_js3==true){
          document.chapterdeletefrm.submit();
        }else if(result_js3==false){

        }
      }
    </script>
  </form>
</div>
<?php } ?>
<!-- 글 읽는 부분-->
<div class="fictionread_container">
   <h4 style="text-align:left;padding:10px;border-bottom:1px dashed gray;"><?php echo $readfictionlist["chapternotice_title"]; ?></h4>

   <p style="text-align:left;padding:10px;border-bottom:1px dashed gray;"><?php echo $readfictionlist["chapternotice_description"]; ?></p>
   </div>



<!-- 글 댓글 부분 -->
<div class="comment_containerout">


<div class="comment_container">
  <div class="" style="border-bottom:1px solid blue;">
    <h4 style="padding-top:10px;padding-bottom:10px;text-align:left;">Comment '<?php echo $readfictionlist['chapternotice_commentcount']; ?></h4>
  </div>
  <?php
  $subpage = $_GET['subpage'];
  if(empty($subpage)){
    $subpage=1;
  }

  $q5 = "SELECT COUNT(*) as cnt FROM chapternoticecommentdata WHERE fictiondataid='$dffictionid' AND chapternoticedataid='$dfnotice' ";
  $result5 = $mysqli->query($q5);
  $row2=mysqli_fetch_assoc($result5);

  $allpost2 = $row2['cnt']; //전체 게시글의 수

  $onepage2=15; // 한 페이지에 보여줄 게시글의 수.

  $total_page2 = ceil($allpost2 / $onepage2); //전체 페이지의 수

  if(is_numeric($subpage)==false||$subpage<0||$subpage>$total_page2&&$total_page2!=0){
    ?>
    <script type="text/javascript">
      alert("잘못된 접근입니다.");
      location.href="./fictionhome.html?fictionid=<?php echo $dffictionid?>";
    </script>
    <?php
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




  $q2 = "SELECT * FROM chapternoticecommentdata WHERE fictiondataid='$dffictionid' AND chapternoticedataid='$dfnotice' order by idchapternoticecommentdata asc limit $limit_start2,$onepage2";
  $result2 = $mysqli->query( $q2);

  while($board2 = $result2->fetch_array())
  { $idchaptercommentdata=$board2['idchapternoticecommentdata'];
    $chaptercommentauthor=$board2['author'];
    ?>
  <div class="commentgrid">
    <div class="comment_nickname">

         <p><?php echo $board2['author']; ?></p>
    </div>
    <div class="comment_date">
         <p><?php echo $board2['date']; ?></p>
    </div>
    <div class="comment_description">
      <p style="word-break:break-all;text-align: left;padding-left:10px;"><?php echo $board2['description']; ?></p>
    </div>
    <div class="comment_bt">
        <?php if(empty($_SESSION['usernickname'])){ ?>
        <!-- <a href="#" onclick="alert('먼저 로그인을 해주세요'); return false;">답댓글</a> -->
       <?php }else{?>
      <!--  <a href="#" style="float:right;padding-right:10px;" >답댓글</a> -->
        <?php if($_SESSION['usernickname']===$board2['author']){ ?>
          <a href="#" style="float:right;padding-right:10px;" onclick="commentdelete_<?php echo $idchaptercommentdata; ?>();">삭제</a>
           <form class="" name="commentdeletefrm_<?php echo $idchaptercommentdata; ?>" action="chapternoticecommentdelete_ok.php" method="post">
             <input type="hidden" name="idchaptercommentdata" value="<?php echo $board2['idchapternoticecommentdata']; ?>">
             <input type="hidden" name="commentauthor" value="<?php echo $chaptercommentauthor; ?>">
             <input type="hidden" name="fictionid" value="<?php echo $dffictionid; ?>">
             <input type="hidden" name="chapter" value="<?php echo $dfnotice; ?>">

             <script type="text/javascript">
               function commentdelete_<?php echo $idchaptercommentdata; ?>(){
                 var result_js2 = confirm("정말로 삭제하시겠습니까?");
                 if(result_js2==true){
                   document.commentdeletefrm_<?php echo $idchaptercommentdata; ?>.submit();
                 }else if(result_js2==false){

                 }
               }
             </script>
           </form>

          <?php } ?>
       <?php } ?>
    </div>
  </div>
<?php } ?>
<?php if(!empty($allpost2)){ ?>
<div class="" id="subpage">
 <!-- 처음 버튼 -->
  <?php
     if($subpage<=1){
  ?>
       <span>처음</span>
  <?php
     }else{
  ?>
       <a href="./fictionhome.html?fictionid=<?php echo $dffictionid; ?>&notice=<?php echo $dfnotice; ?>&page=<?php echo $page; ?>&subpage=1">처음</a>

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
       <a href="./fictionhome.html?fictionid=<?php echo $dffictionid; ?>&notice=<?php echo $dfnotice; ?>&page=<?php echo $page; ?>&subpage=<?php echo $prev_block2; ?>">이전</a>

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
         <a href="./fictionhome.html?fictionid=<?php echo $dffictionid; ?>&notice=<?php echo $dfnotice; ?>&page=<?php echo $page; ?>&subpage=<?php echo $i; ?>">[<?php echo $i; ?>]</a>
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
     <a href="./fictionhome.html?fictionid=<?php echo $dffictionid; ?>&notice=<?php echo $dfnotice; ?>&page=<?php echo $page; ?>&subpage=<?php echo $next_block2; ?>">다음</a>
   <?php } ?>
  <!-- 마지막 버튼 -->
  <?php if($subpage>=$total_page2){ ?>
    <span>마지막</span>
 <?php }else{ ?>
    <a href="./fictionhome.html?fictionid=<?php echo $dffictionid; ?>&notice=<?php echo $dfnotice; ?>&page=<?php echo $page; ?>&subpage=<?php echo $total_page2; ?>">마지막</a>
 <?php } ?>
</div>
<?php }else{} ?>
<!--페이징 끝-->


</div>
</div>
<div class="commentwrite_container" >
  <form class="" name="commentregisterfrm" action="chapternoticecommentregister_ok.php" method="post">
    <input type="hidden" name="commentauthor" value="<?php echo $_SESSION['usernickname'];?>">
    <input type="hidden" name="fictionid" value="<?php echo $dffictionid; ?>">
    <input type="hidden" name="chapter" value="<?php echo $dfnotice; ?>">
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
if($myfictionlist["fiction_author"]===$_SESSION['usernickname']){
?>
 <div class="authorbutton" style="margin-top:3px;">

   <?php if($myfictionlist["fiction_pricecategory"]=="유료"){ ?>
     <form class="" name="buyfrm" action="buy_check.php" method="POST">
       <input type="hidden" name="buylist" id="buylist" value="">
       <input type="hidden" name="fictionid" value="<?php echo $dffictionid; ?>">
       <input style="float:left;margin:3px" type="button" class="btn btn-outline-dark" name="" value="구매하기" onclick="buysubmit();">
     </form>
     <script type="text/javascript">
       function buysubmit(){
             var dfuserid2 = "<?php echo $dfuserid; ?>";
             if(!dfuserid2){alert("먼저 로그인을 해주세요");}else{
       var send_array = Array();
       var send_cnt = 0;
       var chkbox = $(".buyCheckbox");

       for(i=0;i<chkbox.length;i++) {
        if (chkbox[i].checked == true){
         send_array[send_cnt] = chkbox[i].value;
        send_cnt++;
        }
        }
        if(send_array.length==0){
          alert("구매할 항목을 선택해 주세요");
        }else{
        $("#buylist").val(send_array);
        document.buyfrm.submit();
        }
   }
       }
     </script>
   <?php } ?>

    <!--글쓰기버튼-->
    <form class="" action="./userpage.html" method="get">
        <input type="hidden" name="usercategoryid" value="4">
          <input type="hidden" name="myfictioncategoryid" value="2">
      <input type="hidden" name="fictionid" value="<?php echo $myfictionlist["idfictiondata"]; ?>">
      <input style="float:right;margin:3px" type="submit" class="btn btn-outline-dark" name="" value="작품 설정">
    </form>

    <form class="" action="fictionhome.html" method="get">
      <input type="hidden" name="fictionid" value="<?php echo $myfictionlist["idfictiondata"]; ?>">
      <input type="hidden" name="writeid" value="1">
      <input style="float:right;margin:3px" type="submit" class="btn btn-outline-dark" name="" value="글쓰기">
    </form>

    <!--공지쓰기버튼-->
    <form class="" action="fictionhome.html" method="get">
      <input type="hidden" name="fictionid" value="<?php echo $myfictionlist["idfictiondata"]; ?>">
      <input type="hidden" name="writeid" value="2">
      <input style="float:right;margin:3px" type="submit" class="btn btn-outline-dark" name="" value="공지쓰기">
    </form>
 </div>
 <?php
}
?>
<!-- 글 게시판 부분 -->

       <?php
       if($myfictionlist["fiction_pricecategory"]=="무료"){
         ?>
        <div class="fictiontable_container" >
          <table class="list-fictiontable" >
            <thead>
                <tr>
                      <th width="70">번호</th>
                      <th width="500">제목</th>
                      <th width="100">작성일</th>
                      <th width="100">조회수</th>
                </tr>

            </thead>
              <?php

              $q3 = "SELECT * FROM chapternoticedata WHERE chapternotice_fictionid='$dffictionid' order by chapternotice_number desc";
              $result3 = $mysqli->query( $q3);
                while($board =$result3->fetch_array()){
                   $dateorigin=$board['chapternotice_date'];
                   $date=explode(' ',$dateorigin);
                   date_default_timezone_set('Asia/Seoul');
                   $curdate = date("Y-m-d");

                    $title=$board["chapternotice_title"];
                    if(strlen($title)>30)
                    {
                      $title=str_replace($board["chapternotice_title"],mb_substr($board["chapternotice_title"],0,30,"utf-8")."...",$board["chapternotice_title"]); //title이 30을 넘어서면 ...표시
                    }
              ?>

             <tbody >

              <tr >
                <td width="70">공지</td>
                <?php if($curdate==$date[0]){ ?>
                  <td width="500"><a style="cursor:pointer;" onclick="readcount2_<?php echo $board['chapternotice_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>();" ><img src="./siteimage/newimage.png" alt=""> <?php echo $title;?> +<?php echo $board['chapternotice_commentcount']; ?></a></td>
                  <script type="text/javascript">
                     function readcount2_<?php echo $board['chapternotice_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>(){
                             var boardname = "notice";
                             var chapternoticedata_re ="<?php echo $board['chapternotice_number']; ?>";
                             var fictiondata_re ="<?php echo $myfictionlist["idfictiondata"]; ?>";
                             var udata={"boardname":boardname , "chapternoticedata_re":chapternoticedata_re , "fictiondata_re":fictiondata_re };
                             $.ajax({
                               url: "boardnoticecount_check.php",
                               type: "post",
                               data: udata,
                             }).done(function(data) {

                              location.href="./fictionhome.html?fictionid=<?php echo $myfictionlist["idfictiondata"]?>&notice=<?php echo $board['chapternotice_number']; ?>"

                             });
                         }
                   </script>
                <td width="100"><?php echo $date[1] ?></td>
                <?php }else{?>
                  <td width="500"><a style="cursor:pointer;" onclick="readcount2_<?php echo $board['chapternotice_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>();" > <?php echo $title;?> +<?php echo $board['chapternotice_commentcount']; ?></a></td>
                  <script type="text/javascript">
                     function readcount2_<?php echo $board['chapternotice_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>(){
                             var boardname = "notice";
                             var chapternoticedata_re ="<?php echo $board['chapternotice_number']; ?>";
                             var fictiondata_re ="<?php echo $myfictionlist["idfictiondata"]; ?>";
                             var udata={"boardname":boardname , "chapternoticedata_re":chapternoticedata_re , "fictiondata_re":fictiondata_re };
                             $.ajax({
                               url: "boardnoticecount_check.php",
                               type: "post",
                               data: udata,
                             }).done(function(data) {

                              location.href="./fictionhome.html?fictionid=<?php echo $myfictionlist["idfictiondata"]?>&notice=<?php echo $board['chapternotice_number']; ?>"

                             });
                         }
                   </script>

                <td width="100"><?php echo $date[0] ?></td>
                <?php } ?>
                <td width="100"><?php echo $board['chapternotice_count']; ?></td>
              </tr>
            </tbody>

            <?php } ?>
          </table>

        </div>
        <!-- 무료화 부분 챕터 -->
        <div class="fictiontable_container" >
          <table class="list-fictiontable">
              <?php

              $q6 = "SELECT COUNT(*) as cnt FROM chapterdata WHERE chapter_fictionid='$dffictionid' order by chapter_number desc";
              $result6 = $mysqli->query($q6);
              $row=mysqli_fetch_assoc($result6);

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

                $q7="SELECT * FROM readchapterdata WHERE userid='$dfuserid' AND readfictionid='$dffictionid'";
                $readsub = $mysqli->query($q7);
                $read= $readsub->fetch_array();

                $q2 = "SELECT * FROM chapterdata WHERE chapter_fictionid='$dffictionid' order by idchapterdata desc limit $limit_start,$onepage";
                $result2 = $mysqli->query( $q2);
                while($board =$result2->fetch_array()){

                   $dateorigin=$board['chapter_date'];
                   $date=explode(' ',$dateorigin);
                   date_default_timezone_set('Asia/Seoul');
                   $curdate = date("Y-m-d");


                    $title=$board["chapter_title"];
                    if(strlen($title)>30)
                    {
                      $title=str_replace($board["chapter_title"],mb_substr($board["chapter_title"],0,30,"utf-8")."...",$board["chapter_title"]); //title이 30을 넘어서면 ...표시
                    }
              ?>

             <tbody>

              <tr >
                <td width="70"><?php echo $board['chapter_number']; ?></td>
                  <?php if($curdate==$date[0]){ ?>
                  <td width="500"><a style="cursor:pointer" class="title_<?php echo $board['idchapterdata']; ?>" onclick="readcount_<?php echo $board['chapter_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>();" ><img src="./siteimage/newimage.png" alt=""> <?php echo $title;?> +<?php echo $board['chapter_commentcount']; ?></a></td>
                  <script type="text/javascript">
                     function readcount_<?php echo $board['chapter_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>(){
                             var boardname = "fiction";
                             var chapterdata_re ="<?php echo $board['chapter_number']; ?>";
                             var fictiondata_re ="<?php echo $myfictionlist["idfictiondata"]; ?>";
                             var udata={"boardname":boardname , "chapterdata_re":chapterdata_re , "fictiondata_re":fictiondata_re };
                             $.ajax({
                               url: "boardcount_check.php",
                               type: "post",
                               data: udata,
                             }).done(function(data) {

                              location.href="./fictionhome.html?fictionid=<?php echo $myfictionlist["idfictiondata"]?>&chapter=<?php echo $board['chapter_number']; ?>"

                             });
                         }
                   </script>
                   <?php
                   if(empty($read)==false){
                     if($board['chapter_number']<=$read['readchapternumber']){ ?>
                      <script type="text/javascript">
                        $('.title_<?php echo $board['idchapterdata']; ?>').css("color","#bdbebd");
                      </script>
                    <?php }
                   }
                   ?>

                <td width="100"><?php echo $date[1] ?></td>
                <?php }else{?>
                  <td width="500"><a style="cursor:pointer" class="title_<?php echo $board['idchapterdata']; ?>" onclick="readcount_<?php echo $board['chapter_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>();" > <?php echo $title;?> +<?php echo $board['chapter_commentcount']; ?></a></td>
                  <script type="text/javascript">
                     function readcount_<?php echo $board['chapter_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>(){
                             var boardname = "fiction";
                             var chapterdata_re ="<?php echo $board['chapter_number']; ?>";
                             var fictiondata_re ="<?php echo $myfictionlist["idfictiondata"]; ?>";
                             var udata={"boardname":boardname , "chapterdata_re":chapterdata_re , "fictiondata_re":fictiondata_re };
                             $.ajax({
                               url: "boardcount_check.php",
                               type: "post",
                               data: udata,
                             }).done(function(data) {

                              location.href="./fictionhome.html?fictionid=<?php echo $myfictionlist["idfictiondata"]?>&chapter=<?php echo $board['chapter_number']; ?>"

                             });
                         }
                   </script>
                   <?php
                   if(empty($read)==false){
                     if($board['chapter_number']<=$read['readchapternumber']){ ?>
                      <script type="text/javascript">
                        $('.title_<?php echo $board['idchapterdata']; ?>').css("color","#bdbebd");
                      </script>
                    <?php }
                   }
                   ?>
                <td width="100"><?php echo $date[0] ?></td>
                <?php } ?>

                <td width="100"><?php echo $board['chapter_count']; ?></td>
              </tr>
            </tbody>

            <?php } ?>
          </table>
          <?php if(!empty($allpost)){?>
          <div class="" id="page">
           <!-- 처음 버튼 -->
            <?php
               if($page<=1){
            ?>
                 <span>처음</span>
            <?php
               }else{
            ?>
                 <a href="./fictionhome.html?fictionid=<?php echo $dffictionid; ?>&page=1">처음</a>

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
                 <a href="./fictionhome.html?fictionid=<?php echo $dffictionid; ?>&page=<?php echo $prev_block; ?>">이전</a>

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
                   <a href="./fictionhome.html?fictionid=<?php echo $dffictionid; ?>&page=<?php echo $i; ?>">[<?php echo $i; ?>]</a>
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
               <a href="./fictionhome.html?fictionid=<?php echo $dffictionid; ?>&page=<?php echo $next_block; ?>">다음</a>
             <?php } ?>
            <!-- 마지막 버튼 -->
            <?php if($page>=$total_page){ ?>
              <span>마지막</span>
           <?php }else{ ?>
              <a href="./fictionhome.html?fictionid=<?php echo $dffictionid; ?>&page=<?php echo $total_page; ?>">마지막</a>
           <?php } ?>
          </div>
        <?php }else{

        } ?>
        </div>
         <!--무료화부분 끝-->
      <?php
    }elseif($myfictionlist["fiction_pricecategory"]=="유료"){
      ?>
      <!-- 유료화 부분 시작-->

      <div class="fictiontable_container" >
        <table class="list-fictiontable" >
          <thead>
              <tr>
                    <th width="70">결제</th>
                    <th width="70">번호</th>
                    <th width="460">제목</th>
                    <th width="100">작성일</th>
                    <th width="100">조회수</th>
              </tr>

          </thead>
          <?php

          $q3 = "SELECT * FROM chapternoticedata WHERE chapternotice_fictionid='$dffictionid' order by chapternotice_number desc";
          $result3 = $mysqli->query( $q3);
            while($board =$result3->fetch_array()){
               $dateorigin=$board['chapternotice_date'];
               $date=explode(' ',$dateorigin);
               date_default_timezone_set('Asia/Seoul');
               $curdate = date("Y-m-d");

                $title=$board["chapternotice_title"];
                if(strlen($title)>30)
                {
                  $title=str_replace($board["chapternotice_title"],mb_substr($board["chapternotice_title"],0,30,"utf-8")."...",$board["chapternotice_title"]); //title이 30을 넘어서면 ...표시
                }
          ?>

         <tbody >

          <tr >
            <td width="70"></td>
            <td width="70">공지</td>
            <?php if($curdate==$date[0]){ ?>
              <td width="460"><a style="cursor:pointer;" onclick="readcount2_<?php echo $board['chapternotice_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>();" ><img src="./siteimage/newimage.png" alt=""> <?php echo $title;?> +<?php echo $board['chapternotice_commentcount']; ?></a></td>
              <script type="text/javascript">
                 function readcount2_<?php echo $board['chapternotice_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>(){
                         var boardname = "notice";
                         var chapternoticedata_re ="<?php echo $board['chapternotice_number']; ?>";
                         var fictiondata_re ="<?php echo $myfictionlist["idfictiondata"]; ?>";
                         var udata={"boardname":boardname , "chapternoticedata_re":chapternoticedata_re , "fictiondata_re":fictiondata_re };
                         $.ajax({
                           url: "boardnoticecount_check.php",
                           type: "post",
                           data: udata,
                         }).done(function(data) {

                          location.href="./fictionhome.html?fictionid=<?php echo $myfictionlist["idfictiondata"]?>&notice=<?php echo $board['chapternotice_number']; ?>"

                         });
                     }
               </script>
            <td width="100"><?php echo $date[1] ?></td>
            <?php }else{?>
              <td width="460"><a style="cursor:pointer;" onclick="readcount2_<?php echo $board['chapternotice_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>();" > <?php echo $title;?> +<?php echo $board['chapternotice_commentcount']; ?></a></td>
              <script type="text/javascript">
                 function readcount2_<?php echo $board['chapternotice_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>(){
                         var boardname = "notice";
                         var chapternoticedata_re ="<?php echo $board['chapternotice_number']; ?>";
                         var fictiondata_re ="<?php echo $myfictionlist["idfictiondata"]; ?>";
                         var udata={"boardname":boardname , "chapternoticedata_re":chapternoticedata_re , "fictiondata_re":fictiondata_re };
                         $.ajax({
                           url: "boardnoticecount_check.php",
                           type: "post",
                           data: udata,
                         }).done(function(data) {

                          location.href="./fictionhome.html?fictionid=<?php echo $myfictionlist["idfictiondata"]?>&notice=<?php echo $board['chapternotice_number']; ?>"

                         });
                     }
               </script>
            <td width="100"><?php echo $date[0] ?></td>
            <?php } ?>
            <td width="100"><?php echo $board['chapternotice_count']; ?></td>
          </tr>
        </tbody>

        <?php } ?>
        </table>

      </div>
      <!-- 유료화 부분 챕터 -->
      <div class="fictiontable_container" >
        <table class="list-fictiontable">

            <?php
            $q6 = "SELECT COUNT(*) as cnt FROM chapterdata WHERE chapter_fictionid='$dffictionid' order by chapter_number desc ";
            $result6 = $mysqli->query($q6);
            $row=mysqli_fetch_assoc($result6);

            $allpost = $row['cnt']; //전체 게시글의 수

            $onepage=10; // 한 페이지에 보여줄 게시글의 수.

            $total_page = ceil($allpost / $onepage); //전체 페이지의 수

            if(is_numeric($page)==false||$page<0||$page>$total_page&&$total_page!=0){
              ?>
              <script type="text/javascript">
               alert("<?php echo $page ?>");
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

            $q7="SELECT * FROM readchapterdata WHERE userid='$dfuserid' AND readfictionid='$dffictionid'";
            $readsub = $mysqli->query($q7);
            $read= $readsub->fetch_array();

              $q2 = "SELECT * FROM chapterdata WHERE chapter_fictionid='$dffictionid' order by idchapterdata desc limit $limit_start,$onepage";
              $result2 = $mysqli->query( $q2);
              while($board =$result2->fetch_array()){
                $dateorigin=$board['chapter_date'];
                $date=explode(' ',$dateorigin);
                date_default_timezone_set('Asia/Seoul');
                $curdate = date("Y-m-d");

                  $title=$board["chapter_title"];
                  if(strlen($title)>30)
                  {
                    $title=str_replace($board["chapter_title"],mb_substr($board["chapter_title"],0,30,"utf-8")."...",$board["chapter_title"]); //title이 30을 넘어서면 ...표시
                  }
            ?>

           <tbody>

            <tr >
              <?php if($board["chapter_category"]=="무료") {?>
              <th width="70"><input type="checkbox" disabled style="border-bottom:1px solid #CCC;" name="" value=""></th>
              <?php }elseif($board["chapter_category"]=="유료"){

                if(in_array($board['idchapterdata'],$buy_chapterlist)){?>
                  <th width="70"><input type="checkbox" disabled style="border-bottom:1px solid #CCC;"  value="<?php echo $board['idchapterdata']; ?>"></th>

                <?php }else{?>
                  <th width="70"><input type="checkbox" class="buyCheckbox" style="border-bottom:1px solid #CCC;" name="buyid[]" value="<?php echo $board['idchapterdata']; ?>"></th>

                <?php } ?>

              <?php } ?>

              <td width="70"><?php echo $board['chapter_number']; ?></td>


              <?php if($curdate==$date[0]){ ?>
               <?php if($board["chapter_category"]=="무료") {?>
                 <td width="460"><a style="cursor:pointer;" class="title_<?php echo $board['idchapterdata']; ?>" onclick="readcount_<?php echo $board['chapter_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>();"><pre style="float:left;">[Free]</pre><img src="./siteimage/newimage.png" alt=""> <?php echo $title;?> +<?php echo $board['chapter_commentcount']; ?></a></td>
                 <script type="text/javascript">
                    function readcount_<?php echo $board['chapter_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>(){
                            var boardname = "fiction";
                            var chapterdata_re ="<?php echo $board['chapter_number']; ?>";
                            var fictiondata_re ="<?php echo $myfictionlist["idfictiondata"]; ?>";
                            var udata={"boardname":boardname , "chapterdata_re":chapterdata_re , "fictiondata_re":fictiondata_re };
                            $.ajax({
                              url: "boardcount_check.php",
                              type: "post",
                              data: udata,
                            }).done(function(data) {

                             location.href="./fictionhome.html?fictionid=<?php echo $myfictionlist["idfictiondata"]?>&chapter=<?php echo $board['chapter_number']; ?>"

                            });
                        }
                  </script>
                  <?php
                  if(empty($read)==false){
                    if($board['chapter_number']<=$read['readchapternumber']){ ?>
                     <script type="text/javascript">
                       $('.title_<?php echo $board['idchapterdata']; ?>').css("color","#bdbebd");
                     </script>
                   <?php }
                  }
                  ?>
               <?php }elseif($board["chapter_category"]=="유료"){
                 if(in_array($board['idchapterdata'],$buy_chapterlist)){?>
                   <td width="460"><a style="cursor:pointer;" class="title_<?php echo $board['idchapterdata']; ?>" onclick="readcount_<?php echo $board['chapter_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>();"><pre style="float:left;">[구매완료]</pre><img src="./siteimage/newimage.png" alt=""> <?php echo $title;?> +<?php echo $board['chapter_commentcount']; ?></a></td>

                 <?php }else{?>
                 <td width="460"><a style="cursor:pointer;"  class="title_<?php echo $board['idchapterdata']; ?>" onclick="readcount_<?php echo $board['chapter_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>();"><pre style="float:left;">[100원]</pre><img src="./siteimage/newimage.png" alt=""> <?php echo $title;?> +<?php echo $board['chapter_commentcount']; ?></a></td>
                 <?php }?>
                 <script type="text/javascript">
                 function readcount_<?php echo $board['chapter_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>(){
                         var boardname = "fiction";
                         var chapterdata_re ="<?php echo $board['chapter_number']; ?>";
                         var fictiondata_re ="<?php echo $myfictionlist["idfictiondata"]; ?>";
                         var dfuserid = "<?php echo $dfuserid; ?>";
                         var idchapterdata="<?php echo $board['idchapterdata']; ?>"
                         var udata={"boardname":boardname , "chapterdata_re":chapterdata_re , "fictiondata_re":fictiondata_re, "dfuserid":dfuserid, "idchapterdata":idchapterdata };
                         $.ajax({
                           url: "buylist_check.php",
                           type: "post",
                           data: udata,
                         }).done(function(data) {
                          if(data=="no"){
                            alert("먼저 작품을 구매해야 합니다.");
                          }else{
                           location.href="./fictionhome.html?fictionid=<?php echo $myfictionlist["idfictiondata"]?>&chapter=<?php echo $board['chapter_number']; ?>"
                          }
                         });
                     }
                 </script>
                 <?php
                 if(empty($read)==false){
                   if($board['chapter_number']<=$read['readchapternumber']){ ?>
                    <script type="text/javascript">
                      $('.title_<?php echo $board['idchapterdata']; ?>').css("color","#bdbebd");
                    </script>
                  <?php }
                 }
                 ?>
               <?php } ?>
              <td width="100"><?php echo $date[1] ?></td>

              <?php }else{?>
                <?php if($board["chapter_category"]=="무료") {?>
                  <td width="460"><a style="cursor:pointer;" class="title_<?php echo $board['idchapterdata']; ?>" onclick="readcount_<?php echo $board['chapter_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>();"><pre style="float:left;">[Free]</pre> <?php echo $title;?> +<?php echo $board['chapter_commentcount']; ?></a></td>
                  <script type="text/javascript">
                     function readcount_<?php echo $board['chapter_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>(){
                             var boardname = "fiction";
                             var chapterdata_re ="<?php echo $board['chapter_number']; ?>";
                             var fictiondata_re ="<?php echo $myfictionlist["idfictiondata"]; ?>";
                             var udata={"boardname":boardname , "chapterdata_re":chapterdata_re , "fictiondata_re":fictiondata_re };
                             $.ajax({
                               url: "boardcount_check.php",
                               type: "post",
                               data: udata,
                             }).done(function(data) {

                              location.href="./fictionhome.html?fictionid=<?php echo $myfictionlist["idfictiondata"]?>&chapter=<?php echo $board['chapter_number']; ?>"

                             });
                         }
                   </script>
                   <?php
                   if(empty($read)==false){
                     if($board['chapter_number']<=$read['readchapternumber']){ ?>
                      <script type="text/javascript">
                        $('.title_<?php echo $board['idchapterdata']; ?>').css("color","#bdbebd");
                      </script>
                    <?php }
                   }
                   ?>
                <?php }elseif($board["chapter_category"]=="유료"){
                  if(in_array($board['idchapterdata'],$buy_chapterlist)){?>
                    <td width="460"><a style="cursor:pointer;" class="title_<?php echo $board['idchapterdata']; ?>" onclick="readcount_<?php echo $board['chapter_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>();"><pre style="float:left;">[구매완료]</pre> <?php echo $title;?> +<?php echo $board['chapter_commentcount']; ?></a></td>

                  <?php }else{?>

                  <td width="460"><a style="cursor:pointer;" class="title_<?php echo $board['idchapterdata']; ?>" onclick="readcount_<?php echo $board['chapter_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>();"><pre style="float:left;">[100원]</pre> <?php echo $title;?> +<?php echo $board['chapter_commentcount']; ?></a></td>
                <?php }?>
                  <script type="text/javascript">
                  function readcount_<?php echo $board['chapter_number']; ?>_<?php echo $myfictionlist["idfictiondata"]; ?>(){
                          var boardname = "fiction";
                          var chapterdata_re ="<?php echo $board['chapter_number']; ?>";
                          var fictiondata_re ="<?php echo $myfictionlist["idfictiondata"]; ?>";
                          var dfuserid = "<?php echo $dfuserid; ?>";
                          var idchapterdata="<?php echo $board['idchapterdata']; ?>"
                          var udata={"boardname":boardname , "chapterdata_re":chapterdata_re , "fictiondata_re":fictiondata_re, "dfuserid":dfuserid, "idchapterdata":idchapterdata };
                          $.ajax({
                            url: "buylist_check.php",
                            type: "post",
                            data: udata,
                          }).done(function(data) {
                           if(data=="no"){
                             alert("먼저 작품을 구매해야 합니다.");
                           }else{
                            location.href="./fictionhome.html?fictionid=<?php echo $myfictionlist["idfictiondata"]?>&chapter=<?php echo $board['chapter_number']; ?>"
                           }
                          });
                      }
                  </script>
                  <?php
                  if(empty($read)==false){
                    if($board['chapter_number']<=$read['readchapternumber']){ ?>
                     <script type="text/javascript">
                       $('.title_<?php echo $board['idchapterdata']; ?>').css("color","#bdbebd");
                     </script>
                   <?php }
                  }
                  ?>
                <?php } ?>
              <td width="100"><?php echo $date[0] ?></td>
              <?php } ?>


              <td width="100"><?php echo $board['chapter_count']; ?></td>
            </tr>
          </tbody>

          <?php } ?>
        </table>
        <div class="" id="page">
         <!-- 처음 버튼 -->
          <?php
             if($page<=1){
          ?>
               <span>처음</span>
          <?php
             }else{
          ?>
               <a href="./fictionhome.html?fictionid=<?php echo $dffictionid; ?>&page=1">처음</a>

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
               <a href="./fictionhome.html?fictionid=<?php echo $dffictionid; ?>&page=<?php echo $prev_block; ?>">이전</a>

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
                 <a href="./fictionhome.html?fictionid=<?php echo $dffictionid; ?>&page=<?php echo $i; ?>">[<?php echo $i; ?>]</a>
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
             <a href="./fictionhome.html?fictionid=<?php echo $dffictionid; ?>&page=<?php echo $next_block; ?>">다음</a>
           <?php } ?>
          <!-- 마지막 버튼 -->
          <?php if($page>=$total_page){ ?>
            <span>마지막</span>
         <?php }else{ ?>
            <a href="./fictionhome.html?fictionid=<?php echo $dffictionid; ?>&page=<?php echo $total_page; ?>">마지막</a>
         <?php } ?>
        </div>

      </div>
      <?php
    }
      ?>
      </div>
  <!-- 게시판 끝 -->
