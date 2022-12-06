<?php
    define('Title', 'Dashboard');
    define('Page', 'dashboard');
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

    #$sql = "SELECT max(request_id) FROM submit";
    $sql = "SELECT * FROM submit";

    #$row = mysqli_fetch_array(mysqli_query($conn,$sql));
    #$submitrequest = $row[0];
    $submitrequest = mysqli_query($conn,$sql)->num_rows;

    #$sql = "SELECT max(r_number) FROM assign_work";
    $sql = "SELECT * FROM assign_work";

    #$row = mysqli_fetch_array(mysqli_query($conn,$sql));
    #$assignwork = $row[0];
    $assignwork = mysqli_query($conn,$sql)->num_rows;

    $sql = "SELECT * FROM technician";

    $technician = mysqli_query($conn,$sql)->num_rows;

    $sql = "SELECT * FROM sign_up";

    $user = mysqli_query($conn,$sql)->num_rows;

    $sql = "SELECT * FROM product";

    $product = mysqli_query($conn,$sql)->num_rows;

    $sql = "SELECT * FROM contact";

    $crequest = mysqli_query($conn,$sql)->num_rows;
?>

            <div class="col-sm-9 col-md-10">
                <div class="row text-center mx-5">
                    <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-danger mb-3"
                        style="max-width: 18rem;">
                            <div class="card-header">Request Received</div>
                            <div class="card-body">
                             <h4 class="card-title"><?php echo $submitrequest; ?></h4>
                             <a class="btn text-white" href="request.php">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-success mb-3"
                        style="max-width: 18rem;">
                            <div class="card-header">Assigned Work</div>
                            <div class="card-body">
                             <h4 class="card-title"><?php echo $assignwork; ?></h4>
                             <a class="btn text-white" href="work.php">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-info mb-3"
                        style="max-width: 18rem;">
                            <div class="card-header">Number of Technician</div>
                            <div class="card-body">
                             <h4 class="card-title"><?php echo $technician ?></h4>
                             <a class="btn text-white" href="technician.php">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-warning mb-3"
                        style="max-width: 18rem;">
                            <div class="card-header">Number of User</div>
                            <div class="card-body">
                             <h4 class="card-title"><?php echo $user ?></h4>
                             <a class="btn text-white" href="requester.php">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-primary mb-3"
                        style="max-width: 18rem;">
                            <div class="card-header">Number of Product</div>
                            <div class="card-body">
                             <h4 class="card-title"><?php echo $product ?></h4>
                             <a class="btn text-white" href="product.php">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-dark mb-3"
                        style="max-width: 18rem;">
                            <div class="card-header">Contact Request</div>
                            <div class="card-body">
                             <h4 class="card-title"><?php echo $crequest ?></h4>
                             <a class="btn text-white" href="contactrequest.php">View</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--div class="mx-5 mt-5 text-center">
                    <p class="bg-dark text-white p-1">List of Requester</p>
                    <php
                        $sql = "SELECT requester_login_id,
                                requester_name, requester_email
                                FROM sign_up";
                        
                        $result = mysqli_query($conn,$sql);
                        
                        if($result->num_rows!=0)
                        {
                            ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th  scope="col">Requester Id</th>
                                        <th scope="col">Name</th>
                                        <th scop="col">Email</th>                                    
                                    </tr>
                                </thead>
                                <tbody>
                                <php while($row=mysqli_fetch_array($result))
                                {
                                    ?>
                                    <tr>
                                    <td><php echo $row["requester_login_id"]; ?></td>
                                    <td><php echo $row["requester_name"]; ?></td>
                                    <td><php echo $row["requester_email"]; ?></td>
                                    </tr>
                                <php
                                }
                                ?>
                                </tbody>
                            </table>
                        <php
                        }
                        else
                        {
                            echo "There is no result";
                        }
                    ?>
                </div>
            </div-->

<?php
    include 'includefile/footer.php';
?>