<?php
    define('Title', 'Update Requester');
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
?>

<?php
    if(isset($_POST['edit']))
    {
        $sql = "SELECT * FROM sign_up
                WHERE requester_login_id='".$_POST['id']."'";
        
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
    }
    if(isset($_POST['requestupdate']))
    {
        if(empty($_POST['requester_login_id'])
            || empty($_POST['requester_name'])
            || empty($_POST['requester_email']))
        {
            $joy = '<div class="alert alert-warning
                    col-sm-12 mt-3">
                    All Fields Are Required</div>';
        }
        else
        {
            $rid = $_POST['requester_login_id'];
            $rname = $_POST['requester_name'];
            $remail = $_POST['requester_email'];

            $sql = "UPDATE sign_up SET
                    requester_name='".$rname."',
                    requester_email='".$remail."'
                    WHERE requester_login_id='".$rid."'";
                
            if(mysqli_query($conn,$sql))
            {
                $joy = '<div class="alert alert-success
                        col-sm-12 mt-3">
                        Update Successfull</div>';
            }
            else
            {
                $joy = '<div class="alert alert-danger
                        col-sm-12 mt-3">
                        Update Failed</div>';
            }
        }
    }
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3>Update Requester</h3>
    <form action="" method="POST">
        <div class="form-group">
            <label for="requester_login_id">Requester Id</label>
            <input type="text" class="form-control"
            name="requester_login_id" id="requester_login_id"
            value="<?php if(isset($row['requester_login_id']))
            {echo $row['requester_login_id'];} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="requester_name">Requester Name</label>
            <input type="text" class="form-control"
            name="requester_name" id="requester_name"
            value="<?php if(isset($row['requester_name']))
            {echo $row['requester_name'];} ?>">
        </div>
        <div class="form-group">
            <label for="requester_email">Requester Email</label>
            <input type="text" class="form-control"
            name="requester_email" id="requester_email"
            value="<?php if(isset($row['requester_email']))
            {echo $row['requester_email'];} ?>">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger"
            id="requestupdate" name="requestupdate">Update</button>
            <a href="requester.php" class="btn btn-secondary">
            Close</a>
        </div>
    </form>
    <?php
        if(!empty($joy))
        {
            echo $joy;
        }
    ?>
</div>

<?php
    include 'includefile/footer.php';
?>