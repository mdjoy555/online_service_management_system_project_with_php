<?php
    include '../connection.php';

    session_start();
    
    if(!isset($_SESSION['is_login']))
    {
        if(isset($_POST['submit']))
        {
            $email = $_POST['rEmail'];
            $password = md5($_POST['rPassword']);

            #echo $email;
            #echo $password;
            #echo $email, " ", $password;
            #echo $email, "<br>";
            #echo $password, "<br>";
            #echo $email, "<br>", $password, "<br>";

            $sql = "SELECT requester_email, requester_password
                    FROM sign_up WHERE requester_email='".$email."'
                    AND requester_password='".$password."'";
            
            $result = mysqli_query($conn,$sql);
            
            if($result->num_rows!=0)
            {
                $_SESSION['is_login'] = true;
                $_SESSION['rEmail'] = $email;
                
                header('Location: profile.php');

                #$joy = '<div class="alert alert-success
                #        mt-2 role="alert">Login Successfull</div>';
            }
            else
            {
                $joy = '<div class="alert alert-danger
                mt-2 role="alert">Login Failed</div>';
            }
        }
    }
    else
    {
        header('Location: profile.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,
                initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <style>
        .custom-margin{
            margin-top: 4vh;
        }
    </style>
    <title>Login</title>
    <style>
body {
  background-color: #eee;
}
</style>
</head>
<body>
    <div class="mt-3 text-center" style="font-size: 30px;">
        <i class="fas fa-stethoscope"></i>
        <span>Online Service</span>
    </div>
    <p class="text-center" style="font-size: 20px;">
    <i class="fas fa-user-secret"></i>Login Page</p>
    <div class="container-fluid">
        <div class="row justify-content-center custom-margin">
            <div class="col-sm-6 col-md-6">
                <form action="" class="shadow-lg p-4" method="POST">
                    <div class="form-group">
                        <i class="fas fa-user"></i>
                        <label for="email"
                        class="font-weight-bold pl-2">
                        Email</label>
                        <input type="email"
                        class="form-control"
                        placeholder="Email"
                        name="rEmail">
                        <small class="form-text">We will
                        never share your email with anyone
                        </small>
                    </div>
                    <div class="form-gourp">
                        <i class="fas fa-key"></i>
                        <label for="pass"
                        class="font-weight-bold pl2">
                        Password</label><input type="password"
                        class="form-control" placeholder="Password"
                        name="rPassword">
                    </div>
                    <button type="submit" name="submit"
                    class="btn btn-outline-info mt-3
                    font-weight-bold btn-block shadow-sm">
                    Login</button>
                    <?php
                        if(!empty($joy))
                        {
                            echo $joy;
                        }
                    ?>
                </form>
                <div class="text-center"><a href="forgetpassword.php"
                class="btn btn-danger mt-2 font-weight-bold
                shadow-sm">Forget Password</a>
                </div>
                <div class="text-center">
                    <a href="../index.php"
                    class="btn btn-info mt-2
                    font-weight-bold shadow-sm">
                    Back to Home</a>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/pooper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/all.min.js"></script>
</body>
</html>