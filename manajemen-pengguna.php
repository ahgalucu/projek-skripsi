<?php include './includes/api.php';
include './includes/header.php';
akses_pengguna(array(3));?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h2 class="m-0 font-weight-bold text-primary"><span class="fas fa-home"></span> User Management</h2>
</div>


<div class="row">

</div>
<table class="table table-striped table-bordered table-sm">
    <tr class="text-center">
        <th>No</th><th>Username</th><th>Level</th><th>Nama</th><th>Pengaturan</th>
    </tr>
    <?php $no=1; foreach (data_pengguna() as $x) {
        echo "<tr>";
        echo "<td class=\"text-center\">$no</td><td>{$x['username']}</td><td class=\"text-center\">{$x['keterangan']}</td><td>{$x['nama']}</td><td class=\"text-center\"><button onclick=\"location.href='./edit-pengguna?username={$x[0]}'\" class=\"btn btn-primary\"><span class=\"fas fa-pen\"></span> Edit</button> <button onclick=\"hapus_pengguna('{$x[0]}')\" class=\"btn btn-danger\"><span class=\"fas fa-trash-alt\"></span> Hapus</button></td>";
        echo '</tr>';
        $no++;
    } ?>
</table>
<button class="btn btn-primary" onclick="location.href='./tambah-pengguna'"><span class="fas fa-plus-circle"></span> Tambah User</button>
</div>
<?php include './includes/footer.php';?>
    
