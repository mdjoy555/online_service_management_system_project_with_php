<?php
    define('Title', 'Sells Report');
    define('Page', 'sellreport');
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

<div class="col-sm-9 col-md-9 mt-5 text-center">
    <form action="" method="POST">
        <div class="form-row">
            <div class="form-group col-md-4">
                <input type="date" class="form-control"
                id="startdate" name="startdate">
            </div><span>to</span>
            <div class="form-group col-md-4">
                <input type="date" class="form-control"
                id="enddate" name="enddate">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-secondary"
                name="searchsubmit" value="Search">
            </div>
        </div>
    </form>
    <?php
        if(isset($_POST['searchsubmit']))
        {
            if(empty($_POST['startdate'])
                || empty($_POST['enddate']))
            {
                echo '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">
                Fill the date</div>';
            }
            else
            {
                $sdate = $_POST['startdate'];
                $edate = $_POST['enddate'];

                $sql = "SELECT * FROM customer WHERE
                        customer_product_date BETWEEN
                        '".$sdate."' AND '".$edate."'";
            
                if(mysqli_query($conn,$sql)->num_rows!=0)
                {
                    $result = mysqli_query($conn,$sql);
                    ?>
                    <p class="bg-dark text-white p-2 mt-4">Details</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Customer Id</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Address</th>
                                <th scope="col">Product Name</th>      
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Each Product Price</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row=mysqli_fetch_array($result))
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['customer_id']; ?></td>
                                            <td><?php echo $row['customer_name']; ?></td>
                                            <td><?php echo $row['customer_address']; ?></td>
                                            <td><?php echo $row['customer_product_name']; ?></td>
                                            <td><?php echo $row['customer_product_quantity']; ?></td>
                                            <td><?php echo $row['customer_product_each']; ?></td>
                                            <td><?php echo $row['customer_product_total']; ?></td>
                                            <td><?php echo $row['customer_product_date']; ?></td>
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
                    echo '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">
                    No Records Found</div>';
                }
            }
        }
    ?>
</div>

<?php
    include 'includefile/footer.php';
?>