<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo Title;?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <style>
        body{
            background-color: #eee;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark fixed-top bg-info
    flex-md-nowrap p-0 shadow"><a class="navbar-brand col-sm-3
    col-md-2 mr-0" href="../index.php">Online Service</a></nav>
    <div class="container-fluid" style="margin-top: 40px;">
        <div class="row">
            <nav class="col-sm-2 bg-light sidebar py-5">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                        <a class="nav-link <?php if(Page=='dashboard')
                         {echo "active";} ?>" href="dashboard.php">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
                        <li class="nav-item">
                        <a class="nav-link <?php if(Page=='work')
                        {echo "active";} ?>" href="work.php">
                        <i class="fab fa-accessible-icon"></i>Work Assign</a></li>
                        <li class="nav-item"><a class="nav-link <?php
                        if(Page=='request'){echo "active";} ?>"
                        href="request.php">
                        <i class="fas fa-align center"></i>Request</a></li>
                        <li class="nav-item"><a class="nav-link <?php
                        if(Page=='product'){echo "active";} ?>"
                        href="product.php">
                        <i class="fas fa-database"></i>Product</a></li>
                        <li class="nav-item"><a class="nav-link <?php
                        if(Page=='technician'){echo "active";} ?>"
                        href="technician.php">
                        <i class="fab fa-teamspeak"></i>Technician</a></li>
                        <li class="nav-item"><a class="nav-link <?php
                        if(Page=='requester'){echo "active";} ?>"
                        href="requester.php">
                        <i class="fas fa-users"></i>Requester</a></li>
                        <li class="nav-item"><a class="nav-link <?php
                        if(Page=='sellreport'){echo "active";} ?>"
                        href="sellreport.php">
                        <i class="fas fa-table"></i>Sells Report</a></li>
                        <li class="nav-item"><a class="nav-link <?php
                        if(Page=='workreport'){echo "active";} ?>"
                        href="workreport.php">
                        <i class="fas fa-table"></i>Work Report</a></li>
                        <li class="nav-item"><a class="nav-link <?php
                        if(Page=='contactrequest'){echo "active";} ?>"
                        href="contactrequest.php">
                        <i class="fas fa-table"></i>Contact Request</a></li>
                        <li class="nav-item"><a class="nav-link <?php
                        if(Page=='changepassword'){echo "active";} ?>"
                        href="changepassword.php">
                        <i class="fas fa-key"></i>Change Password</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">
                        <i class="fas fa-sign-out-alt"></i>Logout</a></li>
                    </ul>
                </div>
            </nav>