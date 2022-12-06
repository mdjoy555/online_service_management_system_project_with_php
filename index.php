<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- font awesome css -->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- custom css -->
    <link rel="stylesheet" href="css/custom.css">
    <title>Online Service</title>    
</head>
<body>
<!-- start navigation -->
<nav class="navbar navbar-expand-sm navbar-dark bg-info fixed-top">
<a href="index.php" class="navbar-brand">Online Service</a>
</nav>
<!-- start header jumbotron -->
<header class="jumbotron back-image">
<div class="myclass mainHeading">
    <h1 class="text-uppercase text-info font-weight-bold">Welcome to Online Service</h1>
    <!--<p class="font-italic">Customer's happiness is our aim</p>-->
    <a href="requester/login.php" class="btn btn-success mr-4">Login</a>
    <a href="#registration" class="btn btn-danger mr-4">Sign Up</a>
</div>
</header>
<div class="jumbotron container-fluid">
        <h3 class="text-center mb-4">Online Service</h3>
        <p>
            Online Service is leading chain of multi-brand
            electronics and electrical service workshops offering
            wide array of services. We focus on enhancing your uses
            experience by offering world-class electronic appliances
            maintenance services. Our sole mission is "To provide
            electronic appliances care services to keep the devices
            fit and healthy and preventive maintenance and fault repair
            and customers happiness and smiles". With well-equipped
            electronic appliances service centers and fully trained
            machanics, we provide quality services with excellent packages
            that are designed to offer you great savings. Our state-of-art
            workshops are conveniently located in many cities across the
            country. Now you can book your service online by doing
            registration.
        </p>
</div>
<!--start services section-->
<div class="jumbotron container-fluid text-center border-bottom" id="Services">
    <h2>Services</h2>
    <div class="row mt-5">
     <div class="col-sm-4 mb-4">
      <a href="#"><i class="fas fa-tv fa-8x text-success"></i></a>
      <h4 class="mt-4">Electronic Appliances</h4> 
     </div>
     <div class="col-sm-4 mb-4">
      <a href="#"><i class="fas fa-sliders-h fa-8x text-primary"></i></a>
      <h4 class="mt-4">Preventive Maintenance</h4> 
     </div>
     <div class="col-sm-4 mb-4">
      <a href="#"><i class="fas fa-cogs fa-8x text-info"></i></a>
      <h4 class="mt-4">Fault Repair</h4> 
     </div>
    </div>
</div>
<!--start registration form-->
<?php
    include 'registration.php';
?>

<!-- start contact us -->
<?php
    include 'contact.php';
?>
<!-- start footer -->
<footer class="container-fluid bg-dark mt-5">
    <div class="text-right">
       <small><a href="admin/login.php">Admin Login</a></small>
    </div>
</footer>
<!-- javascript -->
<script src="js/jquery.min.js"></script>
<scrip src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/all.min.js"></script>
</body>
</html>