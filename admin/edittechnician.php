<?php
    define('Title', 'Update Technician');
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
?>

<?php
    if(isset($_POST['edit']))
    {
        $sql = "SELECT * FROM technician WHERE
                technician_id='".$_POST['id']."'";
    
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
    }

    if(isset($_POST['technicianupdate']))
    {
        if(empty($_POST['technician_name'])
            || empty($_POST['technician_city'])
            || empty($_POST['technician_mobile'])
            || empty($_POST['technician_email']))
        {
            $joy = '<div class="alert alert-warning
                    col-sm-12 mt-3">
                    All Fields Are Required</div>';
        }
        else
        {
            $tid = $_POST['technician_id'];
            $tname = $_POST['technician_name'];
            $tcity = $_POST['technician_city'];
            $tmobile = $_POST['technician_mobile'];
            $temail = $_POST['technician_email'];
            
            $sql = "UPDATE technician SET
                    technician_name='".$tname."',
                    technician_city='".$tcity."',
                    technician_mobile='".$tmobile."',
                    technician_email='".$temail."'
                    WHERE technician_id='".$tid."'";
                
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
    <h3>Update Technician</h3>
    <form action="" method="POST">
        <div class="form-group">
            <label for="technician_id">Technician Id</label>
            <input type="text" class="form-control"
            name="technician_id" id="technician_id"
            value="<?php if(isset($row['technician_id']))
            {echo $row['technician_id'];} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="technician_name">Technician Name</label>
            <input type="text" class="form-control"
            name="technician_name" id="technician_name"
            value="<?php if(isset($row['technician_name']))
            {echo $row['technician_name'];} ?>">
        </div>
        <div class="form-group">
            <label for="technician_city">Technician City</label>
            <input type="text" class="form-control"
            name="technician_city" id="technician_city"
            value="<?php if(isset($row['technician_city']))
            {echo $row['technician_city'];} ?>">
        </div>
        <div class="form-group">
            <label for="technician_mobile">Technician Mobile</label>
            <input type="text" class="form-control"
            name="technician_mobile" id="technician_mobile"
            value="<?php if(isset($row['technician_mobile']))
            {echo $row['technician_mobile'];} ?>"
            onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group">
            <label for="technician_email">Technician Email</label>
            <input type="text" class="form-control"
            name="technician_email" id="technician_email"
            value="<?php if(isset($row['technician_email']))
            {echo $row['technician_email'];} ?>">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger"
            id="technicianupdate" name="technicianupdate">Update</button>
            <a href="technician.php" class="btn btn-secondary">
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

<script>
    function isInputNumber(joy)
    {
        var ch = String.fromCharCode(joy.which);
        if(!(/[0-9]/.test(var)))
        {
            joy.preventDefault();
        }
    }
</script>

<?php
    include 'includefile/footer.php';
?>