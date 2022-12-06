<?php
    include '../connection.php';

    if(isset($_POST['passwordupdate']))
    {
        if(empty($_POST['rEmail'])
            || empty($_POST['rPassword'])
            || empty($_POST['rcPassword']))
        {
            $joy = '<div class="alert alert-warning mt-2"
                    role="alert">Fill the field</div>';
        }
        else
        {
            $remail = $_POST['rEmail'];
            $jo=$_POST['rPassword'];
            $jj=$_POST['rcPassword'];
            $rpassword = md5($jo);
            $rcpassword = md5($jj);

            $str = "SELECT requester_email FROM sign_up WHERE
                    requester_email='".$remail."'";
            
            echo $str;

            if(mysqli_query($conn,$str)->num_rows!=0)
            {
                $j = strlen($jo);
            
                if($j<8)
                {
                    $joy = '<div class="alert alert-warning
                            mt-2 role="alert">The length of
                            password can not be less than
                            8</div>';
                }
                else if($jo!=$jj)
                {
                    $joy = '<div class="alert alert-warning
                    mt-2 role="alert">The confirm password
                    does not match with the new
                    password</div>';
                }
                else
                {
                    $sql = "UPDATE sign_up SET
                    requester_password='".$rpassword."'
                    WHERE requester_email='".$remail."'";

                    if(mysqli_query($conn,$sql))
                    {
                        $joy = '<div class="alert alert-success mt-2"
                                role="alert">Successfully Updated</div>';
                    }
                    else
                    {
                        $joy = '<div class="alert alert-danger mt-2"
                                role="alert">Update Failed</div>';
                    }
                }
            }
            else
            {
                $joy = '<div class="alert alert-danger mt-2"
                        role="alert">Invalid Email id</div>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <title>Forget Password</title>
</head>
<body>
    <nav class="navbar navbar-dark fixed-top bg-danger
                fixed-md-nowrap p-0 shadow">
                <a class="navbar-brand col-sm-3
                col-md-2 mr-0" href="../index.php">Online Service</a></nav>
    <div class="container-fluid" style="margin-top: 40px;">
        <div class="row">
<div class="col-sm-9 col-md-10">
    <form class="mt-5 mx-5" action="" method="POST">
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail"
            placeholder="Email" name="rEmail">
        </div>
        <div class="form-group">
            <label for="inputnewpassword">New Password</label>
            <input type="password" class="form-control"
            id="inputnewpassword" placeholder="New Password"
            name="rPassword">
        </div>
        <div class="form-group">
            <label for="inputnewpassword">Confirm Password</label>
            <input type="password" class="form-control"
            id="inputnewpassword" placeholder="Confirm Password"
            name="rcPassword">
        </div>
        <button type="submit" class="btn btn-danger mr-4 mt-4"
        name="passwordupdate">Update</button>
        <button type="reset" class="btn btn-secondary mt-4">
        Reset</button>
        <?php
            if(!empty($joy))
            {
                echo $joy;
            }
        ?>
    </form>   
</div>

<?php
    include 'includefile/footer.php';
?>
