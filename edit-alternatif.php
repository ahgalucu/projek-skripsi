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
        $q = $conn->prepare("UPDATE alternatif SET nama='$nama',nuptk='$nuptk',jabatan='$jabatan',ttl='$ttl',alamat='$alamat',telp='$telp',no_sk='$no_sk' WHERE id='$id'");
        $q->execute();
        ob_clean();
        header('Location: ./list-alternatif');
    }
} else if (!empty($_GET)) {
    @$id = $_GET['id'];
    $q = $conn->prepare("SELECT * FROM alternatif WHERE id='$id'");
    $q->execute();
    @$data = $q->fetchAll()[0];
    if ($data) {
        $id = $data[0];
        $nama = $data[1];
		$nuptk = $data[2];
		$jabatan = $data[3];
		$ttl = $data[4];
        $alamat = $data[5];
        $telp = $data[6];
        $no_sk = $data[7];
       
    } else header('Location: ./list-alternatif');
} else header('Location: ./list-alternatif');

include 'includes/header.php';
?>
<div class="container-fluid">
<h3 class="m-0 font-weight-bold text-primary"><span class="fas fa-pen"></span> Edit Alternatif</h3><hr>
<form method="post" class="mx-auto" style="max-width:400px" autocomplete="off">
    <input type="hidden" name="id" value="<?=$id?>">
    <label class="mr-sm-2" for="nama">Nama Alternatif</label>
    <input id="nama" name="nama" class="form-control mb-2 mr-sm-2" type="text" value="<?=$nama?>">
   
    <label for="alamat">NUPTK</label>
    <input type="text" name="nuptk" id="nuptk" class="form-control" required="on" value="<?php echo $nuptk; ?>">
	
	<label for="alamat">Jabatan</label>
    <input type="text" name="jabatan" id="jabatan" class="form-control" required="on" value="<?php echo $jabatan; ?>">
	
	<label for="alamat">TTL</label>
    <input type="text" name="ttl" id="ttl" class="form-control" required="on" value="<?php echo $ttl; ?>">
	
	<label for="alamat">Alamat</label>
    <input type="text" name="alamat" id="alamat" class="form-control" required="on" value="<?php echo $alamat; ?>">
   
    <label for="telp">No. Telp</label>
    <input type="text" name="telp" id="telp" class="form-control" required="on" value="<?php echo $telp; ?>">
    
    <label for="telp">No. SK</label>
    <input type="text" name="no_sk" id="no_sk" class="form-control" required="on" value="<?php echo $no_sk; ?>">
    
    

    <br />
    <button class="btn btn-primary" type="submit"><span class="fas fa-save"></span> Simpan</button>
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