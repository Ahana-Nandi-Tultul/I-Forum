<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <title>iDiscuss-Coding Forum</title>
    <style>
    .jumbotron {
        padding: 2rem 1rem;
        margin-bottom: 2rem;
        background-color: #e9ecef;
        border-radius: .3rem;
    }

    #qusid {
        min-height: 433px;
    }
    </style>
</head>

<body>
    <?php require'partials/header.php'; ?>
    <?php require'partials/dbconnect.php'; ?>
    <?php
    $id= $_GET["catid"];
     $sql="SELECT * FROM `categories` WHERE `category_Id`= '$id'";
     $result=mysqli_query($conn, $sql);
     while($row=mysqli_fetch_assoc($result)){
         $catName=$row['category_name'];
         $catDesc= $row['category_description'];
     } ?>
    <?php 
    $showAlart=false;
    $method= $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        $th_title=$_POST['title'];
        $th_desc=$_POST['desc'];

        $th_title=str_replace("<","&lt","$th_title");
        $th_title=str_replace(">","&gt","$th_title");

        $th_desc=str_replace("<","&lt","$th_desc");
        $th_desc=str_replace(">","&gt","$th_desc");
        
        $sno=$_POST['sno'];
        $sql="INSERT INTO `threadlist` (`Thread_Id`, `Thread_Title`, `Thread_desc`, `Thread_cat_id`, `Thread_user_id`, `TimeStmp`) VALUES
         (NULL, '$th_title', '$th_desc', '$id', '$sno', current_timestamp());";
        $result=mysqli_query($conn, $sql);
        $showAlart=true;
    }
    if($showAlart){
        echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your thread has been added. Please wait for community to responce
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>

    <!-- Categories container starts here -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catName ?></h1>
            <p class="lead"><?php echo $catDesc ?></p>
            <hr class="my-4">
            <p>This forum for shring knowledge.No Spam / Advertising / Self-promote in the forums not allowed.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Remain respectful of other members at all times.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
    <?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
   echo' <div class="container">
        <h1 class="py-3">Start a Discussions</h1>
        <form action="'.$_SERVER['REQUEST_URI'].'?>" method="POST">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Problem Title</label>
        <input type="text" class="form-control" id="exampleInputEmail1" id="title" name="title"
            aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">Keep your title as short and crisp as possible</div>
        <input type="hidden" name="sno" value='.$_SESSION['sno'].'>
    </div>
   
    <div class="form-floating">
        <textarea class="form-control" placeholder="Elaborate your concerned" id="desc" name="desc"
            style="height: 100px"></textarea>
        <label for="floatingTextarea2">Elaborate your concerned</label>
    </div>
    <button type="submit" class="btn btn-success my-3">Submit</button>
    </form>
    </div>';
    }
    else{
    echo'<div class="container">
    <h1 class="py-3">Start a Discussions</h1>
    <p class="lead">You are not logged in. Please log in to start a Discussions</p>
    </div>';
    }

    ?>
    
    <div class="container " id="qusid">
        <h1 class="py-3">Browse Question</h1>
        <br>
        <?php
        $id= $_GET["catid"];
        $sql="SELECT * FROM `threadlist` WHERE `Thread_cat_id`='$id'";
        $result=mysqli_query($conn, $sql);
        $noresult=true;
         while($row=mysqli_fetch_assoc($result)){
             $noresult=false;
             $Title=$row['Thread_Title'];
             $Desc= $row['Thread_desc'];
             $id= $row['Thread_Id'];
             $thread_time=$row['TimeStmp'];

             $thread_user_id=$row['Thread_user_id'];
             $sql2="SELECT * FROM `users` WHERE `sno`= '$thread_user_id'";
             $result2=mysqli_query($conn, $sql2);
             if($result2!=null){
             $row2=mysqli_fetch_assoc($result2);
             }
       echo' <div class="d-flex my-3">
            <div class="flex-shrink-0">
                <img src="images/user_default.jpg" style="width:54px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
            <p class="my-0"><b>'.$row2['user_email'].'</b> at '.$thread_time.'</p>
                <h5 class="mt-0"><a href="thread.php?Thread_Id='.$id.'" style="text-decoration:none;">'.$Title.'</a></h5>
                '.$Desc.'
            </div>
        </div>
        <br>'
        
        ;
    } 
    //echo var_dump($noresult);
     if($noresult){
         
         echo '<h4>No Threads Found</h4>
         <b>Be the first person to ask the question</b>';
     }
    ?>


        <!-- remove later -->
        <!-- <div class="d-flex my-3">
            <div class="flex-shrink-0">
                <img src="images/user_default.jpg" style="width:54px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
                <h5>heading</h5>
                This is some content from a media component. You can replace this with any content and adjust it as
                needed.
            </div>
        -->
    </div>

    <?php require'partials/footer.php'; ?>


    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>