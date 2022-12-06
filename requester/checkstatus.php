<?php
    define('Title', 'Check Status');
    define('Page', 'Check Status');
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
?>

<div class="col-9 mt-5">
    <form action="" method="POST" class="form-inline">
        <div class="form-group">
            <label for="checkid" class="mr-2">Enter Id:</label>
            <input type="text" class="form-control mr-2"
            name="checkid" id="checkid"
            onkeypress="isInputNumber(event)">
        </div>
        <button type="submit" class="btn btn-danger"
        name="search">Search</button>
    </form>
    <?php
        if(isset($_POST['search']))
        {
            if(empty($_POST['checkid']))
            {
                $joy = '<div class="alert alert-warning col-7 mt-3">
                        Fill the field</div>';
            }
            else
            {   
                    $str = "SELECT request_id,requester_email FROM submit
                            WHERE request_id='".$_POST['checkid']."'
                            AND requester_email='".$rEmail."'";
                
                    if(mysqli_query($conn,$str)->num_rows!=0)
                    {
                        $sql = "SELECT * FROM assign_work
                                WHERE request_id='".$_POST['checkid']."'
                                AND requester_email='".$rEmail."'";
                        #$result = mysqli_query($conn,$sql);
                        #$row = mysqli_fetch_array($result);
                        $result = mysqli_fetch_array(mysqli_query($conn,$sql));
                
                        if(isset($result['request_id'])==(!empty($_POST['checkid'])))
                        {
                            ?>
                            <h3 class="text-center mt-4">Assigned Work Details</h3>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Request Id</td>
                                        <td><?php if(isset($result['request_id']))
                                        {echo $result['request_id'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Request Info</td>
                                        <td><?php if(isset($result['request_info']))
                                        {echo $result['request_info'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Request Description</td>
                                        <td><?php if(isset($result['request_description']))
                                        {echo $result['request_description'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td><?php if(isset($result['requester_name']))
                                        {echo $result['requester_name'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Address1</td>
                                        <td><?php if(isset($result['requester_address_1']))
                                        {echo $result['requester_address_1'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Address2</td>
                                        <td><?php if(isset($result['requester_address_2']))
                                        {echo $result['requester_address_2'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td><?php if(isset($result['requester_city']))
                                        {echo $result['requester_city'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td><?php if(isset($result['requester_state']))
                                        {echo $result['requester_state'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>ZIP</td>
                                        <td><?php if(isset($result['requester_zip']))
                                        {echo $result['requester_zip'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php if(isset($result['requester_email']))
                                        {echo $result['requester_email'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mobile No</td>
                                        <td><?php if(isset($result['requester_mobile_no']))
                                        {echo $result['requester_mobile_no'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Request Date</td>
                                        <td><?php if(isset($result['request_date']))
                                        {echo $result['request_date'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Assign Technician</td>
                                        <td><?php if(isset($result['assign_technician']))
                                        {echo $result['assign_technician'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Assign Date</td>
                                        <td><?php if(isset($result['assign_date']))
                                        {echo $result['assign_date'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Technician Sign</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Customer Sign</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php
                        }
                        else
                        {
                            $joy = '<div class="alert alert-warning col-7 mt-3">
                                    Your request is pending</div>';
                        }
                    }
                    else
                    {
                        $joy = '<div class="alert alert-danger col-7 mt-3">
                                Your request id is wrong</div>';
                    }
                   
            }
        }
        
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