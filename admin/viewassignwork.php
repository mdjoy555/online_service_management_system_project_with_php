<?php
    define('Title', 'View');
    define('Page' ,'View');
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

<div class="col-sm-6 mt-5 mx-3">
    <h3 class="text-center">Work Details</h3>
    <?php
        if(isset($_POST['view']))
        {
            $sql = "SELECT * FROM assign_work
                    WHERE request_id='".$_POST['id']."'";
            
            #$result = mysqli_query($conn,$sql);
            #$row = mysqli_fetch_array($result);
            $result = mysqli_fetch_array(mysqli_query($conn,$sql));
        }
    ?>
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
</div>

<?php
    include 'includefile/footer.php';
?>