<?php
include('inc/header.inc.php');

$loan_query = "SELECT * FROM loan ORDER BY loan_number";
$res = mysqli_query($con, $loan_query);
$unique = mysqli_num_rows($res);

if(isset($_GET['type']) && $_GET['type'] != ''){
    $type = mysqli_real_escape_string($con, $_GET['type']);

    if($type == 'delete'){
        $loan_number = mysqli_real_escape_string($con, $_GET['loan_number']);
        $loan_del_query = "DELETE FROM loan WHERE loan_number = '$loan_number'";
        mysqli_query($con, $loan_del_query);
        header('Location:loan_data.php');
    }
}
?>
<section class="bank_section" width="100%">
    <table id="bank_data">
        <thead>
            <tr width="100px">
                <th width="15%">ID</th>
                <th width="15%">Loan Number</th>
                <th width="15%">Branch Name</th>
                <th width="15%">Amount</th>
                <th width="15%">Edit</th>
                <th width="15%">Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php if($unique > 0){ ?>
            <?php $i = 1; ?>
            <?php while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['loan_number']; ?></td>
                <td><?php echo $row['branch_name']; ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td><a href="loan_form.php?loan_number=<?php echo $row['loan_number']?>">Edit</a></td>
                <td><a href="?type=delete&loan_number=<?php echo $row['loan_number']; ?>">Delete</a></td>
            </tr>
            <?php $i++; ?>     
            <?php }
            } ?>
        </tbody>
    </table>
    <a href="loan_form.php">Add New</a>
</section>
<?php
include('inc/footer.inc.php');
?>