<?php
include "../koneksi.php";
if (isset($_POST['save'])) {
    $nama = $_POST['nama'];
    $id_level = $_POST['id_level'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    $q_save = mysqli_query($connect, "INSERT INTO users (id_level, nama, email, password) VALUES('$id_level', '$nama','$email','$password')");
    if ($q_save) {
        header("location: ?page=user&add=success");
    }
}

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$q_edit = mysqli_query($connect, "SELECT * FROM users WHERE id='$id'");
$rowedit = mysqli_fetch_assoc($q_edit);

if (isset($_POST['edit'])) {
    $id = $_GET['edit'];
    $nama = $_POST['nama'];
    $id_level = $_POST['id_level'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    if ($_POST['password']) {
        $password = sha1($_POST['password']);
    } else {
        $password = $rowedit['password'];
    }

    $update = mysqli_query($connect, "UPDATE users SET id_level='$id_level', nama='$nama', email='$email', password='$password'
    WHERE id='$id'");
    if ($update) {
        header("location:?page=user&update=berhasil");
    }
}
$querycustomer = mysqli_query($connect, "SELECT * FROM customers ORDER BY id DESC");
$row = mysqli_fetch_all($querycustomer, MYSQLI_ASSOC);

// IDTR032125001
$querytrans = mysqli_query($connect, "SELECT max(id) as id_trans FROM trans_order");
$rowtrans = mysqli_fetch_assoc($querytrans);
$id_trans = $rowtrans['id_trans'];
$id_trans++;

$transaction_code = "IDTR" . date("mdy") . sprintf("%04s", $id_trans);

$queryservice = mysqli_query($connect, "SELECT * FROM services ORDER BY id DESC");
$rowservices = mysqli_fetch_all($queryservice, MYSQLI_ASSOC);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-center ">
                <h3><?= isset($_GET['edit']) ? 'Edit' : 'Create' ?> Transaction Order</h3>
            </div>
            <div class="card-body mt-3"></div>
            <form action="" method="post">
                <input type="hidden" id="service_price">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="">Transaction Code</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" value="<?= $transaction_code ?>" name="trans_code" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="">Order Date</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" name="order_date">
                            </div>

                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="">Service Name</label>
                            </div>
                            <div class="col-sm-5">
                                <select type="date" class="form-control" name="" id="id_service">
                                    <option value="">Choose Service</option>
                                    <?php foreach ($rowservices as $rowservice) : ?>
                                        <option value="<?= $rowservice['id'] ?>"><?= $rowservice['service_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="">Customer Name</label>
                            </div>
                            <div class="col-sm-5">
                                <select type="text" class="form-control" name="id_customer" readonly>
                                    <option value="">Choose Customer</option>
                                    <?php foreach ($row as $rows): ?>

                                        <option value="<?= $rows['id'] ?>"><?= $rows['customer_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="">Pickup Date</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" name="order_end_date">
                            </div>

                        </div>

                    </div>


                </div>
                <div class="row mt-5">
                    <div class="col-sm-12">
                        <div align="right" class="mb-3">
                            <button type="button" class="btn btn-success btn-sm add-row">Add Row</button>
                        </div>
                        <table class="table table-bordered table-order" id="add-table">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Price</th>

                                    <th>Qty</th>
                                    <th>Notes</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit" name="<?= isset($_GET['edit']) ? 'edit' : 'save' ?>">Save</button>
                </div>
            </form>


        </div>
    </div>
</div>