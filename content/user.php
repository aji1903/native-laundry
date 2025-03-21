<?php


// include "../koneksi.php";
$queryuser = mysqli_query($connect, "SELECT * FROM users ORDER BY id DESC");
$rowuser = mysqli_fetch_all($queryuser, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $q_delete = mysqli_query($connect, "DELETE FROM users WHERE id='$id'");
    if ($q_delete) {
        header("location:?page=user&hapus=berhasil");
    }
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-center ">
                <h3>Data user</h3>
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
                <a href="?page=add-user" class="btn btn-primary">Create New user </a>
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
                    foreach ($rowuser as $row) {


                    ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['email'] ?></td>

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