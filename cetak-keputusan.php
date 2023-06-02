<?php
if (!empty($_POST)) {
	//print_r($_POST);
	//die;
    $dari_periode = $_POST['dari_periode'];
    $sampai_periode = $_POST['sampai_periode'];
?>

<!DOCTYPE html>
<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
	<title>Report</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<?php include './includes/api.php'; 
// $res = data_keputusan_darisampai($dari_periode,$sampai_periode);
?>
<table  align="center">
    <tr>
    <td> <center><img src="img/kopsurat.jpg" width="1000" height="180"></center></td>
       
            </center>
            
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
        <h4><b>Laporan Hasil Pemilihan Guru Terbaik</b></h4>
        <br>
        <br>
        <h5>Periode <?=$dari_periode - 1 .'/'.$dari_periode ?> s.d <?=$sampai_periode - 1 .'/'.$sampai_periode ?></h5>
	</center>
        <br>
        <br>
        <table class='table table-bordered'>
		<thead>
			<tr>
				<th width="10">No</th>
                <th>Nama</th>
                <th>NUPTK </th>
                <th>Jabatan</th>
                <th>No. Telp</th>
           
                <th>Nilai</th>
                <th>Periode Pilih Keputusan</th>
			</tr>
		</thead>
		<tbody>
        <?php $no=1; foreach (data_keputusan_darisampai($dari_periode,$sampai_periode) as $x) {
        echo "<tr>";
        echo "<td class=\"text-center\">$no</td>
        <td>{$x[5]}</td>
        <td>{$x[6]}</td>
        <td>{$x[7]}</td>
        <td>{$x[10]}</td>
        <td class=\"text-center\">".number_format($x[1], 4, '.', ',')."</td>
        <td>".date("Y", strtotime($x[2])-1).' / '.date("Y", strtotime($x[2]))."</td>";
        echo '</tr>';
        $no++;
    } ?>
		</tbody>
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
    echo '<h3 class="m-0 font-weight-bold text-primary"><span class="fas fa-table"></span> Cetak Laporan Hasil Pemilihan Guru Terbaik</h3><hr>';
    ?> 
     <form method="post" class="mx-auto" style="max-width:400px" autocomplete="off">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="periode">Dari Periode</label>
                <div class="col-sm-6">
                    <!--<input type="date" name="dari_periode" id="dari_periode" class="form-control datepicker" required="on"> -->
				<?php  
				  $currently_selected = date('Y'); 
				  $earliest_year = 2019; 
				  $latest_year = 2030; 

				  print '<select name="dari_periode" >';
				  print '<option value="" disabled selected hidden>Pilih tahun ajaran</option>';
					foreach ( range( $latest_year, $earliest_year ) as $i ) {
						$x = $i-1;
					print '<option name = "dari_periode" align ="center" id = "dari_periode" value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$x.' / '.$i.'</option>';
				  }
				  print '</select>';
				  ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="periode">Sampai Periode</label>
                <div class="col-sm-6">
                    <!--<input type="date" name="sampai_periode" id="sampai_periode" class="form-control datepicker" required="on"> -->
				<?php  
				  $currently_selected = date('Y'); 
				  $earliest_year = 2019; 
				  $latest_year = 2030; 

				  print '<select name="sampai_periode" >';
				  print '<option value="" disabled selected hidden>Pilih tahun ajaran</option>';
					foreach ( range( $latest_year, $earliest_year ) as $i ) {
						$x = $i-1;
					print '<option name = "sampai_periode" align="center" id = "sampai_periode" value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$x.' / '.$i.'</option>';
				  }
				  print '</select>';
				  ?>
                </div>
            </div>
            <div class="text-center">
                <button class="col-sm-2 btn btn-primary" type="submit">Cetak</button>
            </div>
        </form>
<?php
?></div><?php
include './includes/footer.php';   
}
?>

