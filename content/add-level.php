<?php
include "../koneksi.php";
if (isset($_POST['save'])) {
    $level_name = $_POST['level_name'];


    $q_save = mysqli_query($connect, "INSERT INTO levels (level_name) VALUES('$level_name')");
    if ($q_save) {
        header("location: ?page=level&add=success");
    }
}

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$q_edit = mysqli_query($connect, "SELECT * FROM levels WHERE id='$id'");
$rowedit = mysqli_fetch_assoc($q_edit);

if (isset($_POST['edit'])) {
    $id = $_GET['edit'];
    $level_name = $_POST['level_name'];


    $update = mysqli_query($connect, "UPDATE levels SET level_name='$level_name'
    WHERE id='$id'");
    if ($update) {
        header("location:?page=level&update=berhasil");
    }
}


?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-center ">
                <h3><?= isset($_GET['edit']) ? 'Edit' : 'Create' ?> level</h3>
            </div>
            <div class="card-body"></div>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="">level Name *</label>
                    <input name="level_name" value="<?= isset($_GET['edit']) ? $rowedit['level_name'] : '' ?>" class="form-control" type="text" require placeholder="Enter level Name">
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary" type="submit" name="<?= isset($_GET['edit']) ? 'edit' : 'save' ?>">Save</button>
                </div>
            </form>


        </div>
    </div>
</div>