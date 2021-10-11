<?php
include("inc/header.inc.php");

// echo "<pre>";
// print_r($_POST);
// die();

$customer_name = '';
$account_number = '';

if(isset($_GET['customer_name']) && ($_GET['customer_name'] != '')){
    $name = mysqli_real_escape_string($con, $_GET['customer_name']);
    $query = "SELECT * FROM depositor WHERE customer_name = '$name'";
    $res = mysqli_query($con, $query);
    $unique = mysqli_num_rows($res);

    if($unique > 0){
        $rows = mysqli_fetch_array($res, MYSQLI_ASSOC);
        $customer_name = $rows['customer_name'];
        $account_number = $rows['account_number'];
    }else{
        header('Location:depositor_form.php');
    }
}

if(isset($_POST['depositor_submit'])){
    $customer_name = mysqli_real_escape_string($con, $_POST['customer_name']);
    $account_number = mysqli_real_escape_string($con, $_POST['account_number']);

    $unq_query = "SELECT * FROM depositor WHERE customer_name = '$customer_name'";
    $unq = mysqli_query($con, $unq_query);
    $check = mysqli_num_rows($unq);
    if($check > 0){
        if(isset($_GET['customer_name']) && ($_GET['customer_name'] != '')){
            $depositor_update_query = "UPDATE depositor SET customer_name='$customer_name', account_number='$account_number' WHERE customer_name='$name'";
            mysqli_query($con, $depositor_update_query);
        }
        header('Location:depositor_data.php');
        die();
    }else{
        $depositor_insert_query = "INSERT INTO depositor(customer_name, account_number) VALUES('$customer_name', '$account_number')";
        mysqli_query($con, $depositor_insert_query);
            header('Location:depositor_data.php');
            die();
    }
}
?>
    <section style="width: 50%">
        <span class="bank_status">Depositor Form</span>
        <form method="post" class="bank_form">
            <input type="hidden" name="customer_name" value="<?php echo $customer_name?>"/>
            <table>
                <tr>
                    <td>Customer Name :</td>
                    <td><input type="text" name="customer_name" id="customer_name" value="<?php echo $customer_name?>"/></td>
                </tr>
                <tr>
                    <td>Account Number :</td>
                    <td><input type="text" name="account_number" id="account_number" value="<?php echo $account_number?>"/></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td><input type="submit" name="depositor_submit" value="Submit" id="bank_btn"/></td>
                </tr>
            </table>
        </form>
</section>

<?php
include('inc/footer.inc.php');
?>
