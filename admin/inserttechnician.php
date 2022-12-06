<?php
    define('Title', 'Add Technician');
    define('Page', 'technician');
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

    if(isset($_POST['techniciansubmit']))
    {
        if(empty($_POST['technician_name'])
            || empty($_POST['technician_city'])
            || empty($_POST['technician_mobile'])
            || empty($_POST['technician_email']))
        {
            $joy = '<div class="alert alert-warning
                    col-sm-12 mt-3">All Fields Are
                    Required</div>';
        }
        else
        {
            $tname = $_POST['technician_name'];
            $tcity = $_POST['technician_city'];
            $tmobile = $_POST['technician_mobile'];
            $temail = $_POST['technician_email'];

            $sql = "INSERT INTO technician(technician_name,
                    technician_city,technician_mobile,
                    technician_email) VALUES('".$tname."',
                    '".$tcity."','".$tmobile."','".$temail."')";
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
    <h3 class="text-center">Add Technician</h3>
    <form action="" method="POST">
        <div class="form-group">
            <label for="technician_name">Name</label>
            <input type="text" class="form-control"
            id="technician_name" name="technician_name">
        </div>
        <div class="form-group">
            <label for="technician_city">City</label>
            <input type="text" class="form-control"
            id="technician_city" name="technician_city">
        </div>
        <div class="form-group">
            <label for="technician_mobile">Mobile Number</label>
            <input type="text" class="form-control"
            id="technician_mobile" name="technician_mobile"
            onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group">
            <label for="technician_email">Email</label>
            <input type="email" class="form-control"
            id="technician_email" name="technician_email">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger"
            id="techniciansubmit" name="techniciansubmit">Submit
            </button>
            <a href="technician.php" class="btn btn-secondary">
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

<script>
    function isInputNumber(joy)
    {
        var ch = String.fromCharCode(joy.which);
        if(!(/[0-9]/.test(ch)))
        {
            joy.preventDefault();
        }
    }
</script>

<?php
    include 'includefile/footer.php';
?>