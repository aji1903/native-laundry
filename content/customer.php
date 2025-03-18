<?php
// include "../koneksi.php";
$queryCustomer = mysqli_query($connect, "SELECT * FROM customers ORDER BY id DESC");
$rowCustomer = mysqli_fetch_all($queryCustomer, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $customer_address = $_POST['customer_address'];

    $q_delete = mysqli_query($connect, "DELETE FROM customers WHERE id='$id'");
    if ($q_delete) {
        header("location:?page=customer&hapus=berhasil");
    }
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-center ">
                <h3>Data Customer</h3>
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
                <a href="?page=add-customer" class="btn btn-primary">Create New Customer </a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rowCustomer as $row) {
                        $no = 1;

                    ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['customer_name'] ?></td>
                            <td><?= $row['customer_phone'] ?></td>
                            <td><?= $row['customer_address'] ?></td>
                            <td>
                                <a href="?page=add-customer&edit=<?= $row['id'] ?>" class="btn btn-secondary btn-sm">Edit</a>
                                <a href="?page=customer&delete=<?= $row['id'] ?>"
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