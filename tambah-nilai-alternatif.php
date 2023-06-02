<?php
include './includes/api.php';
akses_pengguna(array(2,3));

if (!empty($_POST)) {
    $pesan_error = array();
    $id_alternatif = $_POST['id_alternatif'];
    $periode = $_GET['periode'];
    if ($id_alternatif=='') array_push($pesan_error, 'Alternatif tidak boleh kosong');
    if (empty($pesan_error)) {

        foreach ($_POST["kriteria"] as $k => $v) {
            $nilai = $_POST["kriteria"][$k];
            $q = $conn->prepare("INSERT INTO nilai_alternatif VALUE ('$id_alternatif', '$k', '$nilai', '$periode-01-01')");
            $q->execute();
          }

        header('Location: ./list-nilai-alternatif');
    }
}
include './includes/header.php';
?>
<div class="container-fluid">
<h3 class="m-0 font-weight-bold text-primary"><span class="fas fa-plus-circle"></span> Tambah Nilai Alternatif</h3><hr>
<form method="post" class="mx-auto" style="max-width:400px" autocomplete="off">
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" for="nama">Nama Alternatif</label>
        <br>
        <br>
        <br>
        <div class="col-sm-8">
            <select class="form-control" id="id_alternatif" name="id_alternatif" required>
              <option value="">---</option>
              <?php
                foreach (data_alternatif() as $x) {
                    $s = '';
                    if ($x['id']==@$level) $s = ' selected';
                    echo "<option$s value=\"{$x['id']}\">{$x['nama']}</option>";
                }
                ?>
            </select>
       </div>
    </div>

    <?php $k = 66;
	@$periode = $_GET['periode'];
    foreach (data_kriteria($periode) as $x) {?>
    <div class="form-group row">
        <label for="<?=$x[0]?>" class="col-sm-4 col-form-label"><?=$x[1]?></label>
        <div class="col-sm-8">
            <input type="number" class="form-control" id="kriteria[<?=$x[0]?>]" name="kriteria[<?=$x[0]?>]" required>
        </div>
    </div>
    <?php $k++; } ?>
        <br />
    
   
    
    <button class="btn btn-primary" type="submit"><span class="fas fa-plus-circle"></span> Tambah</button>
    <button class="btn btn-danger" type="reset" onclick="location.href='./list-nilai-alternatif'"><span class="fas fa-times"></span> Batal</button>
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