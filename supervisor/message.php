<?php 
    echo "<br><br><br>";
    session_start();
    $superLogInName="";
    $superLogInName=isset($_SESSION['superLogInName']) ? $_SESSION['superLogInName'] : "";

    if(!$superLogInName){
        header('Location: supervisor_login.php');
    }
    $msg="";
    $msg=isset($_GET['msg']) ? $_GET['msg'] : $msg="";
    include('../includes/header.php'); 

    include('../includes/connection.php');         

    function validateFormData($form_data){
            $form_data= trim( stripslashes( htmlspecialchars( $form_data) ) );
            return $form_data;
    }
    if(isset($_POST['send_msg'])){

        if(isset($_POST['student_name'])){
            list($value1,$value2) = explode('|', $_POST['student_name']);

            echo $username=validateFormData($value1);
            echo $student_name=validateFormData($value2);
        }
        if(!empty($_POST['msg_txt'])){
            echo $msg_txt=validateFormData($_POST['msg_txt']);
			
			
			echo $current=CURRENT_TIMESTAMP;
            $query="INSERT INTO message_table(id,student_username,full_name, message, type_student, type_supervisor, _time) VALUES(null, '$username', '$student_name', '$msg_txt','Inbox','Outbox',CURRENT_TIMESTAMP)";

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
        <table class='table table-striped table-hover '>
            <tr><th>Student Name</th><th>Student Id</th><th>Message</th><th>Time Sent/Received</th></tr>

            <?php
                 $querySlt="SELECT * FROM message_table WHERE type_supervisor='Inbox'";

                $resultSlt=mysqli_query($conn,$querySlt) or die("Error Querying". mysqli_error($conn));

                if(mysqli_num_rows($resultSlt) > 0){

                    while($rowS=mysqli_fetch_assoc($resultSlt)){                        
                        echo "<tr><td>".$rowS['full_name']."</td><td>".$rowS['student_username']."</td><td>".$rowS['message']."</td><td>".date('h:m A', strtotime($rowS['_time']))."</td></tr>";
                    }
                    
                }
                else {
                    echo "<tr><td colspan='4'><div class='alert alert-danger'>No Messages</div></td></tr>";
                }
            ?>
        </table>
        <br><br>
        <p class='lead'>OUTBOX</p>
        <table class='table table-striped table-hover '>
            <tr><th>Student Name</th><th>Student Id</th><th>Message</th><th>Type</th><th>Time Sent/Received</th></tr>

            <?php
                 $querySlt="SELECT * FROM message_table WHERE type_supervisor='Outbox'";

                $resultSlt=mysqli_query($conn,$querySlt) or die("Error Querying". mysqli_error($conn));

                if(mysqli_num_rows($resultSlt) > 0){

                    while($rowS=mysqli_fetch_assoc($resultSlt)){                        
                        echo "<tr><td>".$rowS['full_name']."</td><td>".$rowS['student_username']."</td><td>".$rowS['message']."</td><td>".$rowS['type_supervisor']."</td><td>".date('h:m A', strtotime($rowS['_time']))."</td></tr>";
                    }
                    
                }
                else {
                    echo "<tr><td colspan='4'><div class='alert alert-danger'>No Messages</div></td></tr>";
                }
            ?>
        </table>
        <br><br><br><br>
        <p class="lead  ">Send Message</p>
        
        

        <form action="" method="post">
            <label for='msg_text'>Enter Message to be sent to Student</label>
            <textarea id="msg_text" name="msg_txt" placeholder="Enter text here" cols="20" rows="7" class='form-control'></textarea><br>
            <br>
            
            <div class="form-group">
                <label for="student_name">Select a Student</label>
                <select name="student_name" id="student_name" class="form-control">
            <?php 

            $queryStu="SELECT * FROM users";
            $resultStu=mysqli_query($conn,$queryStu) or die("Error Selecting Students". mysqli_error($conn));

                if(mysqli_num_rows($resultStu) > 0){

                    while($rowStu=mysqli_fetch_assoc($resultStu)){  
                        $name1=$rowStu['firstname'];
						$name2=$rowStu['lastname'];
						$name3=$name1.' '.$name2;
                        $username=$rowStu['matricno'];
                        echo "<option value='$username|$name3'>$name3</option>";
                        // echo "<option hidden value='$name'></option>";
                    }
                    echo "</select>";
                }

            ?>
            
        </div>
            <button type='submit' name='send_msg'  class='btn btn-primary'>Send Message</button>
            <br><br>
        </form>

        <br><br><br><hr>

        

<?php   include('../includes/footer.php');?>