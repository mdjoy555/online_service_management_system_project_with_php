<?php
    define('Title', 'Requester');
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

<div class="col-sm-9 col-md-10 mt-5 text-center">
    <p class="bg-dark text-white p-2">Requester List</p>
    <?php
        $sql = "SELECT * FROM sign_up";

        $result = mysqli_query($conn,$sql);

        if($result->num_rows!=0)
        {
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Request Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row=mysqli_fetch_array($result))
                        {
                            ?>
                            <tr>
                                <td><?php echo $row['requester_login_id']; ?></td>
                                <td><?php echo $row['requester_name']; ?></td>
                                <td><?php echo $row['requester_email']; ?></td>
                                <td>
                                    <form action="edit.php" class="d-inline" method="POST">
                                        <input type="hidden" name="id" value="<?php
                                        echo $row['requester_login_id']; ?>">
                                        <button type="submit" class="btn btn-info
                                        mr-3" name="edit" value="Edit">
                                        <i class="fas fa-pen"></i></button>
                                    </form>
                                    <!--<form action="" class="d-inline" method="POST">
                                        <input type="hidden" name="id" value="<php
                                        echo $row['requester_login_id']; ?>">
                                        <button type="submit" class="btn btn-danger
                                        mr-3" name="delete" value="Delete">
                                        <i class="far fa-trash-alt"></i></button>
                                    </form>-->
                                    <form action="" class="d-inline" method="POST">
                                    <input type="hidden" name="id" value="<?php
                                    echo $row['requester_login_id']; ?>">
                                    <a class="btn btn-danger" data-toggle='modal' data-target="#mm<?php echo $row['requester_login_id']; ?>">
                                    <i class="far fa-trash-alt"></i></a>
                                    <div class="modal" id="mm<?php echo $row['requester_login_id']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <!-- Modal Header -->
                                               <div class="modal-header">
                                                 <h4 class="modal-title">Delete Confirmation !!!</h4>
                                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                  Are you sure you want to delete <b><?php echo $row['requester_name']; ?>? </b>
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
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
            <?php
        }
        else
        {
            echo "There is no user";
        }
        ?>
        <div class="float-right">
            <a href="insertrequest.php"
            class="btn btn-danger mt-3">
            <i class="fas fa-plus fa-2x"></i></a>
        </div>
</div>

<?php
    if(isset($_POST['delete']))
    {
        $sql = "DELETE FROM sign_up WHERE
                requester_login_id='".$_POST['id']."'";
            
        if(mysqli_query($conn,$sql))
        {
            ?>
            <meta http-equiv="refresh" content="0;URL=?deleted"/>
            <?php
        }
        else
        {
            $joy = '<div class="alert alert-success
                    col-sm-12 mt-3">Delete Failed
                    </div>';
        }
    }
?>

<?php
    include 'includefile/footer.php';
?>