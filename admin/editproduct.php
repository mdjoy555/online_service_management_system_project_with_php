<?php
    define('Title', 'Update Product');
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
?>

<?php
    if(isset($_POST['edit']))
    {
        $sql = "SELECT * FROM product
                WHERE product_id='".$_POST['id']."'";
            
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
            
    }
    if(isset($_POST['productupdate']))
    {
        if(empty($_POST['product_name'])
            || empty($_POST['product_dop'])
            || empty($_POST['product_available'])
            || empty($_POST['product_total'])
            || empty($_POST['product_cost'])
            || empty($_POST['product_selling_cost']))
        {
            $joy = '<div class="alert alert-warning
                    col-sm-12 mt-3">
                    All Fields Are Required</div>';
        }
        else
        {
            $pid = $_POST['product_id'];
            $pname = $_POST['product_name'];
            $pdop = $_POST['product_dop'];
            $pavail = $_POST['product_available'];
            $ptotal = $_POST['product_total'];
            $pcost = $_POST['product_cost'];
            $pscost = $_POST['product_selling_cost'];

            $sql = "UPDATE product SET
                    product_name='".$pname."',
                    product_dop='".$pdop."',
                    product_available='".$pavail."',
                    product_total='".$ptotal."',
                    product_cost='".$pcost."',
                    product_selling_cost='".$pscost."'
                    WHERE product_id='".$pid."'";
                
            if(mysqli_query($conn,$sql))
            {
                $joy = '<div class="alert alert-success
                        col-sm-12 mt-3">
                        Update Successfull</div>';
            }
            else
            {
                $joy = '<div class="alert alert-danger
                        col-sm-12 mt-3">
                        Update Failed</div>';
            }
        }
    }
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3>Update Product</h3>
    <form action="" method="POST">
        <div class="form-group">
            <label for="product_id">Product Id</label>
            <input type="text" class="form-control"
            name="product_id" id="product_id"
            value="<?php if(isset($row['product_id']))
            {echo $row['product_id'];} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" class="form-control"
            name="product_name" id="product_name"
            value="<?php if(isset($row['product_name']))
            {echo $row['product_name'];} ?>">
        </div>
        <div class="form-group">
            <label for="product_dop">Product DOP</label>
            <input type="date" class="form-control"
            name="product_dop" id="product_dop"
            value="<?php if(isset($row['product_dop']))
            {echo $row['product_dop'];} ?>">
        </div>
        <div class="form-group">
            <label for="product_available">Product Available</label>
            <input type="text" class="form-control"
            name="product_available" id="product_available"
            value="<?php if(isset($row['product_available']))
            {echo $row['product_available'];} ?>"
            onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group">
            <label for="product_total">Product Total</label>
            <input type="text" class="form-control"
            name="product_total" id="product_total"
            value="<?php if(isset($row['product_total']))
            {echo $row['product_total'];} ?>"
            onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group">
            <label for="product_cost">Each Product Cost</label>
            <input type="text" class="form-control"
            name="product_cost" id="product_cost"
            value="<?php if(isset($row['product_cost']))
            {echo $row['product_cost'];} ?>"
            onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group">
            <label for="product_selling_cost">Each Product Selling Cost</label>
            <input type="text" class="form-control"
            name="product_selling_cost" id="product_selling_cost"
            value="<?php if(isset($row['product_selling_cost']))
            {echo $row['product_selling_cost'];} ?>"
            onkeypress="isInputNumber(event)">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger"
            id="productupdate" name="productupdate">Update</button>
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