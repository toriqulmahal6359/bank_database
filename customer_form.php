<?php
include("inc/header.inc.php");

// echo "<pre>";
// print_r($_POST);
// die();

$customer_name = '';
$customer_street = '';
$customer_city = '';

if(isset($_GET['customer_name']) && ($_GET['customer_name'] != '')){
    $name = mysqli_real_escape_string($con, $_GET['customer_name']);
    $query = "SELECT * FROM customer WHERE customer_name = '$name'";
    $res = mysqli_query($con, $query);
    $unique = mysqli_num_rows($res);

    if($unique > 0){
        $rows = mysqli_fetch_array($res, MYSQLI_ASSOC);
        $customer_name = $rows['customer_name'];
        $customer_street = $rows['customer_street'];
        $customer_city = $rows['customer_city'];
    }else{
        header('Location:customer_form.php');
    }
}

if(isset($_POST['customer_submit'])){
    $customer_name = mysqli_real_escape_string($con, $_POST['customer_name']);
    $customer_street = mysqli_real_escape_string($con, $_POST['customer_street']);
    $customer_city = mysqli_real_escape_string($con, $_POST['customer_city']);

    $unq_query = "SELECT * FROM customer WHERE customer_name = '$customer_name'";
    $unq = mysqli_query($con, $unq_query);
    $check = mysqli_num_rows($unq);
    if($check > 0){
        if(isset($_GET['customer_name']) && ($_GET['customer_name'] != '')){
            $customer_update_query = "UPDATE customer SET customer_name='$customer_name', customer_street='$customer_street', customer_city='$customer_city' WHERE customer_name='$name'";
            mysqli_query($con, $customer_update_query);
        }
        header('Location:customer_data.php');
        die();
    }else{
        $customer_insert_query = "INSERT INTO customer(customer_name, customer_street, customer_city) VALUES('$customer_name', '$customer_street', '$customer_city')";
        mysqli_query($con, $customer_insert_query);
            header('Location:customer_data.php');
            die();
    }
}
?>
    <section style="width: 50%">
        <span class="bank_status">Customer Form</span>
        <form method="post" class="bank_form">
            <input type="hidden" name="customer_name" value="<?php echo $customer_name?>"/>
            <table>
                <tr>
                    <td>Customer Name :</td>
                    <td><input type="text" name="customer_name" id="customer_name" value="<?php echo $customer_name?>"/></td>
                </tr>
                <tr>
                    <td>Customer Street :</td>
                    <td><input type="text" name="customer_street" id="customer_street" value="<?php echo $customer_street?>"/></td>
                </tr>
                <tr>
                    <td>Customer City :</td>
                    <td><input type="text" name="customer_city" id="customer_city" value="<?php echo $customer_city?>"/></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td><input type="submit" name="customer_submit" value="Submit" id="bank_btn"/></td>
                </tr>
            </table>
        </form>
</section>

<?php
include('inc/footer.inc.php');
?>
