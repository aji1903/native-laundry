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
$query = mysqli_query($connect, "SELECT * FROM levels ORDER BY id DESC");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);


?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-center ">
                <h3><?= isset($_GET['edit']) ? 'Edit' : 'Create' ?> user</h3>
            </div>
            <div class="card-body"></div>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="">Level *</label>
                    <div class="col-sm-10 mb-3">
                        <select name="id_level" id="" class="form-control">
                            <option value="">Choose Level</option>
                            <?php foreach ($row as $rows): ?>
                                <option <?= isset($_GET['edit']) ? ($rowedit['id_level'] == $rows['id']) ? 'selected' : '' : '' ?>
                                    value="<?= $rows['id'] ?>"><?= $rows['level_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="">Name *</label>
                    <input name="nama" value="<?= isset($_GET['edit']) ? $rowedit['nama'] : '' ?>" class="form-control" type="text" require placeholder="Enter user Name">
                </div>

                <div class="mb-3">
                    <label for="">Email *</label>
                    <input name="email" value="<?= isset($_GET['edit']) ? $rowedit['email'] : '' ?>" class="form-control" type="email" require placeholder="Enter user email">
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input name="password" value="" class="form-control" type="password" require placeholder="Enter password">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit" name="<?= isset($_GET['edit']) ? 'edit' : 'save' ?>">Save</button>
                </div>
            </form>


        </div>
    </div>
</div>