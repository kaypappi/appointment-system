<?php 

    session_start();
    $superLogInName="";
    $superLogInName=isset($_SESSION['superLogInName']) ? $_SESSION['superLogInName'] : "";

    if(!$superLogInName){
        header('Location: supervisor_login.php');
    }
    include('../includes/header.php'); 

    include('../includes/connection.php');
    
    $query="SELECT * FROM supervisor WHERE username='$superLogInName' ";

    $result=mysqli_query($conn,$query) or die("Error Querying". mysqli_error($conn));

    if(mysqli_num_rows($result) > 0){

        while($row=mysqli_fetch_assoc($result)){
            $oldusername=$row['username'];
            $oldpasswordHashed=$row['password'];

        }
    }
    function validateFormData($form_data){
            $form_data= trim( stripslashes( htmlspecialchars( $form_data) ) );
            return $form_data;
        }

    if(isset($_POST['update'])){
        if(isset($_POST['newUsername'])){
            $newUsername=validateFormData($_POST['newUsername']);
        }   
        if(isset($_POST['oldPassword'])){
            $oldPassword=validateFormData($_POST['oldPassword']);
        }   
        if(isset($_POST['newPassword1'])){
            $newPassword1=validateFormData($_POST['newPassword1']);
        }   
        if(isset($_POST['newPassword2'])){
            $newPassword2=validateFormData($_POST['newPassword2']);
        }
        //confirm old password
        if(password_verify($oldPassword, $oldpasswordHashed)){  

            if($newPassword1==$newPassword2){
                $newPassword1=password_hash($newPassword1, PASSWORD_DEFAULT);
                $_SESSION['superLogInName']=$newUsername;
                $queryUpdate="UPDATE supervisor SET username='$newUsername', password='$newPassword1' WHERE username='$superLogInName' ";

                $resultUpd=mysqli_query($conn, $queryUpdate) or die ("Error updating". mysqli_error($conn));

                mysqli_close($conn);
                $_SESSION['superLogInName']=$newUsername;

                $msg= "<div class='alert alert-sucess'>Profile Updated Successfully<a class='close' data-dismiss='alert'>&times;</a></div>" ;    
                header('Location:supervisor_dashboard.php');
            }
            else{
                $msg= "<div class='alert alert-danger'>First and Second Passwords don't match<a class='close' data-dismiss='alert'>&times;</a></div>" ;    
            }
        }
        else{
            $msg= "<div class='alert alert-danger'>Old and new Passwords dont match<a class='close' data-dismiss='alert'>&times;</a></div>" ;
        }

    }


?>

<div class="container">
        <div class="page-header">
            <h3>Edit Profile</h3>
        </div>

        <div class="row">

            <div class="col-sm-12">                
                <form method="post" action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>">
                    <div class="form-group">
                        
                        <div class="input-group">
                            <label for="newUsername">Username</label>
                            <input type="text" id="newUsername" name="newUsername" value="<?php echo $oldusername; ?>" class="form-control">
                            <div class="input-group-addon">@unilag.edu.ng</div>
                        </div>
                        <br>
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

    </div>

<?php   include('../includes/footer.php');?>