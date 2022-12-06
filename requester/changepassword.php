<?php
    include '../connection.php';
    define('Title', 'Change Password');
    define('Page', 'Change Password');
    include 'includefile/header.php';
    session_start();
    if($_SESSION['is_login'])
    {
        $rEmail = $_SESSION['rEmail'];
    }
    else
    {
        header('Location: login.php');
    }
    
    $rEmail = $_SESSION['rEmail'];

    if(isset($_POST['passwordupdate']))
    {
        if(empty($_POST['rPassword'])
            || empty($_POST['rcPassword']))
        {
            $joy = '<div class="alert alert-warning mt-2"
                    role="alert">Fill the field</div>';
        }
        else
        {
            $jo=$_POST['rPassword'];
            $jj=$_POST['rcPassword'];
            $rpassword = md5($jo);
            $rcpassword = md5($jj);
            
            $j = strlen($jo);
            
            if($j<8)
            {
                $joy = '<div class="alert alert-warning
                        mt-2 role="alert">The length of
                        password can not be less than
                        8</div>';
            }
            if($jo!=$jj)
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
                WHERE requester_email='".$rEmail."'";

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
    }
?>

<div class="col-sm-9 col-md-10">
    <form class="mt-5 mx-5" action="" method="POST">
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail"
            value="<?php echo $rEmail; ?>"readonly>
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
        <button type="submit" class="btn btn-danger mr-2 mt-4"
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
