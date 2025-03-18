<?php
// include "../koneksi.php";
$queryCustomer = mysqli_query($connect, "SELECT * FROM customers ORDER BY id DESC");
$rowCustomer = mysqli_fetch_all($queryCustomer, MYSQLI_ASSOC);

?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-center ">
                <h3>Data Customer</h3>
            </div>
            <div class="card-body"></div>
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
                                <a href="?page=add-customer&edit=<?= ['row'] ?>" class="btn btn-secondary btn-sm">Edit</a>
                                <a href=""
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