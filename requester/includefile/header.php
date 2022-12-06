<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <title><?php echo Title ?></title>
    <style>
        body{
            background-color: #eee;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark fixed-top bg-info
                fixed-md-nowrap p-0 shadow">
                <a class="navbar-brand col-sm-3
                col-md-2 mr-0" href="../index.php">Online Service</a></nav>
    <div class="container-fluid" style="margin-top: 40px;">
        <div class="row">
            <nav class="col-sm-2 bg-light sidebar py-5">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                        <a class="nav-link <?php if(Page=='profile')
                         {echo "active";} ?>" href="profile.php">
                        <i class="fas fa-user"></i>Profile</a></li>
                        <li class="nav-item">
                        <a class="nav-link <?php if(Page=='submit')
                        {echo "active";} ?>" href="submit.php">
                        <i class="fab fa-accessible-icon"></i>Submit</a></li>
                        <li class="nav-item"><a class="nav-link <?php
                        if(Page=='checkstatus'){echo "active";} ?>"
                        href="checkstatus.php">
                        <i class="fas fa-align center"></i>Check Status</a></li>
                        <li class="nav-item"><a class="nav-link <?php
                        if(Page=='contactstatus'){echo "active";} ?>"
                        href="contactstatus.php">
                        <i class="fas fa-align center"></i>Contact Status</a></li>
                        <li class="nav-item"><a class="nav-link <?php
                        if(Page=='changepassword'){echo "active";} ?>"
                        href="changepassword.php">
                        <i class="fas fa-key"></i>Change Password</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">
                        <i class="fas fa-sign-out-alt"></i>Logout</a></li>
                    </ul>
                </div>
            </nav>