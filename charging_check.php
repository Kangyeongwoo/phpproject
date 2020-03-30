<?php
session_start();
$_SESSION['userid'];
$_SESSION['usernickname'];
include_once ('./dbconfig.php');
$dfuserid=$_SESSION['userid'];
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);

if(empty($_SESSION['userid'])){
   echo '<script>alert("잘못된 접근입니다.");document.location.href="./main.html";</script>';
}
$charge = $_POST['charge'];
$pay=$_POST['pay'];
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
<script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
</head>
<body>

    <script>
    $(function(){
        var IMP = window.IMP; // 생략가능
        IMP.init("imp47062715"); // 'iamport' 대신 부여받은 "가맹점 식별코드"를 사용
        var msg;

        IMP.request_pay({
            pg : '<?php echo $pay; ?>',
            pay_method : 'card',
            merchant_uid : 'merchant_' + new Date().getTime(),
            name : 'BookChain 결제',
            amount : <?php echo $charge; ?>,
            buyer_email : '',
            buyer_name : '<?php echo $dfuserid; ?>',
            buyer_tel : '',
            buyer_addr : '',
            buyer_postcode : '',
            //m_redirect_url : 'http://www.naver.com'
        }, function(rsp) {
            if ( rsp.success ) {
                //[1] 서버단에서 결제정보 조회를 위해 jQuery ajax로 imp_uid 전달하기
                jQuery.ajax({
                    url: "/payments/complete", //cross-domain error가 발생하지 않도록 주의해주세요
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        imp_uid : rsp.imp_uid
                        //기타 필요한 데이터가 있으면 추가 전달
                    }
                }).done(function(data) {
                    //[2] 서버에서 REST API로 결제정보확인 및 서비스루틴이 정상적인 경우
                    if ( everythings_fine ) {
                        msg = '결제가 완료되었습니다.';
                        msg += '\n고유ID : ' + rsp.imp_uid;
                        msg += '\n상점 거래ID : ' + rsp.merchant_uid;
                        msg += '\n결제 금액 : ' + rsp.paid_amount;
                        msg += '카드 승인번호 : ' + rsp.apply_num;

                        alert(msg);
                    } else {
                        //[3] 아직 제대로 결제가 되지 않았습니다.
                        //[4] 결제된 금액이 요청한 금액과 달라 결제를 자동취소처리하였습니다.
                        alert("error");
                    }
                });
                //성공시 이동할 페이지
                <?php

                date_default_timezone_set('Asia/Seoul');
              	$chargedate = date("Y-m-d H:i:s");

                 $q ="UPDATE userprofill SET coin = coin +$charge WHERE id='$dfuserid'";
                 $mysqli->query($q);

                 $q2="INSERT INTO chargedata (charge_pay,charge_coin,charge_date,charge_userid) VALUES ('$pay','$charge','$chargedate','$dfuserid')";
                 $mysqli->query($q2);
                 ?>
                 alert("<?php echo $charge; ?>"+"원 결제가 완료되었습니다.");
                 document.location.href="main.html";
            } else {
                msg = '결제에 실패하였습니다.';
                msg += '에러내용 : ' + rsp.error_msg;
                //실패시 이동할 페이지

                alert(msg);
                document.location.href="userpage.html?usercategoryid=3";
            }
        });

    });
    </script>

</body>
</html>
