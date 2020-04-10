<?php
    session_start();
    //add code here
    
    function writePic($dir){
        ///update database 
        $user = $_SESSION['username'];
        echo $user . " " . $dir;

        $servername = "localhost";
        $username = "test1";
        $password = "test1";
        $db = "UserData";
         
        $conn = mysqli_connect($servername, $username, $password, $db);
        $sql = "UPDATE User SET url='uploads/$dir' WHERE user='$user'";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            $_SESSION['img'] = $dir;
            echo $_SESSION['img'];
            header('Location: ../feed.php');
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    function uploadPic(){
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        
        // Check if file already exists
        if(file_exists($target_file)){
            echo "Sorry, file aleady exits";
            $uploadOk = 0;
        }


        // Check file size
        if($_FILES["fileToUpload"]["size"] > 5000000){
            echo "Sorry, file is too large";
            $uploadOk = 0;
        }


        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, file was not to uploaded";
            
        } else {
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
                writePic($target_file);
                // header('Location: ../feed.php');
            }else{
                echo "Sorry, there was an error uploading your file";
            }
            
        }
       


       
    }
    uploadPic();
?>