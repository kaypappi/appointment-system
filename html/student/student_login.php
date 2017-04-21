<?php
    include('../includes/header.php');
    $msg="";
    $msg=isset($_GET['msg']) ? $_GET['msg'] : $msg="";

    if(isset($_POST['login'])){

        include('../includes/connection.php');

        function validateFormData($form_data){
            $form_data= trim( stripslashes( htmlspecialchars( $form_data) ) );
            return $form_data;
        }

        if(isset($_POST['username']) && !empty($_POST['username'])){
            $username=validateFormData($_POST['username']);
            $field=true;
        }          
        if(isset($_POST['password']) && !empty($_POST['password'])){
            $password=validateFormData($_POST['password']);
            $field=true;
        }        
        if($field==true){
            $field=false;
            $query="SELECT password from student WHERE username='$username'";

            $result=mysqli_query($conn,$query) or die("Error Querying". mysqli_error($conn));
            
            if(mysqli_num_rows($result) > 0){

                while($row=mysqli_fetch_assoc($result)){
                    $hashedPass=$row['password'];
                }
                if( password_verify( $password, $hashedPass)){

                    session_start();
                    $_SESSION['studentLogInName']=$username;                
                    $_SESSION['superLogInName']="";
                    header("Location: student_dashboard.php");
                }
                else{   
                    $error_msg="<div class='alert alert-danger'>Wrong username/password</div>";
                }
            }
            else{   
            $error_msg="<div class='alert alert-danger'>Username ain\'t exists..<a class='close' data-dismiss='alert'>&times;</a></div>" ;
            }
        
            mysqli_close($conn);
        }
        else{
            $error_msg="<div class='alert alert-danger'>Pls enter the required fields</div>";
         
        }
           
        
        
    }
    if(isset($_POST['create'])){
        include('../includes/connection.php');

        function validateFormData($form_data){
            $form_data= trim( stripslashes( htmlspecialchars( $form_data) ) );
            return $form_data;
        }

        if(isset($_POST['newUsername']) && !empty($_POST['newUsername'])){
            $newUsername=validateFormData($_POST['newUsername']);
            $field=true;
        }                
         if(isset($_POST['newPassword1']) && !empty($_POST['newPassword1'])){
            $newPassword1=validateFormData($_POST['newPassword1']);
            $newPassword1=password_hash($newPassword1,PASSWORD_DEFAULT);
            $field=true;
        }
        if(isset($_POST['fullname'])  && !empty($_POST['fullname'])){
            $fullname=validateFormData($_POST['fullname']);
            $field=true;
        }                
        if(isset($_POST['newPassword2']) && !empty($_POST['newPassword2'])){
            $newPassword2=validateFormData($_POST['newPassword2']);
            $newPassword2=password_hash($newPassword2,PASSWORD_DEFAULT);
            $field=true;
        }
        if($newPassword1==$newPassword2){
            $field=false;
            $error_msg="<div class='alert alert-danger'>Your Passwords don't match</div>";
        }
        
        if($field){
            $field=false;
            $exist="";
            $querySlt="SELECT * FROM student";
            $resultSlt=mysqli_query($conn, $querySlt) or die("Error Selecting". mysqli_error($conn));
            if(mysqli_num_rows($resultSlt)>0){
                while($rowSlt=mysqli_fetch_assoc($resultSlt)){
                    if($newUsername==$rowSlt['username'] || $newPassword1==$rowSlt['password']){
                        $exist="1";
                    }
                }
            }
            if(!$exist==="1"){

                $exist="0";
                $query="INSERT INTO student(id, username, password, fullname) VALUES (null, '$newUsername', '$newPassword1', '$fullname')";
                $result=mysqli_query($conn,$query) or die("Error Inserting". mysqli_error($conn));

                if($result){
                    $msg= "Account created successfuly"; //passed with get
                    header("Location: student_login.php?msg=$msg");
                    $msg="";
                }
                mysqli_close($conn);
            }
            else{
                $error_msg="<div class='alert alert-danger'>This username and or password already exists <br> Pls enter another one </div>";
            }
        }
        else{
            $error_msg="<div class='alert alert-danger'>Pls enter the required fields</div>";
        
        }
    }
    

?>

    <div class="container">
        <div class="page-header">
            <h3>Student Login</h3>
        </div>

        <div class="row">

            <div class="col-sm-6 col-sm-offset-3">                
                <?php if(!empty($error_msg)){  echo $error_msg;   } ?>
                <?php if(!empty($msg)){  echo "<div class='alert alert-success'>Account created succesfully<br>Please login below<a class='close' data-dismiss='alert'>&times;</a></div>" ; $msg="" ;  } ?>
                <form method="post" action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>">
                    <div class="form-group">
                        
                        <div class="input-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control" value="student" required>
                            <!--<div class="input-group-addon">@unilag.edu.ng</div>-->
                        </div>
                        <p>Hint: username is your Matric No.</p>
                        <br>
                        <div class="input-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <br>
                        <button type="submit" id="login" name="login" class="btn btn-primary">Login</button>
                    </div>
                </form>
                <p >Not a member?</p>
            </div><!--        md 12-->
            <br class="lead">
        </div><!--        row-->

        <div class="page-header">
            <h3>Sign Up </h3>
        </div>
         <div class="row">

            <div class="col-sm-6 col-sm-offset-3">                
                
                <form method="post" action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>">
                    <div class="form-group">
                        
                        <div class="input-group">
                            <label for="username">Enter Username</label>
                            <input type="text" id="newUsername" name="newUsername" class="form-control" required>
                            <!--<div class="input-group-addon">@unilag.edu.ng</div>-->
                        </div>
                        <p>Username is your Matric No.</p>
                        <br>
                        <div class="input-group">
                            <label for="password1">Enter a Password</label>
                            <input type="password" id="newPassword1" name="newPassword1" class="form-control" required>
                        </div>
                        <br>
                        <div class="input-group">
                            <label for="password2">Confirm  Password</label>
                            <input type="password" id="newPassword2" name="newPassword2" class="form-control" required>
                        </div>
                        <br>
                        <div class="input-group">
                            <label for="password">Enter full Name</label>
                            <input type="text" id="fullname" name="fullname" class="form-control" required>
                        </div>
                        <br>
                        <div class="input-group">
                            <label for="password">Upload your Profile Picture</label>
                            <input type="file" id="image" name="image" class="form-control">
                        </div>
                        <br>
                        <button type="submit" id="create" name="create" class="btn btn-danger">Create Account</button>
                    </div>
                </form>
                <?php if(!empty($msg))  echo $msg; ?>
            </div><!--        md 12-->

        </div><!

    </div>  <!--        container-->
        
<!--        container-->

<?php   include('../includes/footer.php');?>