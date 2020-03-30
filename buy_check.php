<?php
	include_once ('./dbconfig.php');
  $mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
	$buylist = $_POST["buylist"];
  $fictionid = $_POST["fictionid"];
  $buy_little = explode( ',', $buylist );
  $buy_count = count($buy_little);
  $buy_coin = $buy_count*100;
?>

<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
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
              height : 350px;
              margin-top:50px;
              padding-top: 50px;
              margin-left: 300px;
              background-color:#D8D8D8;
              text-align: center;
        }

   </style>

  </head>
  <body>

    <section class="container">
    		    <article class="half" style="background-color:#D8D8D8;">
    			        <h1 style="font-style:Italic;margin-bottom:20px;">결제</h1>
    			        <div class="content" >
    				            <div class="signin-cont" >

                          <h4>결제금액: <?php echo $buy_coin; ?> G</h4>

                           <form class="coin_check" action="./coin_check.php" method="post">
                            <input type="hidden" name="fictionid" value="<?php echo $fictionid; ?>">
                            <input type="hidden" name="buylist" value="<?php echo $buylist; ?>">

                            <input type="submit" name="" class="btn btn-outline-dark" value="결제">

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
