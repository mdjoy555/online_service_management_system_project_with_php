<?php
    define('Title', 'Work Assign');
    define('Page', 'work');
    include '../connection.php';
    include 'includefile/header.php';
    session_start();
    if(isset($_SESSION['is_adminlogin']))
    {
        $aemail = $_SESSION['aEmail'];
    }
    else
    {
        header('Locaion: login.php');
    }
?>

<div class="col-sm-9 col-md-9 mt-5">
    <?php
        $sql = "SELECT * FROM assign_work";

        if(mysqli_query($conn,$sql))
        {
            $result = mysqli_query($conn,$sql);
        }
        if($result->num_rows!=0)
        {
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Req Id</th>                        
                        <th scope="col">Info</th>                        
                        <th scope="col">Name</th>                        
                        <th scope="col">Address 1</th>  
                        <th scop="col">Address 2</th>                     
                        <th scope="col">City</th>
                        <th scope="col">State</th>
                        <th scope="col">ZIP</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile Number</th>
                        <th scope="col">Request Date</th>                       
                        <th scope="col">Technician</th>                        
                        <th scope="col">Assign Date</th>                        
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row=mysqli_fetch_array($result))
                        {
                            ?>
                            <tr>
                                <td><?php echo $row['request_id'] ?></td>
                                <td><?php echo $row['request_info'] ?></td>
                                <td><?php echo $row['requester_name'] ?></td>
                                <td><?php echo $row['requester_address_1'] ?></td>
                                <td><?php echo $row['requester_address_2'] ?></td>
                                <td><?php echo $row['requester_city'] ?></td>
                                <td><?php echo $row['requester_state'] ?></td>
                                <td><?php echo $row['requester_zip'] ?></td>
                                <td><?php echo $row['requester_email'] ?></td>
                                <td><?php echo $row['requester_mobile_no'] ?></td>
                                <td><?php echo $row['request_date'] ?></td>
                                <td><?php echo $row['assign_technician'] ?></td>
                                <td><?php echo $row['assign_date'] ?></td>
                                <td>
                                    <form action="viewassignwork.php" method="POST"
                                    class="d-inline">
                                        <input type="hidden" name="id" value="<?php
                                        echo $row['request_id']; ?>">
                                        <button class="btn btn-warning" name="view"
                                        value="view" type="submit"><i class="far fa-eye">
                                        </i></button>
                                    </form>
                                    <!--<form action="" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<php
                                    echo $row['request_id']; ?>">
                                    <button class="btn btn-danger" name="delete"
                                    value="Delete" type="submit"><i
                                    class="far fa-trash-alt"></i></button>
                                    </form>-->
                                    <form action="" class="d-inline" method="POST">
                                    <input type="hidden" name="id" value="<?php
                                    echo $row['request_id']; ?>">
                                    <a class="btn btn-danger" data-toggle='modal' data-target="#mm<?php echo $row['request_id']; ?>">
                                    <i class="far fa-trash-alt"></i></a>
                                    <div class="modal" id="mm<?php echo $row['request_id']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <!-- Modal Header -->
                                               <div class="modal-header">
                                                 <h4 class="modal-title">Delete Confirmation !!!</h4>
                                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                  Are you sure you want to delete request id <b><?php echo $row['request_id']; ?>? </b>
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
            echo "There is no work order";
        }
        if(isset($_POST['delete']))
        {
            $sql = "DELETE FROM assign_work
                    WHERE request_id='".$_POST['id']."'";
            
            if(mysqli_query($conn,$sql))
            {
                ?>
                <meta http-equiv="refresh" content="0;URL=?deleted"/>
                <?php
            }
        }
    ?>
</div>

<?php
    include 'includefile/footer.php';
?>