<?php
    define('Title', 'Request');
    define('Page', 'request');
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

<div class="col-sm-4 mb-5">
    <?php
        $sql = "SELECT request_id, request_info,
                request_description, request_date
                FROM submit";
        
        $result = mysqli_query($conn,$sql);

        if($result->num_rows!=0)
        {
            while($row=mysqli_fetch_array($result))
            {
                ?>
                <div class="card mt-5 mx-5">
                    <div class="card-header">
                        Request ID:
                        <?php echo $row['request_id']; ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Request Info:
                        <?php echo $row['request_info']; ?></h5>
                        <p class="card-text">
                        <?php echo $row['request_description']; ?>
                        </p>
                        <p class="card-text">Request Date:
                        <?php echo $row['request_date']; ?>
                        </p>
                        <form action="" method="POST">
                            <input type="hidden" name="id"
                            value="<?php echo $row['request_id']; ?>">
                            <input type="submit" class="btn btn-secondary mr-3"
                            name="view" value="View">
                            <!--<input type="submit" class="btn btn-secondary"
                            name="close" value="Close">-->
                        </form>
                        <form action="" class="d-inline" method="POST">
                                    <input type="hidden" name="id" value="<?php
                                    echo $row['request_id']; ?>">
                                    <a class="btn btn-danger" data-toggle='modal' data-target="#mm<?php echo $row['request_id']; ?>">
                                    Close</a>
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
                    </div>
                </div>
                <?php
            }
        }
    ?>
</div>

<?php
    if(isset($_POST['view']))
    {
        $sql = "SELECT * FROM submit WHERE request_id='".$_POST['id']."'";
        
        if(mysqli_query($conn,$sql))
        {
            $row = mysqli_fetch_array(mysqli_query($conn,$sql));
        }
    }

    if(isset($_POST['delete']))
    {
        $sql = "DELETE FROM submit WHERE request_id='".$_POST['id']."'";

        if(mysqli_query($conn,$sql))
        {
            echo '<meta http-equiv="refresh" content="0;URL=?closed"/>';
        }
    }

    if(isset($_POST['assign']))
    {
        if(empty($_REQUEST['request_id'])
            || empty($_REQUEST['request_info'])
            || empty($_REQUEST['requestdescription'])
            || empty($_REQUEST['requestername'])
            || empty($_REQUEST['address1'])
            || empty($_REQUEST['address2'])
            || empty($_REQUEST['requestercity'])
            || empty($_REQUEST['requesterstate'])
            || empty($_REQUEST['requesterzip'])
            || empty($_REQUEST['requesteremail'])
            || empty($_REQUEST['requestermobile'])
            || empty($_REQUEST['requestdate'])
            ||empty($_POST['assigntechnician'])
            || empty($_POST['inputDate']))
        {
            
            $joy = '<div class="alert alert-warning
                    col-sm-5">All Fields Are
                    Required</div>';
        }
        else
        {
            $rid = $_REQUEST['request_id'];
            $rinfo = $_REQUEST['request_info'];
            $rdescription = $_REQUEST['requestdescription'];
            $rname = $_REQUEST['requestername'];
            $raddress1 = $_REQUEST['address1'];
            $raddress2 = $_REQUEST['address2'];
            $rcity = $_REQUEST['requestercity'];
            $rstate = $_REQUEST['requesterstate'];
            $rzip = $_REQUEST['requesterzip'];
            $remail = $_REQUEST['requesteremail'];
            $rmobile = $_REQUEST['requestermobile'];
            $rdate = $_REQUEST['requestdate'];
            $rassign = $_POST['assigntechnician'];
            $radate = $_POST['inputDate'];

            #echo $rid;
            #echo "<br>";
            #echo $rinfo;
            #echo "<br>";
            #echo $rdescription;
            #echo "<br>";
            #echo $rname;
            #echo "<br>";
            #echo $raddress1;
            #echo "<br>";
            #echo $raddress2;
            #echo "<br>";
            #echo $rcity;
            #echo "<br>";
            #echo $rstate;
            #echo "<br>";
            #echo $rzip;
            #echo "<br>";
            #echo $remail;
            #echo "<br>";
            #echo $rmobile;
            #echo "<br>";
            #echo $rdate;
            #echo "<br>";
            #echo $rassign;
            #echo "<br>";
            #echo $radate;
            #echo "<br>";

            $sql = "SELECT request_id FROM assign_work
                    WHERE request_id='".$rid."'";
            if(mysqli_query($conn,$sql)->num_rows!=0)
            {
                $joy = '<div class="alert alert-warning
                        col-sm-5">Already Assigned</div>';
            }
            else
            {
                $sql = "INSERT INTO assign_work(request_id,
                        request_info,request_description,
                        requester_name,requester_address_1,
                        requester_address_2,requester_city,
                        requester_state,requester_zip,
                        requester_email,requester_mobile_no,
                        request_date,assign_technician,
                        assign_date)
                        VALUES('".$rid."','".$rinfo."',
                        '".$rdescription."','".$rname."',
                        '".$raddress1."','".$raddress2."',
                        '".$rcity."','".$rstate."',
                        '".$rzip."','".$remail."',
                        '".$rmobile."','".$rdate."',
                        '".$rassign."','".$radate."')";
        
                if(mysqli_query($conn,$sql))
                {
                    $joy = '<div class="alert alert-success                        
                            col-sm-5">Assigned Successfully
                            </div>';
                }
                else
                {
                    $joy = '<div class="alert alert-danger
                            col-sm-5">Assign Failed</div>';
                }
            }
        }
    }
