<?php
// include "../koneksi.php";
$queryService = mysqli_query($connect, "SELECT * FROM services ORDER BY id DESC");
$rowService = mysqli_fetch_all($queryService, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $service_name = $_POST['service_name'];
    $service_price = $_POST['service_price'];
    $service_desc = $_POST['service_desc'];

    $q_delete = mysqli_query($connect, "DELETE FROM services WHERE id='$id'");
    if ($q_delete) {
        header("location:?page=service&hapus=berhasil");
    }
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-center ">
                <h3>Data Service</h3>
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
                <a href="?page=add-service" class="btn btn-primary">Create New Service </a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Service</th>
                        <th>Service Price</th>
                        <th>Service Desc</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($rowService as $row) {


                    ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['service_name'] ?></td>
                            <td><?= $row['service_price'] ?></td>
                            <td><?= $row['service_desc'] ?></td>
                            <td>
                                <a href="?page=add-service&edit=<?= $row['id'] ?>" class="btn btn-secondary btn-sm">Edit</a>
                                <a href="?page=service&delete=<?= $row['id'] ?>"
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