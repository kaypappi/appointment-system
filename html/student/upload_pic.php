<?php
    require 'core.php';
    $studentLogInName="";
    $studentLogInName=isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";

     if(!$studentLogInName){
        header('Location: student_login.php');
    }
    
    include('connection.php');
    // echo "<br><br><br><br><br><br><br>";
    $target_dir="../../img/";
    if(!empty($_FILES['image']['name'])){
        $target_file=$target_dir.basename($_FILES['image']['name']);
        $uploadOk=1;
        // echo "YES IMAGE";
        $imageFileType=pathinfo($target_file, PATHINFO_EXTENSION);
    } 


    if(isset($_POST['submit'])){
        $tt= $target_file.$_FILES['image']['name'];
        $check=getimagesize($_FILES["image"]["tmp_name"]);
//         echo $_FILES["filetoupload"]["tmp_name"];
        if($check!==false){
            echo "File is an image - ". $check['mime']. ".";
            $uploadOk=1;
        }
        else{
            echo "File not image";
            $uploadOk=0;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
			echo $target_file=str_replace($_FILES['image']['name'],'a'.$_FILES['image']['name'],$target_file);
            
            
        }
        // Check file size
        if ($_FILES["image"]["size"] > 2000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
        && $imageFileType != "GIF" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        }
        else 
        {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
            {
                
                $name= $_FILES["image"]["name"];
                $query="UPDATE users SET image='$target_file' WHERE id='$studentLogInName' ";
                $result=mysqli_query($conn,$query) or die("Error Updating name". mysqli_error($conn));
                header('Location: student_profile.html.php');
            }
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    

?>

<!--<div class="container" style="margin-top:70px;">        
    <div class="row">
        <div class="col-md-8">
            <p class="lead">Profile Picture Upload</p>

            <form action='' method='POST' enctype="multipart/form-data" class='form'>
                <label for='image' class='label label-success'>Select an image to upload Image should be less than 2Mb</label>
                <input type='file' name='image' id='image'>
                <br><br><br>
                <button type='submit' name='submit' class='btn btn-primary' >Upload Picture</button>
            </form>
        </div>
    </div>
</div>-->


