
<?php include './includes/api.php';
include './includes/header.php';
akses_pengguna(array(2,3));
?><div class="container-fluid"> <?php
if (!empty($_POST)) {
    $pesan_error = array();
    $periode = $_POST['periode'];
    if ($periode=='') array_push($pesan_error, 'Periode tidak boleh kosong');
    if (!empty($pesan_error)) {
        echo '<hr><div class="alert alert-dismissable alert-danger"><ul>';
        foreach ($pesan_error as $x) {
            echo '<li>'.$x.'</li>';
        }
        echo '</ul></div>';
    }
    ?>

<h3 class="m-0 font-weight-bold text-primary"><span class="fas fa-users-cog"></span> Data Nilai Alternatif Periode <?=$periode - 1 .'/'.$periode ?></h3><hr>
<!--<button class="btn btn-primary" onclick="location.href='./tambah-nilai-alternatif'"><span class="fas fa-plus-circle"></span> Tambah Nilai Alternatif</button> -->
<button class="btn btn-primary" onclick="tambah_nilai('<?= $periode?>')"><span class="fas fa-plus-circle"></span> Tambah Nilai Alternatif</button>
<br />
<br />

<table id="tabelnilai" class="table table-bordered table-sm table-striped small">
    <tr class="text-center">
        <th>No</th><th>Nama Guru</th>
        <?php
        foreach (data_kriteria($periode) as $x) echo "<th>{$x[1]}</th>";
        ?>
        <th>Pengaturan</th>
    </tr>
    <?php $no = 1;
    foreach (data_alternatif_periode($periode) as $x) {
        echo "<tr><td class=\"text-center\">$no</td><td>{$x[5]}</td>";
        foreach (data_kriteria($periode) as $y) {
            $n = nilai_alternatif($x[0], $y[0],$periode);
            echo "<td align='center'>$n</td>";
        }
        echo"<td class=\"text-center\">
        <button onclick=\"hapus_nilai_alternatif('{$x[0]},{$y[0]}','{$periode}')\" class=\"btn btn-danger\"><span class=\"fas fa-trash-alt\"></span> Hapus</button></td>";
        echo '</tr>';
        $no++;
        
    }
    ?>
</table>
    
<?php
} else {
    echo '<h3 class="m-0 font-weight-bold text-primary"><span class="fas fa-table"></span> Data Nilai Alternatif</h3><hr>';
    ?>
    <!-- <button class="btn btn-primary" onclick="location.href='./tambah-nilai-alternatif'"><span class="fas fa-plus-circle"></span> Tambah Nilai Alternatif</button> -->
   
    <form method="post" class="mx-auto" style="max-width:400px" autocomplete="off">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="periode">Pilih Periode</label>
            <div class="col-sm-6">
                <!-- <select class="form-control" name="periode" required>
                <option></option>
                <?php for ($i = 2020; $i <= 2023; $i++) : ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
                </select>
                <input type="date" name="periode" id="periode" class="form-control datepicker" required="on"> -->
				<?php  
				  $currently_selected = date('Y'); 
				  $earliest_year = 2019; 
				  $latest_year = 2030; 

				  print '<select name="periode" >';
				  print '<option value="" disabled selected hidden>Pilih tahun ajaran</option>';
					foreach ( range( $latest_year, $earliest_year ) as $i ) {
						$x = $i-1;
					print '<option name = "periode" align = "center" id = "periode" value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$x.' / '.$i.'</option>';
				  }
				  print '</select>';
				  ?>
            </div>
            <button class="col-sm-2 btn btn-primary" type="submit">Pilih</button>
        </div>
    </form>
    <?php
}
?>
</div>

<?php include './includes/footer.php';?>