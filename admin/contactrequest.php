<?php
    define('Title', 'Contact Request');
    define('Page', 'contactrequest');
    include '../connection.php';
    session_start();
    include 'includefile/header.php';

    if(isset($_SESSION['is_adminlogin']))
    {
        $aemail = $_SESSION['aEmail'];
    }
    else
    {
        header('Location: login.php');
    }
?>

<div class="col-sm-5 mb-5">
    <?php
        $sql = "SELECT * FROM contact";
        
        $result = mysqli_query($conn,$sql);

        if($result->num_rows!=0)
        {
            while($row=mysqli_fetch_array($result))
            {
                ?>
                <div class="card mt-5 mx-5">
                    <div class="card-header">
                        Contact ID:
                        <?php echo $row['contact_id']; ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Name:
                        <?php echo $row['c_name']; ?></h5>
                        <p class="card-text">Subject:
                        <?php echo $row['c_subject']; ?>
                        </p>
                        <p class="card-text">Email:
                        <?php echo $row['c_email']; ?>
                        </p>
                        <p class="card-text">Description:
                        <?php echo $row['c_description']; ?>
                        </p>
                        <form action="" class="d-inline" method="POST">
                            <input type="hidden" name="id" value="<?php
                                echo $row['contact_id']; ?>">
                                <a class="btn btn-danger" data-toggle='modal' data-target="#mm<?php echo $row['contact_id']; ?>">
                                Close</a>
                                <div class="modal" id="mm<?php echo $row['contact_id']; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                               <div class="modal-header">
                                                 <h4 class="modal-title">Delete Confirmation !!!</h4>
                                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                  Are you sure you want to delete request id <b><?php echo $row['contact_id']; ?>? </b>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                  <button type="submit" class="btn btn-success"
                                                  name="delete" value="Delete">Yes</a>
                                                  <button type="submit" class="btn btn-danger" data-dismiss="modal">No</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                <?php
            }
        }
    ?>
</div>

<?php
    if(isset($_POST['delete']))
    {
        $sql = "DELETE FROM contact WHERE contact_id='".$_POST['id']."'";

        if(mysqli_query($conn,$sql))
        {
            echo '<meta http-equiv="refresh" content="0;URL=?closed"/>';
        }
    }

    if(isset($_POST['submit']))
    {
        if(empty($_POST['reply']))
        {
            $joy = '<div class="alert alert-warning
                    col-sm-5">All Fields Are
                    Required</div>';
        }
        else
        {
            $reply = $_POST['reply'];

            $sql = "SELECT * FROM contact";

            if(mysqli_query($conn,$sql))
            {
                $row = mysqli_fetch_array(mysqli_query($conn,$sql));
            }

            $sql = "INSERT INTO reply(contact_id,
                    contact_name,contact_subject,contact_email,
                    contact_description,contact_reply)
                    VALUES('".$row['contact_id']."',
                    '".$row['c_name']."','".$row['c_subject']."',
                    '".$row['c_email']."','".$row['c_description']."',
                    '".$reply."')";
            
            if(mysqli_query($conn,$sql))
            {
                $joy = '<div class="alert alert-success                        
                        col-sm-5">Successfully Replied
                        </div>';
            }
            else
            {
                $joy = '<div class="alert alert-danger
                        col-sm-5">Failed to reply</div>';
            }
        }
    }
?>

<div class="col-sm-5 mt-5 jumbotron">
    <form action="" method="POST">
        <div class="form-group">
            <label for="reply">Reply</label>
            <input type="text" class="form-control" id="reply"
            name="reply">
        </div>
        <div class="float-right">
            <button type="submit" class="btn btn-success"
            name="submit">Submit</button>
            <button type="reset" class="btn btn-secondary">
            Reset</button>
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