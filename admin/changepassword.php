<?php
    include '../connection.php';
    define('Title', 'Change Password');
    define('Page', 'Change Password');
    include 'includefile/header.php';
    
    session_start();
    
    if($_SESSION['is_adminlogin'])
    {
        $aEmail = $_SESSION['aEmail'];
    }
    else
    {
        header('Location: login.php');
    }
    
    $aEmail = $_SESSION['aEmail'];

    if(isset($_POST['passwordupdate']))
    {
        if(empty($_POST['aPassword'])
            || empty($_POST['acPassword']))
        {
            $joy = '<div class="alert alert-warning mt-3"
                    role="alert">Fill the field</div>';
        }
        else
        {
            $apassword = md5($jo=$_POST['aPassword']);
            $acpassword = md5($jj=$_POST['acPassword']);
            
            if($jo==$jj)
            {
                $sql = "UPDATE admin_login SET
                admin_password='".$apassword."'
                WHERE admin_email='".$aEmail."'";

                if(mysqli_query($conn,$sql))
                {
                    $joy = '<div class="alert alert-success mt-3"
                            role="alert">Successfully Updated</div>';
                }
                else
                {
                    $joy = '<div class="alert alert-danger mt-3"
                            role="alert">Update Failed</div>';
                }
            }
            else
            {
                $joy = '<div class="alert alert-warning
                        mt-3 role="alert">The confirm password
                        does not match with the new
                        password</div>';
            }
        }
    }
?>

<div class="col-sm-9 col-md-10">
    <form class="mt-5 mx-5" action="" method="POST">
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail"
            value="<?php echo $aEmail; ?>"readonly>
        </div>
        <div class="form-group">
            <label for="inputnewpassword">New Password</label>
            <input type="password" class="form-control"
            id="inputnewpassword" placeholder="New Password"
            name="aPassword">
        </div>
        <div class="form-group">
            <label for="inputnewpassword">Confirm Password</label>
            <input type="password" class="form-control"
            id="inputnewpassword" placeholder="Confirm Password"
            name="acPassword">
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