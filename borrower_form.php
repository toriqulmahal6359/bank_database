<?php
include("inc/header.inc.php");

// echo "<pre>";
// print_r($_POST);
// die();

$customer_name = '';
$loan_number = '';

if(isset($_GET['customer_name']) && ($_GET['customer_name'] != '')){
    $name = mysqli_real_escape_string($con, $_GET['customer_name']);
    $query = "SELECT * FROM borrower WHERE customer_name = '$name'";
    $res = mysqli_query($con, $query);
    $unique = mysqli_num_rows($res);

    if($unique > 0){
        $rows = mysqli_fetch_array($res, MYSQLI_ASSOC);
        $customer_name = $rows['customer_name'];
        $loan_number = $rows['loan_number'];
    }else{
        header('Location:borrower_form.php');
    }
}

if(isset($_POST['borrower_submit'])){
    $customer_name = mysqli_real_escape_string($con, $_POST['customer_name']);
    $loan_number = mysqli_real_escape_string($con, $_POST['loan_number']);

    $unq_query = "SELECT * FROM borrower WHERE customer_name = '$customer_name'";
    $unq = mysqli_query($con, $unq_query);
    $check = mysqli_num_rows($unq);
    if($check > 0){
        if(isset($_GET['customer_name']) && ($_GET['customer_name'] != '')){
            $borrower_update_query = "UPDATE borrower SET customer_name='$customer_name', loan_number='$loan_number' WHERE customer_name='$name'";
            mysqli_query($con, $borrower_update_query);
        }
        header('Location:borrower_data.php');
        die();
    }else{
        $borrower_insert_query = "INSERT INTO borrower(customer_name, loan_number) VALUES('$customer_name', '$loan_number')";
        mysqli_query($con, $borrower_insert_query);
            header('Location:borrower_data.php');
            die();
    }
}
?>
    <section style="width: 50%">
        <span class="bank_status">Borrower Form</span>
        <form method="post" class="bank_form">
            <input type="hidden" name="customer_name" value="<?php echo $customer_name?>"/>
            <table>
                <tr>
                    <td>Customer Name :</td>
                    <td><input type="text" name="customer_name" id="customer_name" value="<?php echo $customer_name?>"/></td>
                </tr>
                <tr>
                    <td>Loan Number :</td>
                    <td><input type="text" name="loan_number" id="loan_number" value="<?php echo $loan_number?>"/></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td><input type="submit" name="borrower_submit" value="Submit" id="bank_btn"/></td>
                </tr>
            </table>
        </form>
</section>

<?php
include('inc/footer.inc.php');
?>
