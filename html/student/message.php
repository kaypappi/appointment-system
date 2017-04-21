<?php 
require 'core.php';
    echo "<br><br><br>";
    
    $studentLogInName="";
    $studentLogInName=isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";

    $student_fullname="";
    $student_fullname=isset($_SESSION['fullname']) ? $_SESSION['fullname'] : "";


    if(!$studentLogInName){
        header('Location: student_login.php');
    }
    $msg="";
    $msg=isset($_GET['msg']) ? $_GET['msg'] : $msg="";
    include('header.php'); 

    include('connection.php');         

    function validateFormData($form_data){
            $form_data= trim( stripslashes( htmlspecialchars( $form_data) ) );
            return $form_data;
        }
    if(isset($_POST['send_msg'])){

        if(!empty($_POST['msg_txt'])){
            $msg_txt=validateFormData($_POST['msg_txt']);
            
            $query="INSERT INTO message_table(id,student_username, full_name , message, type_student,type_supervisor, _time) VALUES(null, '$studentLogInName', '$student_fullname', '$msg_txt','Outbox','Inbox',CURRENT_TIMESTAMP)";

            $result=mysqli_query($conn,$query) or die("Error Inserting ". mysqli_error($conn));
            $msg="Sent";
            header("Location:message.php?msg='$msg'");

        }
    }

?>
    
<div class="container">        
    <div class="row">
        <div class="col-md-8">

        <br><br>
        <?php if(!empty($msg)){  echo "<div class='alert alert-success'>Message sent successfully<a class='close' data-dismiss='alert'>&times;</a></div>" ; $msg="" ;  } ?>
        <br><br>
        <p class='lead'>INBOX</p>
        <br><br>
        <table class='table table-striped table-hover '>
            <tr><th>Message</th><th>Time Received</th></tr>

            <?php
                 $querySlt="SELECT * FROM message_table WHERE student_username='$studentLogInName' AND type_student='Inbox' ";

                $resultSlt=mysqli_query($conn,$querySlt) or die("Error Querying". mysqli_error($conn));

                if(mysqli_num_rows($resultSlt) > 0){

                    while($rowS=mysqli_fetch_assoc($resultSlt)){                        
                        echo "<tr><td>".$rowS['message']."</td><td>".date('h:m A', strtotime($rowS['_time']))."</td></tr>";
                    }
                    
                }
                else {
                    echo "<tr><td colspan='4'><div class='alert alert-success'>No Inbox </div></td></tr>";
                }
                
            ?>
        </table>
        <br><br><br>
        <p class='lead'>OUTBOX</p>
        <br><br>
        <table class='table table-striped table-hover '>
            <tr><th>Message</th><th>Time Sent</th></tr>

            <?php
                 $querySlt2="SELECT * FROM message_table WHERE student_username='$studentLogInName' AND type_student='Outbox' ";

                $resultSlt2=mysqli_query($conn,$querySlt2) or die("Error Querying". mysqli_error($conn));

                if(mysqli_num_rows($resultSlt2) > 0){

                    while($rowS2=mysqli_fetch_assoc($resultSlt2)){                        
                        echo "<tr><td>".$rowS2['message']."</td><td>".date('h:m A', strtotime($rowS2['_time']))."</td></tr>";
                    }
                    
                }
                else {
                    echo "<tr><td colspan='4'><div class='alert alert-success'>No Outbox </div></td></tr>";
                }
            ?>
        </table>

        <br><br><br><br>
        <p class="lead  ">Send Message</p>
        
        

        <form action="" method="post">
            <label for='msg_text'>Enter Message to be sent to Supervisor</label>
            <textarea id="msg_text" name="msg_txt" placeholder="Enter text here" cols="20" rows="7" class='form-control'></textarea><br>
            <button type='submit' name='send_msg'  class='btn btn-primary'>Send Message</button>
        </form>

        <br><br><br><hr>

        </div>
        <!--<div class="col-md-2 col-md-offset-1">
        
            <p style="margin-top: 50px" class="lead  p-lg">Dashboard</p>
            <br><hr>

            <a href="student_dashboard.php" class="btn btn-primary"> Appointments</a>
            <br><br>
            <a href="student_profile.php" class="btn btn-primary">Change Password</a>
            <br><br>
            <a href='upload_pic.php' class='btn btn-primary' >Upload/Change Profile Pic</a>
            <br><br>
            
            <!--<input type="file" name='profile_image' class='img-circle form-control' />-->
            <!--</form>-->
            <!--$image_name="";
            $image_name=isset($_SESSION['image_name']) ? $_SESSION['image_name'] : "";
            <a href='' ><img  src="../uploads/<?php echo $image_name; ?>" class="img-circle" alt="User Image" width="104" height="76" ></a> -->

            <br><br><hr>

            <p>Send a messge to your supervisor</p>
            <hr>
            <a href="message.php" class="btn btn-primary"><span class="glyphicon glyphicon-envelope"></span></a>
            <br>
            <!--<a href="#" class="btn btn-danger">Add Students</a>-->
            <br><hr><br>
            
        </div>-->
    </div>
</div>

    <?php   include('footer.php');?>