<?php
require 'core.php';
if(loggedin()){
		header('Location: landing_page.html.php');
		
		die();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../../css/index.css" />
<link href="../../bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet" />
<link href="../../bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet"  />
<title>Untitled Document</title>
</head>

<body>
<br />
<div class="container bot">
	<div class="panel panel-primary">
		<div class="panel-heading">Student login</div>
		<div class="panel-body">
			<form action="login.php" method="GET" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<label class="label label-default">Matric No/Email</label>
						<br />
						<br />
						<input type="text" class="form-control" name="matricno" id="Matric No/Email" placeholder="Matric No/Email" />
						<br />
					</div>
					<div class="col-md-6">
						<label class="label label-default">Password</label>
						<br />
						<br />
						<input type="password" class="form-control" name="password" id="Password" placeholder="Password" />
						<br />
					</div>
				</div>
				<div class="row">
					<div class="col-md-offset-4 col-md-4 ">
						<input type="submit" class="form-control btn btn-primary" id="submit" value="Submit" />
						<br />
					</div>
					<div class="col-md-8"> </div>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<h2>Not yet a member?<br />
				Register below</h2>
		</div>
		<div class="col-md-2"> </div>
		<div class="col-md-6"> </div>
	</div>
	<div class="panel panel-warning">
		<div class="panel-heading"> Student Registration </div>
		<div class="panel-body">
			<form action="register.php" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-6">
						<label class="label label-default">First Name</label>
						<br />
						<br />
						<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" />
						<br />
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6">
						<label class="label label-default">Last Name</label>
						<br />
						<br />
						<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" />
						<br />
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-6">
						<label class="label label-default">Matric No</label>
						<br />
						<br />
						<input type="text" class="form-control" id="Matric No" maxlength="30" name="matricno" placeholder="Matric No" />
						<br />
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6">
						<label class="label label-default">Department</label>
						<br />
						<br />
						<input type="text" class="form-control" id="Department" maxlength="40" name="department" placeholder="Department" />
						<br />
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-6">
						<label class="label label-default">Email</label>
						<br />
						<br />
						<input type="email" class="form-control" id="Email" maxlength="40" name="email" placeholder="Email" />
						<br />
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6">
						<label class="label label-default">upload image</label>
						<br />
						<br />
						<input type="file" class="form-control" id="image" name="image" />
						<br />
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-6">
						<label class="label label-default">Password</label>
						<br />
						<br />
						<input type="password" class="form-control" id="Password" name="password" placeholder="Password" />
						<br />
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6">
						<label class="label label-default">Confirm Password</label>
						<br />
						<br />
						<input type="password" class="form-control" id="Confirm Password" name="cpassword" placeholder="Confirm Password" />
						<br />
					</div>
				</div>
				<div class="row">
					<div class="col-md-offset-4 col-md-4 ">
						<input type="submit" class="form-control btn btn-warning" id="submit" value="Submit" />
						<br />
					</div>
					<div class="col-md-8"> </div>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="../../bootstrap-3.3.7-dist/js/bootstrap.js"></script> 
<script src="../../bootstrap-3.3.7-dist/js/jquery-3.1.1.min (1).js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
