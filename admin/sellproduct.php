<?php
    define('Title', 'Sell Product');
    define('Page', 'product');
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

    if(isset($_POST['issue']))
    {
        $sql = "SELECT * FROM product
                WHERE product_id='".$_POST['id']."'";
            
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
            
    }
    if(isset($_POST['productsubmit']))
    {
        if(empty($_POST['customer_name'])
            || empty($_POST['customer_address'])
            || empty($_POST['product_name'])
            || empty($_POST['product_quantity'])
            || empty($_POST['product_selling_cost'])
            || empty($_POST['totalcost'])
            || empty($_POST['selldate']))
        {
            $joy = '<div class="alert alert-warning
                    col-sm-12 mt-3">
                    All Fields Are Required</div>';
        }
        else
        {
            $pid = $_POST['product_id'];
            $cname = $_POST['customer_name'];
            $caddress = $_POST['customer_address'];
            $pname = $_POST['product_name'];
            $pquantity = $_POST['product_quantity'];
            $pscost = $_POST['product_selling_cost'];
            $totalcost = $_POST['totalcost'];
            $selldate = $_POST['selldate'];
            $pavail = $_POST['product_available'];
            $pavail = $pavail - $pquantity;
            
            if($pavail>=0)
            {
                $str = "INSERT INTO customer(customer_name,
                        customer_address,customer_product_name,
                        customer_product_quantity,customer_product_each,
                        customer_product_total,customer_product_date)
                        VALUES('".$cname."','".$caddress."',
                        '".$pname."','".$pquantity."',
                        '".$pscost."','".$totalcost."',
                        '".$selldate."')";
                
                if(mysqli_query($conn,$str))
                {
                    $_SESSION['customerid'] = mysqli_insert_id($conn);
                    header('Location: productsellsuccess.php');
                    #$joy = '<div class="alert alert-success
                            #col-sm-12 mt-3">
                            #Sell Successfull</div>';
                }
            
                $sql = "UPDATE product SET
                        product_available='".$pavail."'
                        WHERE product_id='".$pid."'";
                mysqli_query($conn,$sql);
            }
            else
            {
                $joy = '<div class="alert alert-danger
                        col-sm-12 mt-3">
                        The number of product quantity
                        is not available</div>';
            }
        }
    }
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3>Customer Bill</h3>
    <form action="" method="POST">
        <div class="form-group">
            <label for="product_id">Product Id</label>
            <input type="text" class="form-control"
            name="product_id" id="product_id"
            value="<?php if(isset($row['product_id']))
            {echo $row['product_id'];} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="customer_name">Customer Name</label>
            <input type="text" class="form-control" id="customer_name"
            name="customer_name">
        </div>
        <div class="form-group">
            <label for="customer_address">Customer Address</label>
            <input type="text" class="form-control" id="customer_address"
            name="customer_address">
        </div>
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" class="form-control"
            name="product_name" id="product_name"
            value="<?php if(isset($row['product_name']))
            {echo $row['product_name'];} ?>">
        </div>
        <div class="form-group">
            <label for="product_available">Product Available</label>
            <input type="text" class="form-control"
            name="product_available" id="product_available"
            value="<?php if(isset($row['product_available']))
            {echo $row['product_available'];} ?>"
            onkeypress="isInputNumber(event)" readonly>
        </div>
        <div class="form-group">
            <label for="product_quantity">Quantity</label>
            <input type="text" class="form-control"
            id="product_quantity" name="product_quantity"
            onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group">
            <label for="product_selling_cost">Each Product Price</label>
            <input type="text" class="form-control"
            name="product_selling_cost" id="product_selling_cost"
            value="<?php if(isset($row['product_selling_cost']))
            {echo $row['product_selling_cost'];} ?>"
            onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group">
            <label for="totalcost">Total Price</label>
            <input type="text" class="form-control"
            id="totalcost" name="totalcost"
            onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group">
            <label for="inputDate">Date</label>
            <input type="date" calss="form-control"
            id="inputDate" name="selldate">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger"
            id="productsubmit" name="productsubmit">Submit</button>
            <a href="product.php" class="btn btn-secondary">
            Close</a>
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
        if(!(/[0-9]/.tesh(ch)))
        {
            joy.preventDefault();
        }
    }
</script>


<?php
    include 'includefile/footer.php';
?>