<?php include './includes/api.php';
include './includes/header.php';
akses_pengguna(array(1,3));
?><div class="container-fluid"> <?php
//if (!empty($_POST)) {
if (isset($_POST['proses'])) {
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

<h3 class="m-0 font-weight-bold text-primary"><span class="fas fa-radiation"></span> Hasil Keputusan Periode <?=$periode - 1 .'/'.$periode ?></h3><hr>

<?php if (count(data_alternatif_periode($periode)) > 0 & count(data_kriteria($periode)) > 0 & cek_valid_bobot($periode)) {

?>




<h6 class="m-0 font-weight-bold text-primary">Hasil pada periode <?=$periode - 1 .'/'.$periode ?></h6>
<div id="tempat-hasil">
    <?php
    
        echo '<script>__nilai = 100;</script>';
    ?>
    <form method="post">

    <table class="table table-bordered table-sm table-striped small">
		<thead>
			<tr>
				<th width="10">Ranking</th>
                <th>Nama Guru</th>
                <th>NUPTK</th>
				<th>Tgl Lahir</th>
                <th>Jabatan</th>
                <th>No. telp</th>
                <th>Nilai</th>
                <th>Keputusan</th>
			</tr>
		</thead>
		<tbody>
        <?php $no=1; foreach (data_hasil_periode($periode) as $x) {
        echo "<tr>";
        echo "<td class=\"text-center\">$no</td>

        <td>{$x[5]}</td>
        <td>{$x[6]}</td>
		<td>{$x[8]}</td>
        <td>{$x[7]}</td>
        <td>{$x[10]}</td>
        <td class=\"text-center\">".number_format($x[1], 4, '.', ',')."</td>";
        ?>
        <td><input type="radio" value="<?= $x[0] ?>" name="id_alternatif" /></td>
        
        <?php 
        echo '</tr>';
        $no++;
    } ?>
		</tbody>
	</table>
    <input type="hidden" value="<?= $periode ?>" name="periode" />
   
    <button type="submit" name="keputusan" class="btn btn-danger"><span class="fa fa-print"></span> Cetak Hasil Keputusan</button>
    
    </form>
</div>

<?php
    } else {
        if (count(data_kriteria($periode)) < 1) echo '<div class="alert alert-dismissable alert-danger"><b>Data kriteria kosong</b>, silahkan hubungi Petugas.</div>';
        if (count(data_alternatif_periode($periode)) < 1) echo '<div class="alert alert-dismissable alert-danger"><b>Data alternatif kosong</b>, silahkan hubungi Petugas.</div>';
        if (!cek_valid_bobot($periode)) echo '<div class="alert alert-dismissable alert-danger"><b>Perbadingan bobot kriteria tidak valid</b>, silahkan hubungi Pakar/Ahli.</div>';
    }
 
} 
else if (isset($_POST['keputusan'])) {
    $periode = isset ($_POST['periode'])?$_POST['periode']:'';
    $id = isset ($_POST['id_alternatif'])?$_POST['id_alternatif']:'';

    $query = $conn->prepare("UPDATE hasil SET status='1' WHERE id_alternatif='$id' AND YEAR(periode)='$periode'");
    $query->execute();
//cek
   // echo "<br/>";
   // echo $periode;
   // echo "<br/>";
   // echo $id;
    //echo "Mencetak ......";
    
    //header('Location: ./list-nilai-alternatif');
    //header('Location: ./cetak-keputusan-id?id='.$id.'&periode='.$periode.'');
 //cek
    echo "
        <script>
            setTimeout(function() {
                window.location = './cetak-keputusan-id.php?id=' + $id + '&periode=$periode';
            }, 1000);
        </script>
    ";
    

}else {
    echo '<h3 class="m-0 font-weight-bold text-primary"><span class="fas fa-table"></span> Cetak Hasil Keputusan</h3><hr>';
    ?> 
     <form method="post" class="mx-auto" style="max-width:400px" autocomplete="off">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="periode">Periode Periode</label>
                <div class="col-sm-6">
                    <!--<input type="date" name="periode" id="periode" class="form-control yearpicker" required="on">-->
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
                <button class="col-sm-2 btn btn-primary" name="proses" type="submit">Pilih</button>
            </div>
        </form>
    <?php
}
?></div><?php
include './includes/footer.php';?>