<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'dbconnect.php';
    $loginEmail=$_POST["loginEmail"];
    $loginPass=$_POST["loginPass"];

    $Spl="SELECT * FROM `users` WHERE user_email='$loginEmail'";
    $result=mysqli_query($conn, $Spl);
    $numRows= mysqli_num_rows($result);
    $boole=false;
    echo $numRows;
    if($numRows==1){
        $row=mysqli_fetch_assoc($result);
        if(password_verify($loginPass, $row['user_pass'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['sno']=$row['sno'];
            $_SESSION['useremail']=$loginEmail;
            echo "login ".$loginEmail;
            header('Location: ../index.php');
            }
        else{
            header('Location: ../index.php');
        }
        
    }
    header('Location: ../index.php');
}
?>