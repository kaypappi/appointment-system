<?php
    include('../includes/header.php');

if(isset($_POST['submit'])){
        include('../includes/connection.php');

        function validateFormData($form_data){
            $form_data= trim( stripslashes( htmlspecialchars( $form_data) ) );
            return $form_data;
        }

        if(isset($_POST['username'])){
            $username=validateFormData($_POST['username']);
        }                
         if(isset($_POST['password'])){
            $password=validateFormData($_POST['password']);
        }
    
        $query="SELECT password from supervisor WHERE username='$username'";

        $result=mysqli_query($conn,$query) or die("Error Querying". mysqli_error($conn));
        
        if(mysqli_num_rows($result) > 0){

            while($row=mysqli_fetch_assoc($result)){
                $hashedPass=$row['password'];
            }
            if( password_verify( $password, $hashedPass)){

                session_start();
                $_SESSION['superLogInName']=$username;                
                $_SESSION['studentLogInName']="";                

                header("Location: ../supervisor/supervisor_dashboard.php");
            }
            else{   
                $loginError="<div class='alert alert-danger'>Wrong username/password</div>";
                }
        }
        else{   
           $loginError="<div class='alert alert-danger'>Username ain\'t exists..<a class='close' data-dismiss='alert'>&times;</a></div>" ;
           }
           
        mysqli_close($conn);
    }

?>

    <div class="container">
        <div class="page-header">
            <h3>Supervisor Login</h3>
        </div>

        <div class="row">

            <div class="col-sm-6 col-sm-offset-3">
                <?php if(!empty($loginError)){  echo $loginError;   } ?>
                <form method="post" action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>">
                    <div class="form-group">

                        <label for="username">Username</label>
                        <div class="input-group">
                            <input type="text" id="username" name="username" value="azeezat" class="form-control">
                            <div class="input-group-addon">@unilag.edu.ng</div>
                        </div>
                        <p>Hint: username is your work e-mail address</p>
                        <br>

                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                        <br>
                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>

            </div><!--        md 12-->

        </div><!--        row-->

    </div>  <!--        container-->
        
<!--        container-->

<?php   include('../includes/footer.php');?>

