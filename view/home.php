<?php 
    include_once '../connection/database_conn.php';
    $mysqli = connect_db();
    
    session_start();

    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit();
    }
    
    include_once '../includes/students.php';
    include_once '../includes/courses.php';
    include_once '../includes/gender.php';
    include_once '../includes/admin.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">

    <title>Home</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">
  </head>
  <body>

  <?php
        include_once '../navbars/menu.php'; 
    ?> 
<br>
    <main role="main">

      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="first-slide" src="../view/images/3.jpg" alt="First slide">
            <div class="container">
              <div class="carousel-caption text-left">
                <h1>Student Management System.</h1>
                <p>With the help of this system, you can be able to manage every student information ranging from their name and email, courses offered and payment made.</p>
                <p><a class="btn btn-lg btn-primary" href="add_student.php" role="button">Sign up a new student</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="second-slide" src="../view/images/stud_pix 1.jpg" alt="Second slide">
            <div class="container">
            <div class="carousel-caption">
                <h1>A Simple SMS</h1>
                <p>Simple Student Management System, very interactive with a friendly user interface</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="third-slide" src="../view/images/stud_pix 2.jpg" alt="Third slide">
            <div class="container">
            <div class="carousel-caption text-right">
                <h1>To Get The Most.</h1>
                <p>Requires you to get started immediately and a trial will convince you.</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Click here</a></p>
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>


      <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->

      <div class="container marketing">

        <!-- Three columns of text below the carousel -->
       


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">          
            <h2 class="featurette-heading">A Simple SMS. <span class="text-muted">It's simplicity, user friendly and interactiveness will blow your mind.</span></h2>
            <p class="lead">Running a training organisation is complicated.
                Students must be found through marketing, then enrolled, billed, trained, and assessed. 
                Trainers need to organise courses, classes, teaching resources, assessments, 
                and maintain up-to-date knowledge to continue as effective trainers.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" src="../view/images/1.jpg" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">How To Get The Most <span class="text-muted"> Out Of Your Student Information Systems</span></h2>
            <p class="lead">Most schools will use a Student Information System (SIS) as their main tool to manage all their student records and administration.
                  In addition to an SIS, most schools may also have a different system for admissions,
                  a different one for classroom management and a few more for other key aspects of running a school.</p>
          </div>
          <div class="col-md-5 order-md-1">
            <img class="featurette-image img-fluid mx-auto" src="../view/images/stud_pix.jpg" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">What Is A Student  <span class="text-muted">Information System?</span></h2>
            <p class="lead">A Student Information System (SIS), also referred to as a Student Management System (SMS),
                Student Information Management System (SIMS) or Student Record System (SRS),
                is a software solution designed to help schools track and manage all their 
                student data – everything from grades, attendance, behavioural information and more.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" src="../view/images/3edit.jpg" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

      </div><!-- /.container -->


      <!-- FOOTER -->
      <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>&copy; 2021 Arecent Solutions, inc. &middot; <a href="#">www.tombrowngodwin.com</a> &middot; <a href="#">Terms</a></p>
      </footer>
    </main>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../assets/js/vendor/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <!-- <script src="../assets/js/vendor/holder.min.js"></script> -->

   
  </body>
</html>
