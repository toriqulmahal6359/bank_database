<?php
include('inc/header.inc.php');

$account_query = "SELECT * FROM account ORDER BY account_number";
$res = mysqli_query($con, $account_query);
$unique = mysqli_num_rows($res);

if(isset($_GET['type']) && $_GET['type'] != ''){
    $type = mysqli_real_escape_string($con, $_GET['type']);

    if($type == 'delete'){
        $account_number = mysqli_real_escape_string($con, $_GET['account_number']);
        $account_del_query = "DELETE FROM account WHERE account_number = '$account_number'";
        mysqli_query($con, $account_del_query);
        header('Location:account_data.php');
    }
}
?>
<section class="bank_section" width="100%">
    <table id="bank_data">
        <thead>
            <tr width="100px">
                <th width="20%">ID</th>
                <th width="20%">Account Number</th>
                <th width="20%">Branch Name</th>
                <th width="20%">Balance</th>
                <th width="20%">Edit</th>
                <th width="20%">Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php if($unique > 0){ ?>
            <?php $i = 1; ?>
            <?php while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['account_number']; ?></td>
                <td><?php echo $row['branch_name']; ?></td>
                <td><?php echo $row['balance']; ?></td>
                <td><a href="account_form.php?account_number=<?php echo $row['account_number']?>">Edit</a></td>
                <td><a href="?type=delete&account_number=<?php echo $row['account_number']; ?>">Delete</a></td>
            </tr>
            <?php $i++; ?>     
            <?php }
            } ?>
        </tbody>
    </table>
    <a href="account_form.php">Add New</a>
</section>
<?php
include('inc/footer.inc.php');
?>