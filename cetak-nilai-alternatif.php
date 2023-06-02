<?php
if (!empty($_POST)) {
    $periode = $_POST['periode'];
?>

<!DOCTYPE html>
<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
	<title>Report</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<?php include './includes/api.php'; ?>
<table  align="center">
    <tr>
    <td> <center><img src="img/kopsurat.jpg" width="1000" height="180"></center></td>
        <td>
            <!--<center>
                <font size="5"><b>SDI Darul Mumin</b></font> <br>
                <font size="4">Jl swadaya </font> <br>
                <font size="4">Larangan, Tangerang</font> <br>
                <font size="4">Telp. (021) 58902147 </font> <br>
                 
            </center> -->
            
        </td>
    </tr>
    <tr>
        <td colspan="2"><hr></td>
    </tr>
</table>

<body onload="window.print()">
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
    </style>
    
	<center>
        <h5><b>Laporan Penilaian Kinerja Guru</b></h4>
        <h5><b>Periode <?=$periode - 1 .'/'.$periode ?></b></h5>
        <br>
	</center>

       
	<table class="table table-bordered table-sm table-striped small">
    <tr class="text-center">
        <th>No</th><th>Nama</th>
        <?php
        foreach (data_kriteria($periode) as $x) echo "<th>{$x[1]}</th>";
        ?>
    </tr>
    <?php $no = 1;
    foreach (data_alternatif_periode($periode) as $x) {
        echo "<tr><td class=\"text-center\">$no</td><td>{$x[5]}</td>";
        foreach (data_kriteria($periode) as $y) {
            $n = nilai_alternatif($x[0], $y[0],$periode);
            echo "<td class=\"text-center\">$n</td>";
        }
        
        $no++;
        
    }
    ?>
</table>

    <table align="left" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
            <tr>
                <td align="left"> <font size="3"><b>KETERANGAN:</b></td>
            </tr>        
            <tr>
                <td align="left">Untuk kriteria Presensi Kehadiran didapat dari data presensi fingerprint.</td>
            </tr>
            <tr>
                <td align="left">Sedangkan untuk tanggung jawab, RPP, loyalitas dan pelaporan nilai siswa, menggunakan penilaian dibawah: </td>
            </tr>
            <tr>
                <td align="left">(0-20) - Sangat Buruk </td>
            </tr>
            <tr>
                <td align="left">(21-40) - Buruk </td>
            </tr>
            <tr>
                <td align="left">(41-60) - Cukup </td>
            </tr>
            <tr>
                <td align="left">(61-80) - Baik </td>
            </tr>
            <tr>
                <td align="left">(81-100) - Sangat Baik </td>
            </tr>
                <td align="left"></td>
            </tr>
        </table>

    <table align="center" style="width:800px; border:none;margin-top:100px;margin-bottom:20px;">
            <tr>
                <td align="right"><h5>Tangerang, <?php echo date('d-M-Y') ?></h5></td>
               
            </tr>
            <tr>
                <td align="right"><h5>Kepala Sekolah</h5></td>
            </tr>

            <tr>
                <td><br /><br /><br /><br /></td>
            </tr>
            <tr>
                <td align="right">(.......................................)</td>
            </tr>
            <tr>
                <td align="center"></td>
            </tr>
        </table>
	

</body>
</html>

<?php
} else {
    include './includes/api.php';
include './includes/header.php';
akses_pengguna(array(1,3));
?><div class="container-fluid"> <?php
    echo '<h3 class="m-0 font-weight-bold text-primary"><span class="fas fa-table"></span> Cetak Laporan Penilaian Kinerja Guru</h3><hr>';
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
					print '<option name = "periode" align ="center" id = "periode" value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$x.' / '.$i.'</option>';
				  }
				  print '</select>';
				  ?>
                </div>
                <button class="col-sm-2 btn btn-primary" type="submit">Cetak</button>
            </div>
        </form>
<?php
?></div><?php
include './includes/footer.php';   
}
?>

