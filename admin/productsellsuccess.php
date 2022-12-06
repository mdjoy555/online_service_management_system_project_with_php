<?php
    session_start();
    define('Title', 'Success');
    include '../connection.php';
    include 'includefile/header.php';
    
    if(isset($_SESSION['is_adminlogin']))
    {
        $aemail = $_SESSION['aEmail'];
    }
    else
    {
        header('Location: login.php');
    }

    $sql = "SELECT * FROM customer WHERE
            customer_id='".$_SESSION['customerid']."'";
    
    if(mysqli_query($conn,$sql)->num_rows!=0)
    {
        $row = mysqli_fetch_array(mysqli_query($conn,$sql));
        ?>
        <div class="ml-5 mt-5">
            <h3 class="text-center mb-3">Customer Bill</h3>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Customer Id</th>
                        <td><?php echo $row['customer_id'] ?></td>
                    </tr>
                    <tr>
                        <th>Customer Name</th>
                        <td><?php echo $row['customer_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Customer Address</th>
                        <td><?php echo $row['customer_address'] ?></td>
                    </tr>
                    <tr>
                        <th>Product Name</th>
                        <td><?php echo $row['customer_product_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Product Quantity</th>
                        <td><?php echo $row['customer_product_quantity'] ?></td>
                    </tr>
                    <tr>
                        <th>Each Product Price</th>
                        <td><?php echo $row['customer_product_each'] ?></td>
                    </tr>
                    <tr>
                        <th>Total Price</th>
                        <td><?php echo $row['customer_product_total'] ?></td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td><?php echo $row['customer_product_date'] ?></td>
                    </tr>
                </tbody>
            </table>
            <a href="product.php" class="btn btn-secondary">Close</a>
        </div>
        <?php
    }
?>

<?php
    include 'includefile/footer.php';
?>