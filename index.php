<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <title>iDiscuss-Coding Forum</title>
</head>

<body>
    <?php require'partials/header.php'; ?>
    <?php require'partials/dbconnect.php'; ?>
    <!-- sliders start here -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/apple.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/programming.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/apple2.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Categories container starts here -->
    <div class="container my-4">
        <h1 class="text-center my-3">iDiscuss-Coding Forum</h1>
        <div class="row">

            <!-- fetch all the categories -->
            <!-- use a for loop to itterate through categories -->
            <?php
                $sql='SELECT * FROM `categories`';
                $result=mysqli_query($conn, $sql);
                while($row=mysqli_fetch_assoc($result)){
                    // echo $row['category_Id'];
                    // echo $row['category_name'];
                $id=$row['category_Id'];
                $cat=$row['category_name'];
                $desc=$row['category_description'];
                echo'<div class="col-md-4">
                    <div class="card my-2" style="width: 18rem;">
                        <img src="images/card/card'.$id.'.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><a href="threadList.php?catid='.$id.'" style="text-decoration:none;">'.$cat.'</a></h5>
                            <p class="card-text">'.substr($desc, 0, 90) .'...</p>
                            <a href="threadList.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                        </div>
                    </div>
                </div>';
                }
            ?>

        </div>
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