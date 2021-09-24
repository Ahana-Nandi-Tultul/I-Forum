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
    $id= $_GET["Thread_Id"];
     $sql="SELECT * FROM `threadlist` WHERE `Thread_Id`= '$id'";
     $result=mysqli_query($conn, $sql);
     while($row=mysqli_fetch_assoc($result)){
         $Title=$row['Thread_Title'];
         $desc= $row['Thread_desc'];
         $Thread_user_id2=$row['Thread_user_id'];
            
         $sql2="SELECT * FROM `users` WHERE `sno`= '$Thread_user_id2'";
         $result2=mysqli_query($conn, $sql2);
         $row2=mysqli_fetch_assoc($result2);

         $posted_by=$row2['user_email'];
     } ?>

    <?php 
    $showAlart=false;
    $method= $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        $comment=$_POST['comment'];
        $comment=str_replace("<","&lt","$comment");
        $comment=str_replace(">","&gt","$comment");
        $sno=$_POST['sno'];
        $sql="INSERT INTO `comments` ( `comment_content`, `Thread_Id`, `comment_by`, `comment_time`)
         VALUES ( '$comment', '$id', '$sno', current_timestamp());;";
        $result=mysqli_query($conn, $sql);
        $showAlart=true;
    }
    if($showAlart){
        echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your comment has been added.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <!-- Categories container starts here -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $Title ?></h1>
            <p class="lead"><?php echo $desc ?></p>
            <hr class="my-4">
            <p>This forum for shring knowledge.No Spam / Advertising / Self-promote in the forums not allowed.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Remain respectful of other members at all times.</p>
            <p><b>Post By: <em><?php echo $posted_by; ?></em></b></p>
        </div>
    </div>
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo'
        <div class="container">
            <h1 class="py-3">Post a Comment</h1>
                 <form action="'.$_SERVER['REQUEST_URI'].'?>" method="POST">
    <div class="form-floating">
        <textarea class="form-control" placeholder="Comment" id="comment" name="comment"
            style="height: 100px"></textarea>
        <label for="floatingTextarea2">Comment</label>
        <input type="hidden" name="sno" value='.$_SESSION['sno'].'>
    </div>
    <button type="submit" class="btn btn-success my-3">Post Comment</button>
    </form>
    </div>';
    }
    else{
    echo'<div class="container">
        <h1 class="py-3">Post a Comment</h1>
        <p class="lead">You are not logged in. Please log in to post a Comments</p>
    </div>';
    }
    ?>
    <div class="container " id="qusid">
        <h1 class="py-3">Discussions</h1>
        <br>

        <?php
        $id= $_GET["Thread_Id"];
        $sql="SELECT * FROM `comments` WHERE `Thread_Id`='$id'";
        $result=mysqli_query($conn, $sql);
        $noresult=true;
         while($row=mysqli_fetch_assoc($result)){
             $id=$row['comment_id'];
             $content= $row['comment_content'];
             $comment_time=$row['comment_time'];
             $noresult=false;
            $commnet_by=$row['comment_by'];

            $sql2="SELECT * FROM `users` WHERE `sno`= '$commnet_by'";
            $result2=mysqli_query($conn, $sql2);
            $row2=mysqli_fetch_assoc($result2);

       echo' <div class="d-flex my-3">
            <div class="flex-shrink-0">
                <img src="images/user_default.jpg" style="width:54px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
            <p class="my-0"><b>'.$row2['user_email'].'</b> at '.$comment_time.'</p>
                '.$content.'
            </div>
        </div>';

    } 
    if($noresult){
         
        echo '<h4>No Threads Found</h4>
        <b>Be the first person to ask the question</b>';
    }
    ?>
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