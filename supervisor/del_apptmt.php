<?php
    
    session_start();
    $superLogInName="";
    $superLogInName=isset($_SESSION['superLogInName']) ? $_SESSION['superLogInName'] : "";
    $appointment_id="";
    isset($_GET['app_id']) ? $appointment_id=$_GET['app_id']:'';

    if(!$superLogInName){
        header('Location: supervisor_login.php');
    }
    include('../includes/header.php'); 

    include('../includes/connection.php');   
    
   
    //  $appointment_id="";
    $querySlt_id="SELECT id FROM booked_appointments WHERE appointment_id='$appointment_id' ";
    $resultSlt_id=mysqli_query($conn, $querySlt_id)or die("Error Querying". mysqli_error($conn));
    if(mysqli_num_rows($resultSlt_id)>0){
        while($rowSlt_id=mysqli_fetch_assoc($resultSlt_id)){
            $booked_id=$rowSlt_id['id'];
            // echo $appointment_id."<br>";
        }
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

    $queryDelApmt="DELETE FROM appointments WHERE id='$appointment_id'";
    $resultDelApmt=mysqli_query($conn, $queryDelApmt)or die("Error Deleting". mysqli_error($conn));

    $queryDel="DELETE FROM booked_appointments WHERE appointment_id='$appointment_id' ";
    $resultDel=mysqli_query($conn, $queryDel)or die("Error Deleting". mysqli_error($conn));
    if($resultDel){
        $msg="<div class='alert alert-success'>Appointment Deleted Successfully..<a class='close' data-dismiss='alert'>&times;</a></div>" ;
    }
    else{
        $msg="<div class='alert alert-danger'>Appointment Not Deleted ..<a class='close' data-dismiss='alert'>&times;</a></div>" ;
    }
    
    
    header("Location: supervisor_dashboard.php?msg='$msg'");
    mysqli_close($conn);

    include('../includes/footer.php');
?>



