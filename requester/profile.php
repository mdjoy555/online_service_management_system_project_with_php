<?php
    define('Title', 'Profile');
    define('Page', 'Profile');
    include 'includefile/header.php';
    include '../connection.php';
    
    session_start();
    
    if($_SESSION['is_login'])
    {
        $rEmail = $_SESSION['rEmail'];
    }
    else
    {
        header('Location: login.php');
    }
    
    $sql = "SELECT requester_name,requester_email 
            FROM sign_up WHERE requester_email='".$rEmail."'";
    
    if(mysqli_query($conn,$sql)->num_rows!=0)
    {
        $row = mysqli_fetch_array(mysqli_query($conn,$sql));
        $rName = $row['requester_name'];
    }

    if(isset($_POST['nameupdate']))
    {
        if(empty($_POST['rName']))
        {
            $joy = '<div class="alert alert-warning mt-2"
                    role="alert">Fill the field</div>';
        }
        else
        {
            $sql = "UPDATE sign_up SET
                    requester_name='".$_POST['rName']."'
                    WHERE requester_email='".$rEmail."'";
             
            if(mysqli_query($conn,$sql))
            {
                ?>
                <meta http-equiv="refresh" content="0;URL=?updated"/>
                <?php
                #$joy = '<div class="alert alert-success mt-2"
                #        role="alert">Successfully Updated</div>';
            }
            else
            {
                $joy = '<div class="alert alert-danger mt-2"
                        role="alert">Update Failed</div>';
            }
        }
    }
?>

<div class="col-sm-6 mt-5">
    <form action="" method="POST" class="mx-5">
        <div class="form-group">
            <label for="rEmail">Email</label>
            <input type="email" class="form-control"
            name="rEmail" id="rEmail"
            value="<?php echo $rEmail; ?>"
            readonly>
        </div>
        <div class="form-group">
            <label for="rName">Name</label>
            <input type="text" class="form-control"
            name="rName" id="rName"
            value="<?php echo $rName; ?>"
            readonly>
        </div>
        <div class="form-group">
            <label for="rName">Change Name</label>
            <input type="text" class="form-control"
            name="rName" id="rName">
        </div>
        <button type="submit" class="btn btn-danger"
                name="nameupdate">Update</button>
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