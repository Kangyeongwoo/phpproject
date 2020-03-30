
<?php
session_start();
$_SESSION['userid'];
$uid=$_SESSION['userid'];
$_SESSION['usernickname'];
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

$q= "SELECT * FROM userprofill WHERE id='$uid'";
$result = $mysqli->query($q);
$board = $result->fetch_array(MYSQLI_ASSOC);

$test=$board['nickname'];
 ?>
 <script src="//code.jquery.com/jquery.min.js"></script>



<div class="userprofill_container">
  <form class="" name="modifyfrm" action="profillmodify.php" method="post" style="display:inline-block;">
  <input type="hidden" name="uid" value="<?php echo $board['id']; ?>">

  <input type="hidden" name="originalnickname" value="<?php echo $board['nickname']; ?>">
  <div class="userprofill">

    <div class="userprofill_cache">
      <p style="float:right;">내 캐시</p>
    </div >
    <div class="userprofill_cachetext">
      <p style="float:left;"><?php echo $board['coin']; ?> 원</p>
    </div >
    <div class="userprofill_id">
        <p style="float:right;">아이디</p>
    </div >
    <div class="userprofill_idtext">
      <p style="float:left;"><?php echo $board['id']; ?></p>
    </div>
    <div class="userprofill_pw">
        <p style="float:right;">변경할 비밀번호</p>
    </div>
    <div class="userprofill_pwtext">
       <input type="password" name="pw1" id="pw1" placeholder="비밀번호 입력"  style="float:left;">
       <input type="password"  name="pw2" id="pw2" placeholder="한번더 입력해주세요"  style="float:left;margin-left:5px;">
    </div>
    <div class="userprofill_nickname">
         <p style="float:right;">닉네임</p>
    </div>
    <div class="userprofill_nicknametext">
       <input type="text" name="nickname" id="nickname" value="<?php echo $board['nickname']; ?>" style="float:left;">
       <input type="button" style="float:left;margin-left:5px;" name="" value="중복확인" onclick="check_nickname();">
       <script type="text/javascript">
       var nickname_check=0;

       function check_nickname(){
               var nickname =$('input#nickname').val();
               var udata={"usernickname":nickname};
               $.ajax({
                 url: "nicknamecheck.php",
                 type: "post",
                 data: udata,
               }).done(function(data) {

                   if(data==1){
                     nickname_check=1;
                     alert("사용 가능한 닉네임입니다.");

                   }else{
                     nickname_check=0;
                     alert("중복된 닉네임입니다.");


                   }

               });
           }
       </script>


    </div>

    <div class="userprofill_button">


         <input type="button" name="" value="확인" onclick="modify_check();">
         <script type="text/javascript">

           function modify_check(){

             var pw1 = $('input#pw1').val();
             var pw2 = $('input#pw2').val();
             var nick_or = $('input#nickname').val();

            var nick_or_check = '<?php echo $test; ?>';
            if(nick_or==nick_or_check){
              nickname_check=1;
            }else{

            }

             if(nickname_check==1&&pw1==pw2){
                 document.modifyfrm.submit();
             }else{
               alert("중복체크와 비밀번호를 확인해 주십시오");
             }
           }
         </script>
         <input type="button" name="" value="취소" onclick="location.href='userpage.html?usercategoryid=1'">


    </div>
  </div>
   </form>

</div>
