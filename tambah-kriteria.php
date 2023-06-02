<?php
include './includes/api.php';
akses_pengguna(array(2,3));
//print_r($_REQUEST); 
	
  // die;
if (!empty($_POST)) {
	
    $pesan_error = array();
    $nama = $_POST['nama'];
	$periode = $_REQUEST['periode'];
    $atribut = $_POST['atribut'];
    if ($nama=='') array_push($pesan_error, 'Nama kriteria tidak boleh kosong');

    if (empty($pesan_error)) {
		$q = $conn->prepare("INSERT INTO kriteria VALUE (NULL,'$nama', NULL, '$atribut', '$periode-01-01')");
        // $q = $conn->prepare("INSERT into kriteria (nama, bobot, atribut, periode)
				// values ('ini kriteriaaaa', NULL, 'Benefit', '2023')'");
		
		//print_r($q);
		
		//die;
        $q->execute();
        header('Location: ./data-kriteria');
    }
}
include './includes/header.php';
?>
<div class="container-fluid">
<h3 class="m-0 font-weight-bold text-primary"><span class="fas fa-plus-circle"></span> Tambah Kriteria</h3><hr>
<form method="post" class="mx-auto" style="max-width:400px" autocomplete="off">
    <label class="mr-sm-2" for="nama">Nama Kriteria</label>
    <input id="nama" name="nama" class="form-control mb-2 mr-sm-2" type="text">
    
    <label for="atribut">Atribut</label>
    <select class="form-control" name="atribut" id="atribut" required="on">
        <option value="">---</option>
        <option value="Benefit">Benefit</option>
        <option value="Cost">Cost</option>
    </select>

<br/>
    <button class="btn btn-primary" type="submit"><span class="fas fa-plus-circle"></span> Tambah</button>
    <button class="btn btn-danger" type="reset" onclick="location.href='./data-kriteria'"><span class="fas fa-times"></span> Batal</button>
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