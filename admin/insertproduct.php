<?php
    define('Title', 'Add Product');
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

    if(isset($_POST['productsubmit']))
    {
        if(empty($_POST['product_name'])
            || empty($_POST['product_dop'])
            || empty($_POST['product_available'])
            || empty($_POST['product_total'])
            || empty($_POST['product_cost'])
            || empty($_POST['product_selling_cost']))
        {
            $joy = '<div class="alert alert-warning
                    col-sm-12 mt-3">All Fields Are
                    Required</div>';
        }
        else
        {
            $pname = $_POST['product_name'];
            $pdop = $_POST['product_dop'];
            $pavail = $_POST['product_available'];
            $ptotal = $_POST['product_total'];
            $pcost = $_POST['product_cost'];
            $pscost = $_POST['product_selling_cost'];

            $sql = "INSERT INTO product(product_name,
                    product_dop,product_available,
                    product_total,product_cost,
                    product_selling_cost)
                    VALUES('".$pname."','".$pdop."',
                    '".$pavail."','".$ptotal."',
                    '".$pcost."','".$pscost."')";

            if(mysqli_query($conn,$sql))
            {
                $joy = '<div class="alert alert-success
                        col-sm-12 mt-3">Insert
                        Successfull</div>';
            }
            else
            {
                $joy = '<div class="alert alert-danger
                        col-sm-12 mt-3">Insert
                        Failed</div>';
            }
        }
    }
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add Product</h3>
    <form action="" method="POST">
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" class="form-control"
            id="product_name" name="product_name">
        </div>
        <div class="form-group">
            <label for="product_dop">Date of Purchase</label>
            <input type="date" class="form-control"
            id="product_dop" name="product_dop">
        </div>
        <div class="form-group">
            <label for="product_available">Product Available</label>
            <input type="text" class="form-control"
            id="product_available" name="product_available"
            onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group">
            <label for="product_total">Product Total</label>
            <input type="text" class="form-control"
            id="product_total" name="product_total"
            onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group">
            <label for="product_cost">Each Product Cost</label>
            <input type="text" class="form-control"
            id="product_cost" name="product_cost"
            onkeypress="isInputNumber(event)">
        </div>
        <div class="form-group">
            <label for="product_selling_cost">Each Product Selling Cost</label>
            <input type="text" class="form-control"
            id="product_selling_cost" name="product_selling_cost"
            onkeypress="isInputNumber(event)">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger"
            id="productsubmit" name="productsubmit">Submit
            </button>
            <a href="product.php" class="btn btn-secondary">
            Close</a>
        </div>
        <?php
            if(!empty($joy))
            {
                echo $joy;
            }
        ?>
    </form>
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