<?php
include("inc/header.inc.php");

// echo "<pre>";
// print_r($_POST);
// die();

$account_number = '';
$branch_name = '';
$balance= '';

if(isset($_GET['account_number']) && ($_GET['account_number'] != '')){
    $account = mysqli_real_escape_string($con, $_GET['account_number']);
    $query = "SELECT * FROM account WHERE account_number = '$account'";
    $res = mysqli_query($con, $query);
    $unique = mysqli_num_rows($res);

    if($unique > 0){
        $rows = mysqli_fetch_array($res, MYSQLI_ASSOC);
        $account_number = $rows['account_number'];
        $branch_name = $rows['branch_name'];
        $balance = $rows['balance'];
    }else{
        header('Location:loan_form.php');
    }
}

if(isset($_POST['account_submit'])){
    $account_number = mysqli_real_escape_string($con, $_POST['account_number']);
    $branch_name = mysqli_real_escape_string($con, $_POST['branch_name']);
    $balance = mysqli_real_escape_string($con, $_POST['balance']);

    $unq_query = "SELECT * FROM account WHERE account_number = '$account_number'";
    $unq = mysqli_query($con, $unq_query);
    $check = mysqli_num_rows($unq);
    if($check > 0){
        if(isset($_GET['account_number']) && ($_GET['account_number'] != '')){
            $account_update_query = "UPDATE account SET account_number='$account_number', branch_name='$branch_name', balance='$balance' WHERE account_number='$account'";
            mysqli_query($con, $account_update_query);
        }
        header('Location:account_data.php');
        die();
    }else{
        $account_insert_query = "INSERT INTO account(account_number, branch_name, balance) VALUES('$account_number', '$branch_name', '$balance')";
        mysqli_query($con, $account_insert_query);
            header('Location:account_data.php');
            die();
    }
}
?>
    <section style="width: 50%">
        <span class="bank_status">Account Form</span>
        <form method="post" class="bank_form">
            <input type="hidden" name="account_number" value="<?php echo $account_number?>"/>
            <table>
                <tr>
                    <td>Account Number :</td>
                    <td><input type="text" name="account_number" id="account_number" value="<?php echo $account_number?>"/></td>
                </tr>
                <tr>
                    <td>Branch Name :</td>
                    <td><input type="text" name="branch_name" id="branch_name" value="<?php echo $branch_name?>"/></td>
                </tr>
                <tr>
                    <td>Balance :</td>
                    <td><input type="number" name="balance" id="balance" value="<?php echo $balance?>"/></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td><input type="submit" name="account_submit" value="Submit" id="bank_btn"/></td>
                </tr>
            </table>
        </form>
</section>

<?php
include('inc/footer.inc.php');
?>
