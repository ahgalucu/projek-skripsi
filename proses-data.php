<?php include './includes/api.php';
include './includes/header.php';
akses_pengguna(array(2,3));
?><div class="container-fluid"> <?php
// if (!empty($_POST)) {
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

<h3 class="m-0 font-weight-bold text-primary"><span class="fas fa-radiation"></span> Proses Penilaian Kinerja Guru Periode <?=$periode - 1 .'/'.$periode ?></h3><hr>

<?php if (count(data_alternatif_periode($periode)) > 0 & count(data_kriteria($periode)) > 0 & cek_valid_bobot($periode)) {
    ?>
<!--DATA PENILAIAN KINERJA-->
<h6 class="m-0 font-weight-bold text-primary">Data</h6>
<table class="table table-bordered table-sm table-striped small">
    <tr class="text-center">
        <th>Nama Guru</th>
        <?php
        foreach (data_kriteria($periode) as $x) echo "<th>{$x[1]} (".number_format($x[2], 4, '.', ',').")</th>";
        ?>
    </tr>
    <?php
    $data = array();
    foreach (data_alternatif_periode($periode) as $x) {
        echo "<tr><td>{$x[5]}</td>";
        foreach (data_kriteria($periode) as $y) {
            $n = nilai_alternatif($x[0], $y[0],$periode);
            echo "<td align='center'>$n</td>";
            $data[$y[0]][$x[0]] = $n;
        }
        echo '</tr>';
    }
    ?>
<!--DATA NORMALISASI-->
</table><hr>
<h6 class="m-0 font-weight-bold text-primary">Normalisasi</h6>
<table class="table table-bordered table-sm table-striped small">
    <tr class="text-center">
        <th>Nama Guru</th>
        <?php
        foreach (data_kriteria($periode) as $x) echo "<th>{$x[1]} (".number_format($x[2], 4, '.', ',').")</th>";
        ?>
    </tr>
    <?php
    $data_normalisasi = array();
    $data_hasil = array();
    foreach (data_alternatif_periode($periode) as $x) {
        echo "<tr>
                <td>{$x[5]}</td>";
        
        foreach (data_kriteria($periode) as $y) {
            if ($y[3]=='Benefit') $n = nilai_alternatif($x[0], $y[0],$periode)/max($data[$y[0]]);
            else $n = min($data[$y[0]])/nilai_alternatif($x[0], $y[0],$periode);
            // else $n = nilai_alternatif($x[0], $y[0])/max($data[$y[0]]);
            echo "<td align='center'>".number_format($n, 4, '.', ',')."</td>";
            $data_normalisasi[$y[0]][$x[0]] = $n;
            $data_hasil[$x[0]][$y[0]] = $n*$y[2];
        }
        echo '</tr>';
    }
    ?>
</table><hr>
<!--HASIL AKHIR-->
<?php
$hasil = array();
foreach (array_keys($data_hasil) as $x) {
    $hasil[$x]=array_sum($data_hasil[$x]);
}
arsort($hasil);
?>
<h6 class="m-0 font-weight-bold text-primary">Hasil pada Periode <?=$periode - 1 .'/'.$periode ?></h6>
<div id="tempat-hasil">
    <?php
    
        echo '<script>__nilai = 100;</script>';
    ?>
    <form method="post">
    <table class="table table-bordered table-sm table-striped small">
        <tr class="text-center">
            <th>Ranking</th><th>Nama Guru</th><th>Nilai</th>
        </tr>
        <?php
        $no = 1;
        foreach (array_keys($hasil) as $x) {
            $q = $conn->prepare("SELECT * FROM alternatif WHERE id='$x'");
            $q->execute();
            @$data = $q->fetchAll()[0];
            @$nama = $data[1];
            @$id =  $data[0];
            $nilai = $hasil[$x];
            ?>

            <tr id="baris-<?=$id?>">
                <td align="center"><?=$no?></td>
                <td align="center"><?=$nama?></td>
                <td align="center"><?=number_format($hasil[$x], 4, '.', ',')?></td>
              
            </tr>

        <?php
          $q2 = $conn->prepare("INSERT INTO hasil VALUE ('$x', '$hasil[$x]', '$periode-01-01','0')");
          $q2->execute();
        //   $sql = "INSERT INTO hasil (id_alternatif, nilai, periode)
        //   VALUES ('$x', '$hasil[$x]', '$periode')";
        //   $conn->exec($sql);

        
          
          $no++;
        }
        ?>
    </table>
    <input type="hidden" value="<?= $periode?>" name="periode"  />
	

	
	

<button onclick="hapus_hasil('<?= $periode?>')" type="button" class="btn btn-danger" > <span class="fas fa-trash-alt"></span> Hapus Data Hasil</button>
	
	
     
    </form>
</div>

<?php
    } else {
        if (count(data_kriteria($periode)) < 1) echo '<div class="alert alert-dismissable alert-danger"><b>Data kriteria kosong</b>, silahkan hubungi Petugas.</div>';
        if (count(data_alternatif_periode($periode)) < 1) echo '<div class="alert alert-dismissable alert-danger"><b>Data alternatif kosong</b>, silahkan hubungi Petugas.</div>';
        if (!cek_valid_bobot($periode)) echo '<div class="alert alert-dismissable alert-danger"><b>Perbadingan bobot kriteria tidak valid</b>, silahkan hubungi Pakar/Ahli.</div>';
    }
 
} else if (isset($_POST['keputusan'])) {
    $periode = $_POST['periode'];
    $id = $_POST['id_alternatif'];

    $query = $conn->prepare("UPDATE hasil SET status='1' WHERE id_alternatif='$id'");
    $query->execute();

    // echo "<br/>";
    // echo $periode;
    // echo "<br/>";
    // echo $id;
    echo "Mencetak ......";
    
    // header('Location: ./list-nilai-alternatif');
    // header('Location: ./cetak-keputusan-id?id='.$id.'&periode='.$periode.'');
    echo "
        <script>
            setTimeout(function() {
                window.location = './cetak-keputusan-id.php?id=' + $id + '&periode=$periode';
            }, 1000);
        </script>
    ";
    

} else {
    echo '<h3 class="m-0 font-weight-bold text-primary"><span class="fas fa-table"></span> Proses Penilaian Kinerja Guru</h3><hr>';
    ?> 
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
					print '<option name = "periode" align="center" id = "periode" value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$x.' / '.$i.'</option>';
				  }
				  print '</select>';
				  ?>
                </div>
                <button class="col-sm-2 btn btn-primary" name="proses" type="submit">Pilih</button>
            </div>
        </form>
    <?php
}
?> </div> 




<?php
include './includes/footer.php';?>