<?php
include('inc/header.inc.php');

$depositor_query = "SELECT * FROM depositor ORDER BY customer_name";
$res = mysqli_query($con, $depositor_query);
$unique = mysqli_num_rows($res);

if(isset($_GET['type']) && $_GET['type'] != ''){
    $type = mysqli_real_escape_string($con, $_GET['type']);

    if($type == 'delete'){
        $customer_name = mysqli_real_escape_string($con, $_GET['customer_name']);
        $depositor_del_query = "DELETE FROM depositor WHERE customer_name = '$customer_name'";
        mysqli_query($con, $depositor_del_query);
        header('Location:depositor_data.php');
    }
}
?>
<section class="bank_section" width="100%">
    <table id="bank_data">
        <thead>
            <tr width="100px">
                <th width="15%">ID</th>
                <th width="15%">Customer Name</th>
                <th width="15%">Account Number</th>
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
                <td><?php echo $row['customer_name']; ?></td>
                <td><?php echo $row['account_number']; ?></td>
                <td><a href="depositor_form.php?customer_name=<?php echo $row['customer_name']?>">Edit</a></td>
                <td><a href="?type=delete&customer_name=<?php echo $row['customer_name']; ?>">Delete</a></td>
            </tr>
            <?php $i++; ?>     
            <?php }
            } ?>
        </tbody>
    </table>
    <a href="depositor_form.php">Add New</a>
</section>
<?php
include('inc/footer.inc.php');
?>