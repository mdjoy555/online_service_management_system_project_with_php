<?php
    define('Title', 'Success');
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

<?php
$sql="SELECT * FROM submit WHERE
      request_id='".$_SESSION['mid']."'";
    if(mysqli_query($conn,$sql)->num_rows!=0)
    {
        $result=mysqli_fetch_array(mysqli_query($conn,$sql));
        ?>
        <div class='col-9 mt-5'>
        <table class='table table-bordered'>
         <tbody>
          <tr>
            <th>Request ID</th>
            <td><?php echo $result['request_id']; ?></td>
          </tr>
          <tr>
            <th>Info</th>
            <td><?php echo $result['request_info']; ?></td>
          </tr>
          <tr>
            <th>Description</th>
            <td><?php echo $result['request_description']; ?></td>
          </tr>
          <tr>
           <th>Name</th>
           <td><?php echo $result['requester_name']; ?></td>
          </tr>
          <tr>
           <th>Address 1</th>
           <td><?php echo $result['requester_address_1']; ?></td>
          </tr>
          <tr>
          <tr>
           <th>Address 2</th>
           <td><?php echo $result['requester_address_2']; ?></td>
          </tr>
          <tr>
          <tr>
           <th>City</th>
           <td><?php echo $result['requester_city']; ?></td>
          </tr>
          <tr>
          <tr>
           <th>State</th>
           <td><?php echo $result['requester_state']; ?></td>
          </tr>
          <tr>
          <tr>
           <th>ZIP Code</th>
           <td><?php echo $result['requester_zip']; ?></td>
          </tr>
          <tr>
          <tr>
           <th>Email</th>
           <td><?php echo $result['requester_email']; ?></td>
          </tr>
          <tr>
          <tr>
           <th>Mobile Number</th>
           <td><?php echo $result['requester_mobile_no']; ?></td>
          </tr>
          <tr>
          <tr>
           <th>Request Date</th>
           <td><?php echo $result['request_date']; ?></td>
          </tr>
         </tbody>
        </table>
        <div class="alert alert-warning"
                    role="alert">Your Request is Pending</div>
        <?php
    }
?>

<?php
    include 'includefile/footer.php';
?>