<?php
    require 'core.php';
    
    $studentLogInName="";
    echo $studentLogInName=isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";

    if(!$studentLogInName){
        header('Location: student_login.php');
    }
    $booked_id=$_GET['booked_id'];

    // echo $booked_id."<br>";
    //include('../includes/header.php'); 

    include('connection.php');   
    
    $appointment_id="";
    $querySlt_id="SELECT appointment_id FROM booked_appointments WHERE student_username='$studentLogInName' ";
    $resultSlt_id=mysqli_query($conn, $querySlt_id)or die("Error Querying". mysqli_error($conn));
	echo mysqli_num_rows($resultSlt_id)."\n";
    if(mysqli_num_rows($resultSlt_id)>0){
        while($rowSlt_id=mysqli_fetch_assoc($resultSlt_id)){
            $appointment_id=$rowSlt_id['appointment_id'];
            // echo $appointment_id."<br>";
        }
		echo $appointment_id;
    }
    // if(!empty($appointment_id))
    // echo $appointment_id."<br>";
    $current_no="";
    $querySlt_max_no="SELECT current_no FROM appointments WHERE id='$appointment_id'";
    $resultSlt_max_no=mysqli_query($conn, $querySlt_max_no)or die("Error Querying". mysqli_error($conn));
    if(mysqli_num_rows($resultSlt_max_no)>0){
        while($rowSlt_max_no=mysqli_fetch_assoc($resultSlt_max_no)){
            $current_no=$rowSlt_max_no['current_no'];
        }
    }
    echo $current_no."<br>";
    $current_no--;
    echo $current_no;
    $queryUpd_max_no="UPDATE appointments SET current_no='$current_no' WHERE id='$appointment_id' ";
    $resultUpd_max_no=mysqli_query($conn, $queryUpd_max_no)or die("Error Querying". mysqli_error($conn));

    $queryDel="DELETE FROM booked_appointments WHERE id='$booked_id' ";
    $resultDel=mysqli_query($conn, $queryDel)or die("Error Deleting". mysqli_error($conn));
    if($resultDel){
        $msg="<div class='alert alert-success'>Appointment Deleted Successfully..</div>" ;
    }
    else{
        $msg="<div class='alert alert-danger'>Appointment Not Deleted ..</div>" ;
    }
    
    
   header("Location: landing_page.html.php?msg='$msg'");
    mysqli_close($conn);

   //include('../includes/footer.php');
?>



