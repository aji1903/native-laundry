<?php
include "../koneksi.php";
if (isset($_POST['save'])) {
    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $customer_address = $_POST['customer_address'];

    $q_save = mysqli_query($connect, "INSERT INTO customers (customer_name, customer_phone, customer_address) VALUES('$customer_name','$customer_phone','$customer_address')");
    if ($q_save) {
        header("location: ?page=customer&add=success");
    }
}

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$q_edit = mysqli_query($connect, "SELECT * FROM customers WHERE id='$id'");
$rowedit = mysqli_fetch_assoc($q_edit);

if (isset($_POST['edit'])) {
    $id = $_GET['edit'];
    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $customer_address = $_POST['customer_address'];

    $update = mysqli_query($connect, "UPDATE customers SET customer_name='$customer_name', customer_phone='$customer_phone', customer_address='$customer_address'
    WHERE id='$id'");
    if ($update) {
        header("location:?page=customer&update=berhasil");
    }
}


?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-center ">
                <h3><?= isset($_GET['edit']) ? 'Edit' : 'Create' ?> Customer</h3>
            </div>
            <div class="card-body"></div>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="">Customer Name *</label>
                    <input name="customer_name" value="<?= isset($_GET['edit']) ? $rowedit['customer_name'] : '' ?>" class="form-control" type="text" require placeholder="Enter Customer Name">
                </div>
                <div class="mb-3">
                    <label for="">Customer Phone *</label>
                    <input name="customer_phone" value="<?= isset($_GET['edit']) ? $rowedit['customer_phone'] : '' ?>" class="form-control" type="number" require placeholder="Enter Customer Phone">
                </div>
                <div class="mb-3">
                    <label for="">Customer Address</label>
                    <input name="customer_address" value="<?= isset($_GET['edit']) ? $rowedit['customer_address'] : '' ?>" class="form-control" type="text" require placeholder="Enter Customer Address">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit" name="<?= isset($_GET['edit']) ? 'edit' : 'save' ?>">Save</button>
                </div>
            </form>


        </div>
    </div>
</div>