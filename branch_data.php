<?php
include('inc/header.inc.php');

$branch_query = "SELECT * FROM branch ORDER BY branch_name";
$res = mysqli_query($con, $branch_query);
$unique = mysqli_num_rows($res);

if(isset($_GET['type']) && $_GET['type'] != ''){
    $type = mysqli_real_escape_string($con, $_GET['type']);

    if($type == 'delete'){
        $branch_name = mysqli_real_escape_string($con, $_GET['branch_name']);
        $branch_del_query = "DELETE FROM branch WHERE branch_name = '$branch_name'";
        mysqli_query($con, $branch_del_query);
        header('Location:branch_data.php');
    }
}
?>
<section class="bank_section" width="100%">
    <table id="bank_data">
        <thead>
            <tr width="100px">
                <th width="15%">ID</th>
                <th width="15%">Branch Name</th>
                <th width="15%">Branch City</th>
                <th width="15%">Assets</th>
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
                <td><?php echo $row['branch_name']; ?></td>
                <td><?php echo $row['branch_city']; ?></td>
                <td><?php echo $row['assets']; ?></td>
                <td><a href="branch_form.php?branch_name=<?php echo $row['branch_name']?>">Edit</a></td>
                <td><a href="?type=delete&branch_name=<?php echo $row['branch_name']; ?>">Delete</a></td>
            </tr>
            <?php $i++; ?>     
            <?php }
            } ?>
        </tbody>
    </table>
    <a href="branch_form.php">Add New</a>
</section>
<?php
include('inc/footer.inc.php');
?>