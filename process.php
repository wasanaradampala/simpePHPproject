<?php

$mysqli=new mysqli('localhost','root','','job_data') or die (mysql_error($mysqli));
$response=array();
session_start();
$id=0;

if(isset($_POST['save'])){

    $booked = $_POST['booked'];
    $accepted = $_POST['accepted'];
    $description = $_POST['description'];
    $pod = $_POST['pod'];
    $date = $_POST['date'];
    $container_no = $_POST['container_no'];
    $job_no = $_POST['job_no'];
    $remark = $_POST['remark'];
    $container_20 = $_POST['container_20'];
    $container_40 = $_POST['container_40'];
    $container_45HC = $_POST['container_45HC'];
    $container_2RF = $_POST['container_2RF'];
    $container_40RF = $_POST['container_40RF'];
   
    $mysqli -> query("INSERT INTO job (booked,accepted,description,pod,date,container_no,job_no,remark,container_20,container_40,container_45HC,container_2RF,container_40RF) VALUES ('$booked','$accepted','$description','$pod','$date','$container_no','$job_no','$remark','$container_20','$container_40','$container_45HC','$container_2RF','$container_40RF')") or die ($mysqli->error);
    
    $_SESSION['message']="Record Saved !!";
    $_SESSION['msg_type']="success";

    header('Location: index.php');
    exit();
}

if(isset($_POST['delete'])){


    $job_no = $_POST['job_no'];
  
   
    $mysqli -> query("DELETE FROM job WHERE job_no= $job_no") or die ($mysqli->error);

    $_SESSION['message']="Record Deleted !!";
    $_SESSION['msg_type']="danger";

    header('Location: index.php');
    exit();
}


if(isset($_POST['edit'])){


    $booked = $_POST['booked'];
    $accepted = $_POST['accepted'];
    $description = $_POST['description'];
    $pod = $_POST['pod'];
    $date = $_POST['date'];
    $container_no = $_POST['container_no'];
    $job_no = $_POST['job_no'];
    $remark = $_POST['remark'];
    $container_20 = $_POST['container_20'];
    $container_40 = $_POST['container_40'];
    $container_45HC = $_POST['container_45HC'];
    $container_2RF = $_POST['container_2RF'];
    $container_40RF = $_POST['container_40RF'];
  
   
    $mysqli -> query( "UPDATE job SET booked='$booked',accepted='$accepted',description='$description',pod='$pod',date='$date',container_no ='$container_no',job_no='$job_no',remark='$remark',container_20='$container_20',container_40='$container_40',container_45HC='$container_45HC',container_2RF='$container_2RF',container_40RF='$container_40RF' WHERE job_no=$job_no" ) or die ($mysqli->error);
    header('Location: index.php');
    exit();
}



if(isset($_POST['clear'])){
    header('Location: index.php');
    exit();
}

if(isset($_POST['job_no'])){


    $qry="SELECT * FROM job WHERE job_no='".$_POST["job_no"]."'  ";
   # $qry="select booked from job where job_no=87";
    $rec = mysqli_query($mysqli,$qry);
    if (mysqli_num_rows($rec) > 0) {
        while ($res = mysqli_fetch_array($rec)) {
           array_push($response,$res);
          
        }
        echo json_encode($response);
    }   

}
die(); 

?>