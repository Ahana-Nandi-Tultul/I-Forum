<?php
session_start();
echo' <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="index.php">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
         Top Categories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
        include 'dbconnect.php';
        $sql="SELECT * FROM `categories` LIMIT 3";
        $result=mysqli_query($conn, $sql);
        while($row=mysqli_fetch_assoc($result)){
          echo'
          <li><a class="dropdown-item" href="threadList.php?catid='.$row['category_Id'].'">'.$row['category_name'].'</a></li>';
        }
        echo'</ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php" aria-disabled="true">Contact</a>
      </li>
    </ul>
    <div class="mx-2 d-flex">';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
      echo' <form class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success" type="submit">Search</button>
      <p class="text-light my-0 mx-2"> WelCome '.$_SESSION['useremail'].'</p>
      <a href="partials/logout.php" role="button" class="btn btn-outline-success">Log Out</a>
    </form>';
    }
    else{
    echo'<form class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success" type="submit">Search</button>
    </form>
        <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Log In</button>
        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</button>';
    }

   echo' </div>
  </div>
</div>
</nav>';

include 'partials/loginModal.php';
include 'partials/signUpModal.php';
if((isset($_GET['signupsuccess'])) and ($_GET['signupsuccess']==true)){
  echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Success!</strong> You can now log In
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}

else{
  if((isset($_GET['signupsuccess'])) and  ($_GET['signupsuccess']==false)){
    echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
    <strong>Error!</strong> '.$_GET['error'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
}
?>