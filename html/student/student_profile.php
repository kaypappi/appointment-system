<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<!-- Latest compiled and minified JavaScript -->
<link href="../../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../../css/land.css" />
<link href="../../bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet" />
<link href="../../bootstrap-3.3.7-dist/css/bootstrap-theme.css" rel="stylesheet"  /> 

<title>Untitled Document</title>
</head>

<body>
<?php 
    require 'core.php';
    $studentLogInName="";
    $studentLogInName=isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";


    if(!$studentLogInName){
        header('Location: student_login.php');
    }
    
    

    include('connection.php');              
    
    $query="SELECT password FROM users WHERE id='$studentLogInName' ";

    $result=mysqli_query($conn,$query) or die("Error Querying". mysqli_error($conn));

    if(mysqli_num_rows($result) > 0){

        while($row=mysqli_fetch_assoc($result)){            
            $oldpasswordHashed=$row['password'];

        }
    }
    function validateFormData($form_data){
        $form_data= trim( stripslashes( htmlspecialchars( $form_data) ) );
        return $form_data;
    }

    if(isset($_POST['update'])){

        if(isset($_POST['oldPassword'])){
            $oldPassword=md5(validateFormData($_POST['oldPassword']));
        }
        if(isset($_POST['newPassword1'])){
            $newPassword1=validateFormData($_POST['newPassword1']);
        }   
        if(isset($_POST['newPassword2'])){
            $newPassword2=validateFormData($_POST['newPassword2']);
        }

        if($oldPassword==$oldpasswordHashed){  

            if($newPassword1==$newPassword2){
                $newPassword1=md5($newPassword1);
                $queryUpdate="UPDATE users SET password='$newPassword1' WHERE id='$studentLogInName' ";

                $resultUpd=mysqli_query($conn, $queryUpdate) or die ("Error updating". mysqli_error($conn));

                mysqli_close($conn);
                $msg= "<div class='alert alert-sucess'>Password Updated Successfully<a class='close' data-dismiss='alert'>&times;</a></div>" ;    
                header("Location: student_profile.html.php?msg=$msg");
            }
            else{
                $msg= "<div class='alert alert-danger'>First and Second Passwords don't match<a class='close' data-dismiss='alert'>&times;</a></div>" ;    
            }
        }
        else{
            $msg= "<div class='alert alert-danger'>Old Password dont match your former Password<a class='close' data-dismiss='alert'>&times;</a></div>" ;
        }
    }
?>

<!--<div class="container">
    <div class="page-header">
        <h3>Edit Password</h3>
    </div>

    <div class="row">

        <div class="col-sm-12">         
        <?php // if(!empty($msg)){  echo $msg;$msg="" ;  } ?>       
            <form method="post" action="<?php //echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>">
                <div class="form-group">
                    
                    <div class="input-group">
                        <label for="oldPassword">Enter old Password</label>
                        <input type="password" id="oldPassword" name="oldPassword" class="form-control">
                    </div>
                    <br>
                    <div class="input-group">
                        <label for="newPassword1">Enter new Password</label>
                        <input type="password" id="newPassword1" name="newPassword1" class="form-control">
                    </div><br>
                    <div class="input-group">
                        <label for="newPassword2">ConfirmPassword</label>
                        <input type="password" id="newPassword2" name="newPassword2" class="form-control">
                    </div>
                    <br>                        
                    <br>
                    <button type="submit" id="update" name="update" class="btn btn-danger">Update Profile</button>
                </div>
            </form>
        </div>
    </div>

    </div>-->

<script src="../../bootstrap-3.3.7-dist/js/jquery-3.1.1.min (1).js"></script> 
<script src="../../bootstrap-3.3.7-dist/js/bootstrap.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
<script type="text/javascript">
	$(document).ready(function() {
		$('#sidebar-btn').click(function(){
			$('#sidebar').toggleClass('visible');
		});
	});
</script>

</body>