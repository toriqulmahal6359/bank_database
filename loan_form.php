<?php
include("inc/header.inc.php");

// echo "<pre>";
// print_r($_POST);
// die();

$loan_number = '';
$branch_name = '';
$amount = '';

if(isset($_GET['loan_number']) && ($_GET['loan_number'] != '')){
    $loan = mysqli_real_escape_string($con, $_GET['loan_number']);
    $query = "SELECT * FROM loan WHERE loan_number = '$loan'";
    $res = mysqli_query($con, $query);
    $unique = mysqli_num_rows($res);

    if($unique > 0){
        $rows = mysqli_fetch_array($res, MYSQLI_ASSOC);
        $loan_number = $rows['loan_number'];
        $branch_name = $rows['branch_name'];
        $amount = $rows['amount'];
    }else{
        header('Location:loan_form.php');
    }
}

if(isset($_POST['loan_submit'])){
    $loan_number = mysqli_real_escape_string($con, $_POST['loan_number']);
    $branch_name = mysqli_real_escape_string($con, $_POST['branch_name']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);

    $unq_query = "SELECT * FROM loan WHERE loan_number = '$loan_number'";
    $unq = mysqli_query($con, $unq_query);
    $check = mysqli_num_rows($unq);
    if($check > 0){
        if(isset($_GET['loan_number']) && ($_GET['loan_number'] != '')){
            $loan_update_query = "UPDATE loan SET loan_number='$loan_number', branch_name='$branch_name', amount='$amount' WHERE loan_number='$loan'";
            mysqli_query($con, $loan_update_query);
        }
        header('Location:loan_data.php');
        die();
    }else{
        $loan_insert_query = "INSERT INTO loan(loan_number, branch_name, amount) VALUES('$loan_number', '$branch_name', '$amount')";
        mysqli_query($con, $loan_insert_query);
            header('Location:loan_data.php');
            die();
    }
}
?>
    <section style="width: 50%">
        <span class="bank_status">Loan Form</span>
        <form method="post" class="bank_form">
            <input type="hidden" name="loan_number" value="<?php echo $loan_number?>"/>
            <table>
                <tr>
                    <td>Loan Number :</td>
                    <td><input type="text" name="loan_number" id="loan_number" value="<?php echo $loan_number?>"/></td>
                </tr>
                <tr>
                    <td>Branch Name :</td>
                    <td><input type="text" name="branch_name" id="branch_name" value="<?php echo $branch_name?>"/></td>
                </tr>
                <tr>
                    <td>Amount :</td>
                    <td><input type="number" name="amount" id="amount" value="<?php echo $amount?>"/></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td><input type="submit" name="loan_submit" value="Submit" id="bank_btn"/></td>
                </tr>
            </table>
        </form>
</section>

<?php
include('inc/footer.inc.php');
?>
