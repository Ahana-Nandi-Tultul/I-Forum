<?php
$showError="";

if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'dbconnect.php';
    $user_email=$_POST['signupEmail'];
    $pass=$_POST['signuppassword'];
    $cpass=$_POST['signupcpassword'];

    $existSql= "SELECT * FROM `users` WHERE `user_email`='$user_email'";
    $result= mysqli_query($conn, $existSql);
    $numRows= mysqli_num_rows($result);
    $boole=false;
    echo $numRows;
    if($numRows>0){
        $showError="Email is already use";
    }
    else{
        if($pass==$cpass){
            $hash= password_hash($pass, PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` ( `user_email`, `user_pass`, `TimeStmp`)
             VALUES ( '$user_email', '$hash', current_timestamp())";
            $result= mysqli_query($conn, $sql);
            if($result){
                $showAlert=true;
                $boole=true;
                header("Location: ../index.php?signupsuccess=$boole");
                exit();
            }
        }
        else{
       $showError="Password doesn't match.";
        }
    }
    header("Location:../index.php?signupsuccess=$boole&error=$showError");
}
?>