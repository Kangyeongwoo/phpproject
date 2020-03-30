<?php
  session_start();
	include_once ('./dbconfig.php');
  $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
  $wallet=$_POST['wallet'];
  $requestuserid=$_POST['requestuserid'];
  $countingstate=$_POST['countingstate'];
  $dfuserid=$_SESSION['userid'];
	if(empty($wallet)||empty($dfuserid)){
		echo '<script>alert("잘못된 접근입니다.");document.location.href="./main.html";</script>';
	}

	if(is_numeric($wallet)){

	}else{
		echo '<script>alert("금액은 숫자 형식만 가능합니다.");document.location.href="./userpage.html?usercategoryid=4&myfictioncategoryid=3";</script>';
	}

	if($wallet>=1000){

	}else{
		echo '<script>alert("정산금액은 1000원 이상 이어야합니다");document.location.href="./userpage.html?usercategoryid=4&myfictioncategoryid=3";</script>';
	}

?>

<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        *{
            text-align: center;

        }

        }
        section{
          background-color: white;

        }
        .half{

              display: block;
              width:500px;
              height : auto;
              margin-top:50px;
              padding-top: 50px;
              margin-left: 300px;
							margin-bottom: 10px;
              background-color:#D8D8D8;
              text-align: center;
        }

   </style>

  </head>
  <body>

    <section class="container">
    		    <article class="half" style="background-color:#D8D8D8;">
    			        <h1 style="font-style:Italic;margin-bottom:20px;">정산</h1>
    			        <div class="content" >
    				            <div class="signin-cont" >
                           <form class="counting_check" id ="counting_check" action="./counting_check.php" method="post">
                            <h4>정산금액: <?php echo $wallet; ?> 원</h4>
														<p>* 정산에 필요한 세부사항을 입력해주세요 <br> 입력한 정보를 토대로 정산금액이 입금됩니다</p>
                            <p style="padding-top:20px;">은행을 입력해주세요</p>
                              <input style="margin-bottom:20px;" type="text" name="bank" value=""  required>
                            <p style="padding-top:20px;">계좌번호을 입력해주세요</p>
                              <input style="margin-bottom:20px;" type="text" name="banknumber" onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' placeholder="숫자만 입력해주세요" value="" required>
                            <p style="padding-top:20px;">받는분 성함을 입력해주세요</p>
                              <input style="margin-bottom:20px;" type="text" name="username" value="" required>
                            <p style="padding-top:20px;">핸드폰번호를 입력해주세요</p>
                              <input  style="margin-bottom:20px;" type="text" name="userphone" value="" onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' placeholder="숫자만 입력해주세요" required>
														<p style="padding-top:20px;">이메일를 입력해주세요</p>
	                            <input  style="margin-bottom:20px;" type="email" name="useremail" value="" required>

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
														  <input type="hidden" name="wallet" value="<?php echo $wallet; ?>">
                              <input type="hidden" name="requestuserid" value="<?php echo $requestuserid; ?>">
                              <input type="hidden" name="countingstate" value="<?php echo $countingstate; ?>">
                            <input type="submit" name="" style="display:block;text-align:center;margin-left:42%;margin-bottom:10px;" class="btn btn-primary" value="정산 신청" >
														<script type="text/javascript">
															function countingrequestcheck(){
																var result_js3 = confirm("내용을 정확히 입력하셨습니까?");
																if(result_js3==true){
																	$('#counting_check').submit();
																}else if(result_js3==false){

																}
															}
														</script>
                           </form>
        				        </div>

    			        </div>
    		    </article>

    	</section>






    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">

    </script>
  </body>
</html>