?>

<div class="col-sm-5 mt-5 jumbotron">
    <form action="" method="POST">
        <h5 class="text-center">Work Order Request</h5>
        <div class="form-group">
            <label for="request_id">Request ID</label>
            <input type="text" class="form-control" id="request_id"
            name="request_id" value="<?php if(isset($row['request_id']))
            {echo $row['request_id'];} ?>"
            readonly>
        </div>
        <div class="form-group">
            <label for="request_info">Request Info</label>
            <input type="text" class="form-control"
            id="request_info" name="request_info"
            value="<?php if(isset($row['request_info']))
            {echo $row['request_info'];} ?>"
            readonly>
        </div>
        <div class="form-group">
            <label for="requestdescription">Description</label>
            <input type="text" class="form-control" id="requestdescription"
            name="requestdescription"
            value="<?php if(isset($row['request_description']))
            {echo $row['request_description'];} ?>"
            readonly>
        </div>
        <div class="form-group">
            <label for="requestername">Name</label>
            <input type="text" class="form-control" id="requestername"
            name="requestername"
            value="<?php if(isset($row['requester_name']))
            {echo $row['requester_name'];} ?>"
            readonly>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="address1">Address Line 1</label>
                <input type="text" class="form-control" id="address1"
                name="address1"
                value="<?php if(isset($row['requester_address_1']))
            {echo $row['requester_address_1'];} ?>"
            readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="address2">Address Line 2</label>
                <input type="text" class="form-control" id="address2"
                name="address2"
                value="<?php if(isset($row['requester_address_2']))
            {echo $row['requester_address_2'];} ?>"
            readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="requestercity">City</label>
                <input type="text" class="form-control"
                id="requestercity" name="requestercity"
                value="<?php if(isset($row['requester_city']))
            {echo $row['requester_city'];} ?>"
            readonly>
            </div>
            <div class="form-group col-md-4">
                <label for="requesterstate">State</label>
                <input type="text" class="form-control"
                id="requesterstate" name="requesterstate"
                value="<?php if(isset($row['requester_state']))
            {echo $row['requester_state'];} ?>"
            readonly>
            </div>
            <div class="form-group col-md-4">
                <label for="requesterzip">ZIP</label>
                <input type="text" class="form-control"
                id="requesterzip" name="requesterzip"
                onkeypress="isInputNumber(event)"
                value="<?php if(isset($row['requester_zip']))
                {echo $row['requester_zip'];} ?>"
                readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="requesteremail">Email</label>
            <input type="email" class="form-control"
            id="requesteremail" name="requesteremail"
            value="<?php if(isset($row['requester_email']))
            {echo $row['requester_email'];} ?>"
            readonly>
        </div>
        <div class="form-group">
            <label for="requestermobile">Mobile</label>
            <input type="text" class="form-control"
            id="requestermobile" name="requestermobile"
            onkeypress="isInputNumber(event)"
            value="<?php if(isset($row['requester_mobile_no']))
            {echo $row['requester_mobile_no'];} ?>"
            readonly>
        </div>
        <div class="form-group">
                <label for="requestdate">Date</label>
                <input type="date" class="form-control" id="requestdate"
                name="requestdate"
                value="<?php if(isset($row['request_date']))
                {echo $row['request_date'];} ?>"
                readonly>
            </div>
        <!--div class="form-group">
            <label for="assigntechnician">Assign Technician</label>
            <input type="text" class="form-control" id="assigntechnician"
            name="assigntechnician">
        </div-->
        <div class="form-group">
            <label for="assigntechnician">Assign Technician</label>
            <select class="form-control" name="assigntechnician" id="assigntechnician">
                <option></option>
                <?php
                    $sql = "SELECT * FROM technician";
                    $result = mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_array($result))
                    {
                        ?>
                            <option>
                                <?php
                                    if(isset($row['technician_name']))
                                    {
                                        echo $row['technician_name'];
                                    }
                                ?>
                            </option>
                        <?php
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="inputDate">Date</label>
            <input type="date" class="form-control" id="inputDate"
            name="inputDate">
        </div>
        <div class="float-right">
            <button type="submit" class="btn btn-success"
            name="assign">Assign</button>
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