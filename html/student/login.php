<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
 require 'connect.php';
 session_start();
 
	if(isset($_GET['matricno']) && isset($_GET['password'])){
		$matricno=$_GET['matricno'];
		$password=$_GET['password'];
		$password_hash=md5($password);
		if(!empty($matricno)&&!empty($password)){
			$query="SELECT `id` FROM `users` WHERE `matricno`='$matricno' AND `password`='$password_hash'";
			if($query_run=mysql_query($query)){
				$query_num_rows=mysql_num_rows($query_run);
				if($query_num_rows==0){
					echo'invalid matricno/password combination';	
				}
				else if($query_num_rows==1){
					$user_id=mysql_result($query_run,0,'id');
					$_SESSION['user_id']=$user_id;
					header('Location: landing_page.html.php');
				}
			}else{echo 'enter something 2';}
		}
		else{echo 'enter something 1';}
	}
?>
</body>
</html>