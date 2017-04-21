<?php
	function postimage($image){
		$file=$image;
		$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["$file"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($target_file)) {
    $check = getimagesize($_FILES["$file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["$file"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
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
    if (move_uploaded_file($_FILES["$file"]["tmp_name"], $target_file)) {
        return $target_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
	}
	
	function getimage($d){
		$id=addslashes($_REQUEST['id']);
		$image=mysql_query("SELECT `image` FROM `users WHERE `id`='$id'");
		$image=mysql_fetch_assoc($image);
		
		return $image;
	}