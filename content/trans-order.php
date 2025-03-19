<?php

$query = mysqli_query($connect, "SELECT trans_order.*, customers.customer_name FROM trans_order LEFT JOIN customers ON customers.id=trans_order.id_customer
WHERE deleted_at = 0 ORDER BY trans_order.id DESC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

// include "../koneksi.php";

$query_trans = mysqli_query($connect, "SELECT * FROM trans_order ORDER BY id DESC");
$row_trans = mysqli_fetch_all($query_trans, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $q_delete = mysqli_query($connect, "UPDATE trans_order SET deleted_at = 1 WHERE id='$id'");
    if ($q_delete) {
        header("location:?page=trans_order&hapus=berhasil");
    }
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-center ">
                <h3>Data Transaction</h3>
            </div>
            <?php if (isset($_GET['hapus']) && $_GET['hapus'] == "berhasil") {
            ?>
                <div class="alert alert-danger text-center" role="alert">
                    Hapus Data Berhasil!!
                </div>
            <?php
            }
            ?>
            <?php if (isset($_GET['add']) && $_GET['add'] == "success") {
            ?>
                <div class="alert alert-success text-center" role="alert">
                    Tambah Data Berhasil!!
                </div>
            <?php
            }
            ?>
            <?php if (isset($_GET['update']) && $_GET['update'] == "berhasil") {
            ?>
                <div class="alert alert-dark text-center" role="alert">
                    Update Data Berhasil!!
                </div>
            <?php
            }
            ?>
            <div class="card-body"></div>
            <div align="right" class="mb-5">
                <a href="?page=add-trans-order" class="btn btn-primary">Create New Transaction </a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($row_trans as $row) {


                    ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['trans_code'] ?></td>
                            <td><?= $row['customer_name'] ?></td>
                            <td><?= $row['status'] ?></td>


                            <td>
                                <a href="?page=add-user&edit=<?= $row['id'] ?>" class="btn btn-secondary btn-sm">Edit</a>
                                <a href="?page=user&delete=<?= $row['id'] ?>"
                                    onclick="return confirm('Are You Sure??')" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>