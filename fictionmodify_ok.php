<?php
include_once ('./dbconfig.php');
$mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}

session_start();
$fiction_author=$_SESSION['usernickname'];
$uid = $_SESSION['userid'];
extract($_POST);

if(empty($fiction_title)||empty($fiction_description2)||empty($fiction_description)){

 echo '<script>alert("입력값이 없습니다");document.location.href="./userpage.html?usercategoryid=4&myfictioncategoryid=1";</script>';

}else{


        $fiction_date = date('Y-m-d');

        $fiction_datetime = date("Y-m-d H:i:s");

        $fiction_startpricechapter_or;


        if(empty($_FILES["fileToUpload"]["name"])){

            if($fiction_pricecategory_or=="무료"&&$fiction_pricecategory=="유료"){

              if($fiction_startpricechapter<1){
                $fiction_startpricechapter=1;
              }

              $q2 = "UPDATE chapterdata SET chapter_category ='무료' WHERE chapter_number < '$fiction_startpricechapter' AND chapter_fictionid ='$idfictiondata'";
              $mysqli->query( $q2);
              $q3 = "UPDATE chapterdata SET chapter_category ='유료' WHERE chapter_number >= '$fiction_startpricechapter' AND chapter_fictionid ='$idfictiondata'";
              $mysqli->query( $q3);

            }elseif($fiction_pricecategory_or=="유료"&&$fiction_pricecategory=="유료"){

              if($fiction_startpricechapter == $fiction_startpricechapter_or){

              }else{
                if($fiction_startpricechapter<1){
                  $fiction_startpricechapter=1;
                }

                $q2 = "UPDATE chapterdata SET chapter_category ='무료' WHERE chapter_number < '$fiction_startpricechapter' AND chapter_fictionid ='$idfictiondata'";
                $mysqli->query( $q2);
                $q3 = "UPDATE chapterdata SET chapter_category ='유료' WHERE chapter_number >= '$fiction_startpricechapter' AND chapter_fictionid ='$idfictiondata'";
                $mysqli->query( $q3);
              }

            }elseif($fiction_pricecategory_or=="유료"&&$fiction_pricecategory=="무료"){
              $q2 = "UPDATE chapterdata SET chapter_category ='무료' WHERE chapter_fictionid = '$idfictiondata'";
              $mysqli->query( $q2);

            }

            if($default_check=="yes"){

              if($fiction_imagepath_or =="./webfictionimage/fictiondefault.jpg"){

              }else{
                unlink($fiction_imagepath_or);
              }

              $fiction_imagepath="./webfictionimage/fictiondefault.jpg";

              $q = "UPDATE fictiondata SET fiction_pricecategory='$fiction_pricecategory', fiction_genre='$fiction_genre', fiction_title='$fiction_title', fiction_description='$fiction_description2' ,fiction_descriptiondetail='$fiction_description',fiction_imagepath='$fiction_imagepath',  fiction_startpricechapter='$fiction_startpricechapter'

              WHERE idfictiondata='$idfictiondata'";

              $mysqli->query( $q);

            }else{

              

              $q = "UPDATE fictiondata SET fiction_pricecategory='$fiction_pricecategory', fiction_genre='$fiction_genre', fiction_title='$fiction_title', fiction_description='$fiction_description2' ,fiction_descriptiondetail='$fiction_description',  fiction_startpricechapter='$fiction_startpricechapter'

              WHERE idfictiondata='$idfictiondata'";

              $mysqli->query( $q);

            }


            $mysqli->close();
            ?>
            <script type="text/javascript">
              document.location.href="./userpage.html?usercategoryid=4&myfictioncategoryid=1";
            </script>
            <?php
        //    header('Location: ./userpage.html?usercategoryid=4&myfictioncategoryid=1');

            exit();

        }else{

        $target_dir = "./webfictionimage/";
        $target_file = $target_dir.$uid.$fiction_datetime.basename($_FILES["fileToUpload"]["name"] );
        $uploadOk = 1;

        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        /*
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;


            } else {
                $uploadOk = 0;
            }
        }
        */
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            $uploadOk = 0;
            ?>
            <script type="text/javascript">
              alert("이미지 사이즈가 너무 큽니다.");
              document.location.href="./userpage.html?usercategoryid=4&myfictioncategoryid=2";

            </script>
            <?php

        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        ?>
        <script type="text/javascript">
          alert("이미지를 입력해주십시오.");
          document.location.href="./userpage.html?usercategoryid=4&myfictioncategoryid=2";

        </script>
        <?php
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {

        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
              chown("$target_file","daemon");
              chmod("$target_file",0777);
              $fiction_imagepath = $target_file;

              if($fiction_pricecategory_or=="무료"&&$fiction_pricecategory=="유료"){

                if($fiction_startpricechapter<1){
                  $fiction_startpricechapter=1;
                }

                $q2 = "UPDATE chapterdata SET chapter_category ='무료' WHERE chapter_number < '$fiction_startpricechapter' AND chapter_fictionid ='$idfictiondata'";
                $mysqli->query( $q2);
                $q3 = "UPDATE chapterdata SET chapter_category ='유료' WHERE chapter_number >= '$fiction_startpricechapter' AND chapter_fictionid ='$idfictiondata'";
                $mysqli->query( $q3);


              }elseif($fiction_pricecategory_or=="유료"&&$fiction_pricecategory=="유료"){

                if($fiction_startpricechapter == $fiction_startpricechapter_or){

                }else{
                  if($fiction_startpricechapter<1){
                    $fiction_startpricechapter=1;
                  }

                  $q2 = "UPDATE chapterdata SET chapter_category ='무료' WHERE chapter_number < '$fiction_startpricechapter' AND chapter_fictionid ='$idfictiondata'";
                  $mysqli->query( $q2);
                  $q3 = "UPDATE chapterdata SET chapter_category ='유료' WHERE chapter_number >= '$fiction_startpricechapter' AND chapter_fictionid ='$idfictiondata'";
                  $mysqli->query( $q3);
                }





              }elseif($fiction_pricecategory_or=="유료"&&$fiction_pricecategory=="무료"){
                $q2 = "UPDATE chapterdata SET chapter_category ='무료' WHERE chapter_fictionid = '$idfictiondata'";
                $mysqli->query( $q2);


              }

              $q = "UPDATE fictiondata SET fiction_pricecategory= '$fiction_pricecategory', fiction_genre='$fiction_genre',fiction_title='$fiction_title',fiction_description='$fiction_description2',fiction_imagepath='$fiction_imagepath' ,fiction_descriptiondetail='$fiction_description',  fiction_startpricechapter='$fiction_startpricechapter'

                  WHERE idfictiondata='$idfictiondata'";

              $mysqli->query( $q);



              $mysqli->close();
              ?>
              <script type="text/javascript">
                document.location.href="./userpage.html?usercategoryid=4&myfictioncategoryid=1";
              </script>
              <?php
              exit();
            } else {

            }
        }

        }

}
?>
