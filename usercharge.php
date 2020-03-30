<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      .charge_container{
        margin-top: 10px;
        margin-bottom:10px;
        width: 800px;
        background-color:white;
        display: inline-block;
      }
      .charge_zone{
        display: grid;
        width: 800px;
        grid-template-columns: 1fr 1fr 1fr;
        grid-template-rows: 50px 50px auto auto 50px 50px;
      }
      .charge_title{
        grid-column: 1/4;
        grid-row: 1/2;

      }
        .charge_subtitle{
          grid-column: 1/4;
          grid-row: 2/3;
        }
        .charge_productselect{
          grid-column: 1/4;
          grid-row: 3/4;
        }
        .charge_productselect2{
          grid-column: 1/4;
          grid-row: 4/5;
        }
        .charge_subtitle2{
          grid-column: 1/4;
          grid-row:5/6;
        }
        .charge_paymethod{
          grid-column: 1/4;
          grid-row: 6/7;
        }
        .radio{

         margin-left: 10px;
         margin-right: 5px;
        }
        .button{
          width:180px;
          height: 70px;
          font-size: 30px;
          margin-right: 40px;
          margin-bottom: 40px;
        }

    </style>
  </head>
  <body>
    <script src="//code.jquery.com/jquery.min.js"></script>

    <section>
     <div class="charge_container">
       <form class="" action="charging_check.php" method="post">

       <div class="charge_zone">

         <div class="charge_title">
          <h4 id="titleid" style="margin-top:10px;" >결제하기</h4>
         </div>
         <div class="charge_subtitle">
           <p class="btn btn-outline-dark">결제 상품 선택</p>
         </div>
         <div class="charge_productselect">
          <input type="radio" class="radio" id="charge1" name="charge" value="1000" checked /><button type="button" class="button" name="button"onclick="radiocheck1();">1,000원</button>
          <script type="text/javascript">
            function radiocheck1(){
              $('#charge1').prop("checked",true);
            }
          </script>
          <input type="radio" class="radio" id="charge2" name="charge" value="5000" /><button type="button" class="button" name="button"onclick="radiocheck2();">5,000원</button>
          <script type="text/javascript">
            function radiocheck2(){
              $('#charge2').prop("checked",true);
            }
          </script>
          <input type="radio" class="radio" id="charge3" name="charge" value="10000" /><button type="button" class="button" name="button"onclick="radiocheck3();">10,000원</button>
          <script type="text/javascript">
            function radiocheck3(){
              $('#charge3').prop("checked",true);
            }
          </script>
         </div>
         <div class="charge_productselect2">
          <input type="radio" class="radio" id="charge4" name="charge" value="30000" /><button type="button" class="button" name="button"onclick="radiocheck4();">30,000원</button>
          <script type="text/javascript">
            function radiocheck4(){
              $('#charge4').prop("checked",true);
            }
          </script>
          <input type="radio" class="radio" id="charge5" name="charge" value="50000" /><button type="button" class="button" name="button"onclick="radiocheck5();">50,000원</button>
          <script type="text/javascript">
            function radiocheck5(){
              $('#charge5').prop("checked",true);
            }
          </script>
          <input type="radio" class="radio" id="charge6" name="charge" value="100000" /><button type="button" class="button" name="button"onclick="radiocheck6();">100,000원</button>
          <script type="text/javascript">
            function radiocheck6(){
              $('#charge6').prop("checked",true);
            }
          </script>
         </div>

         <div class="charge_subtitle2">
            <p class="btn btn-outline-dark">결제 수단 선택</p>
         </div>

         <div class="charge_paymethod">
          <input type="radio" name="pay" value="kakaopay" checked>카카오페이
         </div>

       </div>
       <input type="submit" class="btn btn-primary" name="" style="margin-bottom:10px;" value="결제하기">

     </form>
     </div>


    </section>
  </body>
</html>
