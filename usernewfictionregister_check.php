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

        if(empty($_FILES["fileToUpload"]["name"])){
            $fiction_imagepath = "./webfictionimage/fictiondefault.jpg";
            $q = "INSERT INTO fictiondata ( fiction_pricecategory,fiction_genre,fiction_title,fiction_author,fiction_date,
                                          fiction_description, fiction_imagepath ,fiction_descriptiondetail,  fiction_startpricechapter
                 ) VALUES ( '$fiction_pricecategory', '$fiction_genre', '$fiction_title','$fiction_author','$fiction_date','$fiction_description2','$fiction_imagepath','$fiction_description','$fiction_startpricechapter' )";

            $mysqli->query( $q);

            $mysqli->close();

            header('Location: ./userpage.html?usercategoryid=4&myfictioncategoryid=1');

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
              $q = "INSERT INTO fictiondata ( fiction_pricecategory,fiction_genre,fiction_title,fiction_author,fiction_date,
                                            fiction_description, fiction_imagepath ,fiction_descriptiondetail,  fiction_startpricechapter
                   ) VALUES ( '$fiction_pricecategory', '$fiction_genre', '$fiction_title','$fiction_author','$fiction_date','$fiction_description2','$fiction_imagepath','$fiction_description','$fiction_startpricechapter' )";

              $mysqli->query( $q);

              $mysqli->close();

              header('Location: ./userpage.html?usercategoryid=4&myfictioncategoryid=1');

              exit();

            } else {

            }
        }

        }

}
?>
