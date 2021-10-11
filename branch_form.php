<?php
include("inc/header.inc.php");

// echo "<pre>";
// print_r($_POST);
// die();

$branch_name = '';
$branch_city = '';
$assets = '';

if(isset($_GET['branch_name']) && ($_GET['branch_name'] != '')){
    $name = mysqli_real_escape_string($con, $_GET['branch_name']);
    $query = "SELECT * FROM branch WHERE branch_name = '$name'";
    $res = mysqli_query($con, $query);
    $unique = mysqli_num_rows($res);

    if($unique > 0){
        $rows = mysqli_fetch_array($res, MYSQLI_ASSOC);
        $branch_name = $rows['branch_name'];
        $branch_city = $rows['branch_city'];
        $assets = $rows['assets'];
    }else{
        header('Location:branch_form.php');
    }
}

if(isset($_POST['branch_submit'])){
    $branch_name = mysqli_real_escape_string($con, $_POST['branch_name']);
    $branch_city = mysqli_real_escape_string($con, $_POST['branch_city']);
    $assets = mysqli_real_escape_string($con, $_POST['assets']);

    $unq_query = "SELECT * FROM branch WHERE branch_name = '$branch_name'";
    $unq = mysqli_query($con, $unq_query);
    $check = mysqli_num_rows($unq);
    if($check > 0){
        if(isset($_GET['branch_name']) && ($_GET['branch_name'] != '')){
            $branch_update_query = "UPDATE branch SET branch_name='$branch_name', branch_city='$branch_city', assets='$assets' WHERE branch_name='$name'";
            mysqli_query($con, $branch_update_query);
        }
        header('Location:branch_data.php');
        die();
    }else{
        $branch_insert_query = "INSERT INTO branch(branch_name, branch_city, assets) VALUES('$branch_name', '$branch_city', '$assets')";
        mysqli_query($con, $branch_insert_query);
            header('Location:branch_data.php');
            die();
    }
}
?>
    <section style="width: 50%">
        <span class="bank_status">Branch Form</span>
        <form method="post" class="bank_form">
            <input type="hidden" name="branch_name" value="<?php echo $branch_name?>"/>
            <table>
                <tr>
                    <td>Branch Name :</td>
                    <td><input type="text" name="branch_name" id="branch_name" value="<?php echo $branch_name?>"/></td>
                </tr>
                <tr>
                    <td>Branch City :</td>
                    <td><input type="text" name="branch_city" id="branch_city" value="<?php echo $branch_city?>"/></td>
                </tr>
                <tr>
                    <td>Assets :</td>
                    <td><input type="number" name="assets" id="assets" value="<?php echo $assets?>"/></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td><input type="submit" name="branch_submit" value="Submit" id="bank_btn"/></td>
                </tr>
            </table>
        </form>
</section>

<?php
include('inc/footer.inc.php');
?>
