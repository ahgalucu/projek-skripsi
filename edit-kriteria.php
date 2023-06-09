<?php
include './includes/api.php';
akses_pengguna(array(2,3));
if (!empty($_POST)) {
    $pesan_error = array();
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $atribut = $_POST['atribut'];
    if ($nama=='') array_push($pesan_error, 'Nama kriteria tidak boleh kosong');
  
    if (empty($pesan_error)) {
        $q = $conn->prepare("UPDATE kriteria SET nama='$nama', atribut='$atribut' WHERE id='$id'");
        $q->execute();
        ob_clean();
        header('Location: ./data-kriteria');
    }
} else if (!empty($_GET)) {
    @$id = $_GET['id'];
    $q = $conn->prepare("SELECT * FROM kriteria WHERE kriteria.id='$id'");
    $q->execute();
    @$data = $q->fetchAll()[0];
    if ($data) {
        $id = $data[0];
        $nama = $data[1];
        $atribut = $data[3];

    } else header('Location: ./data-kriteria');
} else header('Location: ./data-kriteria');

include 'includes/header.php';
?>
<div class="container-fluid">
<h3 class="m-0 font-weight-bold text-primary"><span class="fas fa-pen"></span> Edit Kriteria</h3><hr>
<form method="post" class="mx-auto" style="max-width:400px" autocomplete="off">
    <input type="hidden" name="id" value="<?=$id?>">
    <label class="mr-sm-2" for="nama">Nama Kriteria</label>
    <input id="nama" name="nama" class="form-control mb-2 mr-sm-2" type="text" value="<?=$nama?>">
    
    </select>

    <label for="atribut">Atribut</label>
    <select class="form-control" name="atribut" id="atribut" required="on">
        <option value="">---</option>
        <option value="Benefit" <?= ($atribut == "Benefit") ? "selected=\"on\"" : "" ?>>Benefit</option>
        <option value="Cost" <?= ($atribut == "Cost") ? "selected=\"on\"" : "" ?>>Cost</option>
       
    </select>

<br/>
    <button class="btn btn-primary" type="submit"><span class="fas fa-save"></span> Simpan</button>
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