<?php
include "../koneksi.php";
if (isset($_POST['save'])) {
    $service_name = $_POST['service_name'];
    $service_price = $_POST['service_price'];
    $service_desc = $_POST['service_desc'];

    $q_save = mysqli_query($connect, "INSERT INTO services (service_name, service_price, service_desc) VALUES('$service_name','$service_price','$service_desc')");
    if ($q_save) {
        header("location: ?page=service&add=success");
    }
}

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$q_edit = mysqli_query($connect, "SELECT * FROM services WHERE id='$id'");
$rowedit = mysqli_fetch_assoc($q_edit);

if (isset($_POST['edit'])) {
    $id = $_GET['edit'];
    $service_name = $_POST['service_name'];
    $service_price = $_POST['service_price'];
    $service_desc = $_POST['service_desc'];

    $update = mysqli_query($connect, "UPDATE services SET service_name='$service_name', service_price='$service_price', service_desc='$service_desc'
    WHERE id='$id'");
    if ($update) {
        header("location:?page=service&update=berhasil");
    }
}


?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-center ">
                <h3><?= isset($_GET['edit']) ? 'Edit' : 'Create' ?> Service</h3>
            </div>
            <div class="card-body"></div>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="">Service Name *</label>
                    <input name="service_name" value="<?= isset($_GET['edit']) ? $rowedit['service_name'] : '' ?>" class="form-control" type="text" require placeholder="Enter service Name">
                </div>
                <div class="mb-3">
                    <label for="">Service price *</label>
                    <input name="service_price" value="<?= isset($_GET['edit']) ? $rowedit['service_price'] : '' ?>" class="form-control" type="number" require placeholder="Enter service price">
                </div>
                <div class="mb-3">
                    <label for="">Service desc</label>
                    <input name="service_desc" value="<?= isset($_GET['edit']) ? $rowedit['service_desc'] : '' ?>" class="form-control" type="text" require placeholder="Enter service desc">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit" name="<?= isset($_GET['edit']) ? 'edit' : 'save' ?>">Save</button>
                </div>
            </form>


        </div>
    </div>
</div>