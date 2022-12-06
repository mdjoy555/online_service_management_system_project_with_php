<?php
    define('Title', 'Submit');
    define('Page', 'Submit');
    include '../connection.php';
    include 'includefile/header.php';
    
    session_start();
    
    if($_SESSION['is_login'])
    {
        $rEmail = $_SESSION['rEmail'];
    }
    else
    {
        header('Location: login.php');
    }

    $sql = "SELECT requester_name,requester_email FROM
            sign_up WHERE requester_email='".$rEmail."'";
    
    if(mysqli_query($conn,$sql)->num_rows!=0)
    {
        $row = mysqli_fetch_array(mysqli_query($conn,$sql));
        $rname = $row['requester_name'];
    }

    if(isset($_POST['submit']))
    {
        if(empty($_POST['requestinfo']) 
            || empty($_POST['requestdescription'])
            || empty($_POST['requesteraddress1'])
            || empty($_POST['requesteraddress2'])
            || empty($_POST['requestercity'])
            || empty($_POST['requesterstate'])
            || empty($_POST['requesterzip'])
            || empty($_POST['requestermobilenumber'])
            || empty($_POST['requestdate']))
        {
            $joy = '<div class="alert alert-warning
            ml-5 mt-2" role="alert">All Fields Are Required
            </div>';
        }
        else
        {
            $rinfo = $_POST['requestinfo'];
            $rdescription = $_POST['requestdescription'];
            $raddress1 = $_POST['requesteraddress1'];
            $raddress2 = $_POST['requesteraddress2'];
            $rcity = $_POST['requestercity'];
            $rstate = $_POST['requesterstate'];
            $rzip = $_POST['requesterzip'];
            $rmobileno = $_POST['requestermobilenumber'];
            $rdate = $_POST['requestdate'];

            $sql = "INSERT INTO submit(request_info,
                    request_description,requester_name,
                    requester_address_1,requester_address_2,
                    requester_city,requester_state,
                    requester_zip,requester_email,
                    requester_mobile_no,request_date)
                    VALUES('".$rinfo."','".$rdescription."',
                    '".$rname."','".$raddress1."',
                    '".$raddress2."','".$rcity."',
                    '".$rstate."','".$rzip."',
                    '".$rEmail."','".$rmobileno."',
                    '".$rdate."')";
            if(mysqli_query($conn,$sql))
            {
                $_SESSION['mid'] = mysqli_insert_id($conn);
                header('Location: submitsuccess.php');
                #$joy = '<div class="alert alert-success ml-5 mt-2"
                #        role="alert">Successfully Submitted</div>';
            }
            else
            {
                $joy = '<div class="alert alert-danger ml-5 mt-2"
                        role="alert">Submit Failed</div>';
            }
        }
    }
?>

<div class="col-sm-9 col-md-10 mt-5">
    <form class="mx-5" action="" method="POST">
        <div class="form-group">
            <label for="inputRequestInfo">Request Info</label>
            <input type="text" class="form-control"
            id="inputRequestInfo" placeholder="Request Info"
            name="requestinfo">
        </div>
        <div class="form-group">
            <label for="inputRequestDescription">Description</label>
            <input type="text" class="form-control"
            id="inputRequestDescription" placeholder="Write Description"
            name="requestdescription">
        </div>
        <div class="form-group">
            <label for="rname">Name</label>
            <input type="text" class="form-control"
            name="rname" id="rname"
            value="<?php echo $rname; ?>"
            readonly>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputAddress">Address Line 1</label>
                <input type="text" class="form-control" id="inputAddress"
                placeholder="House No." name="requesteraddress1">
            </div>
            <div class="form-group col-md-6">
                <label for="inputAddress2">Address Line 2</label>
                <input type="text" class="form-control" id="inputAddress2"
                placeholder="Road No." name="requesteraddress2">                
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity"
                name="requestercity">
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <input type="text" class="form-control" id="inputState"
                name="requesterstate">
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-contro" id="inputZip"
                name="requesterzip" onkeypress="isInputNumber(event)">
            </div>
        </div>
        <div class="form-group">
                <label for="rEmail">Email</label>
                <input type="email" class="form-control"
                name="rEmail" id="rEmail"
                value="<?php echo $rEmail; ?>"
                readonly>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputMobile">Mobile No.</label>
                <input type="text" class="form-control" id="inputMobile"
                name="requestermobilenumber" onkeypress="isInputNumber(event)">
            </div>
            <div class="form-group col-md-6">
                <label for="inputDate">Date</label>
                <input type="date" class="form-control" id="inputDate"
                name="requestdate">
            </div>
        </div>
        <button type="submit" class="btn btn-danger mb-3" name="submit">
                Submit</button>
        <button type="reset" class="btn btn-secondary mb-3">Reset</button>
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