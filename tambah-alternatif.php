<?php
include './includes/api.php';
akses_pengguna(array(2,3));

if (!empty($_POST)) {
    $pesan_error = array();
    $nama = $_POST['nama'];
    $nuptk = $_POST["nuptk"];
    $jabatan = $_POST["jabatan"];
    $ttl = $_POST["ttl"];
    $alamat = $_POST["alamat"];
    $telp = $_POST["telp"];
    $no_sk = $_POST["no_sk"];
   
    if ($nama=='') array_push($pesan_error, 'Nama tidak boleh kosong');

    if (empty($pesan_error)) {
        $q = $conn->prepare("INSERT INTO alternatif VALUE (NULL, '$nama','$nuptk','$jabatan','$ttl','$alamat','$telp','$no_sk')");
		
        $q->execute();
		
        header('Location: ./list-alternatif');
    }
}
include './includes/header.php';
?>
<div class="container-fluid">
<h3 class="m-0 font-weight-bold text-primary"><span class="fas fa-plus-circle"></span> Tambah Alternatif</h3><hr>
<form method="post" class="mx-auto" style="max-width:400px" autocomplete="off">

    <label class="mr-sm-2" for="nama">Nama Guru</label>
    <input id="nama" name="nama" class="form-control mb-2 mr-sm-2" type="text">

    <label for="nuptk">NUPTK</label>
    <input type="text" name="nuptk" id="nuptk" class="form-control" required="on">

    <label for="jabatan">Jabatan</label>
    <input type="text" name="jabatan" id="jabatan" class="form-control" required="on">

    <label for="ttl">TTL</label>
    <input type="text" name="ttl" id="ttl" class="form-control" required="on">

    <label for="alamat">Alamat</label>
    <input type="text" name="alamat" id="alamat" class="form-control" required="on">

    <label for="telp">No. Telp</label>
    <input type="text" name="telp" id="telp" class="form-control" required="on">

    <label for="no_sk">No. SK</label>
    <input type="text" name="no_sk" id="no_sk" class="form-control" required="on">

   

        <br />
    
    <button class="btn btn-primary" type="submit"><span class="fas fa-plus-circle"></span> Tambah</button>
    <button class="btn btn-danger" type="reset" onclick="location.href='./list-alternatif'"><span class="fas fa-times"></span> Batal</button>
    <?php if (!empty($pesan_error)) {
        echo '<hr><div class="alert alert-dismissable alert-danger"><ul>';
        foreach ($pesan_error as $x) {
            echo '<li>'.$x.'</li>';
        }
        echo '</ul></div>';
    }
    ?>
</form>
</div>
<?php include './includes/footer.php';?>