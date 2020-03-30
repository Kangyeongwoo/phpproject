<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <script src="//code.jquery.com/jquery.min.js"></script>
    <div class="">
      <p>특급신작</p>
      <img src="./siteimage/eventimage.png" style="max-height:300px;" alt="">
      <p>남궁세가 막내공자 | 영우</p>
    </div>
    <div class=""  style="background-color:#D8D8D8;padding-top:20px;padding-bottom:20px;">
      <input type="checkbox" style="margin-left:20px;" id="popupcheckbox" name="" value="" > <i>하루동안 보지않기</i><i onclick="popupclose();" style="float:right;margin-right:20px;cursor:pointer">닫기</i>
    </div>
    <script type="text/javascript">

    var date = new Date();
    date.setTime(date.getTime() + 1*60*60*24*1000);
    var expires = date.toUTCString();

      $('#popupcheckbox').change(function(){
         var checked = $('#popupcheckbox').prop('checked');
         if(checked){
          document.cookie="popup=ok;expires="+expires+";path=/";
          self.close();
         }else{
         self.close();
         }
      });
    </script>
    <script type="text/javascript">
      function popupclose(){
         self.close();
      }
    </script>

  </body>
</html>
