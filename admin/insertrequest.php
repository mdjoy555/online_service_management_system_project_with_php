<?php
    define('Title', 'Add Requester');
    define('Page', 'requester');
    include '../connection.php';
    include 'includefile/header.php';
    session_start();
    if(isset($_SESSION['is_adminlogin']))
    {
        $aemail = $_SESSION['aEmail'];
    }
    else
    {
        header('Location: login.php');
    }

    if(isset($_POST['requestsubmit']))
    {
        if(empty($_POST['requester_name'])
            || empty($_POST['requester_email'])
            || empty($_POST['requester_password']))
        {
            $joy = '<div class="alert alert-warning
                    col-sm-12 mt-3">All Fields Are
                    Required</div>';
        }
        else
        {
            $rname = $_POST['requester_name'];
            $remail = $_POST['requester_email'];
            $rpassword = md5($_POST['requester_password']);

            $sql = "INSERT INTO sign_up(requester_name,
                    requester_email,requester_password)
                    VALUES('".$rname."','".$remail."',
                    '".$rpassword."')";
            
            if(mysqli_query($conn,$sql))
            {
                $joy = '<div class="alert alert-success
                        col-sm-12 mt-3">Insert
                        Successfull</div>';
            }
            else
            {
                $joy = '<div class="alert alert-danger
                        col-sm-12 mt-3">Insert
                        Failed</div>';
            }
        }
    }
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add Requester</h3>
    <form action="" method="POST">
        <div class="form-group">
            <label for="requester_name">Name</label>
            <input type="text" class="form-control"
            id="requester_name" name="requester_name">
        </div>
        <div class="form-group">
            <label for="requester_email">Email</label>
            <input type="email" class="form-control"
            id="requester_email" name="requester_email">
        </div>
        <div class="form-group">
            <label for="requester_password">Password</label>
            <input type="password" class="form-control"
            id="requester_password" name="requester_password">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger"
            id="requestsubmit" name="requestsubmit">Submit
            </button>
            <a href="requester.php" class="btn btn-secondary">
            Close</a>
        </div>
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