<?php
    define('Title','Contact Status');
    define('Page','Contact Status');
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
                    $str = "SELECT contact_id,c_email FROM contact
                            WHERE contact_id='".$_POST['checkid']."'
                            AND c_email='".$rEmail."'";
                
                    if(mysqli_query($conn,$str)->num_rows!=0)
                    {
                        $sql = "SELECT * FROM reply
                                WHERE contact_id='".$_POST['checkid']."'
                                AND contact_email='".$rEmail."'";

                        #$result = mysqli_query($conn,$sql);
                        #$row = mysqli_fetch_array($result);
                        
                        $result = mysqli_fetch_array(mysqli_query($conn,$sql));

                        if(isset($result['contact_id'])==(!empty($_POST['checkid'])))
                        {
                            ?>
                            <h3 class="text-center mt-4">Contact Reply Details</h3>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Contact Id</td>
                                        <td><?php if(isset($result['contact_id']))
                                        {echo $result['contact_id'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td><?php if(isset($result['contact_name']))
                                        {echo $result['contact_name'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Subject</td>
                                        <td><?php if(isset($result['contact_subject']))
                                        {echo $result['contact_subject'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php if(isset($result['contact_email']))
                                        {echo $result['contact_email'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td><?php if(isset($result['contact_description']))
                                        {echo $result['contact_description'];} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Contact Reply</td>
                                        <td><?php if(isset($result['contact_reply']))
                                        {echo $result['contact_reply'];} ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php
                        }
                        else
                        {
                            $joy = '<div class="alert alert-warning col-7 mt-3">
                                    Your contact request is pending</div>';
                        }
                    }
                    else
                    {
                        $joy = '<div class="alert alert-danger col-7 mt-3">
                                Your contact request id is wrong</div>';
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