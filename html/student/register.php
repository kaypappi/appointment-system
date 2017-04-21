<?php
session_start();
require 'connect.php';
require 'image.html.php';
		


	if(isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['matricno'])&&isset($_POST['department'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['cpassword'])){
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];

		$matricno=$_POST['matricno'];
		$department=$_POST['department'];
		$email=$_POST['email'];
		
		$password=$_POST['password'];
		$cpassword=$_POST['cpassword'];
		
		
		if(!empty($firstname)&&!empty($lastname)&&!empty($matricno)&&!empty($department)&&!empty($email)&&!empty($password)&&!empty($cpassword)){
			if (preg_match('/[0-9]/', $firstname)&&preg_match('/[0-9]/', $lastname)){
				echo'firstname or lastname not valid';
			}
			else{
				if (preg_match('/[A-Za-z]/', $matricno)){
					echo'not a valid matric number';
				}
				else{
					$querySlt="SELECT * FROM users";
            $resultSlt=mysql_query($querySlt) or die("Error Selecting". mysql_error());
            if(mysql_num_rows($resultSlt)>0){
                while($rowSlt=mysql_fetch_assoc($resultSlt)){
                    if($matricno==$rowSlt['matricno']){
						$exit='1';
                        
                    } 
					
				 }
				
				if($exit<1){
					{
						if($password==$cpassword){
						$password_hash=md5($password);
						if(isset($_FILES['image'])){$target_dir = "../../img/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($target_file)) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists

// Check file size
if (file_exists($target_file)) {
			echo $target_file=str_replace($_FILES['image']['name'],'a'.$_FILES['image']['name'],$target_file);
            
            
        }
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
						if(mysql_query("INSERT INTO `users` values('','$matricno','$password_hash','$firstname','$lastname','$department','$email','$target_file')")){
							$query="SELECT `id` FROM `users` WHERE `matricno`='$matricno' AND `password`='$password_hash'";
							if($query_run=mysql_query($query)){
							$query_num_rows=mysql_num_rows($query_run);
							if($query_num_rows==1){
								$user_id=mysql_result($query_run,0,'id');
								$_SESSION['user_id']=$user_id;
								header('Location: landing_page.html.php');}
						
							}
						}
						}
					}else{echo 'password doesnt match';}
						
						}	
					
				}else{echo 'matric number has already being used';}
            }
					
					
						
					
					
					
					
					
					}
			}
					
		}
			
		else{echo 'all fields are required';
	}
	
	}
?>
