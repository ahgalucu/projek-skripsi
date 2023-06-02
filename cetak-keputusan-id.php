<?php
if (!empty($_GET)) {
    @$id = $_GET['id'];
    @$periode = $_GET['periode'];
} 
?>
<!DOCTYPE html>
<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
	<title>Hasil Keputusan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<?php include './includes/api.php'; 
$res = data_keputusan_id($id,$periode);

?>
<br>
<table  align="center">
    <tr>
    <td> <center><img src="img/kopsurat.jpg" width="1000" height="180"></center></td>
      <!--  <td>
            <center>
                <font size="5"><b>SDI Darul Mumin</b></font> <br>
                <font size="4">Jl. Swadaya III No.60, RT.004/RW.004</font> <br>
                <font size="4">Larangan Kota Tangerang, Banten</font> <br>
                <font size="4">Telp. (021) 58902147</font> <br>
                
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
        <h4><b>Surat Hasil Keputusan</b></h4>
		<h4><b>Pemilihan Guru Berkinerja Terbaik Periode <?=$periode - 1 .'/'.$periode ?> </b></h4>
        <br>
	</center>
        <br>
        <br>
        
            <h5>Berdasarkan perhitungan penilaian kinerja guru
            menetapkan bahwa :</h5>
        <br>
        
        <h5>Nama &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;  : &emsp;<?= $res[5] ?></h5>
        <h5>NUPTK &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp; : &emsp;<?= $res[6] ?></h5>
        <h5>Jabatan &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;  : &emsp;<?= $res[7] ?></h5>
        <h5>Tempat, tanggal lahir &ensp; : &emsp;<?= $res[8] ?></h5>
        <h5>Alamat &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;  : &emsp;<?= $res[9] ?></h5>
        <h5>No.Telp &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp; : &emsp;<?= $res[10] ?></h5>
        <h5>No. SK &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; : &emsp;<?= $res[11] ?></h5>
        <h5>Nilai &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; : &emsp;<?= number_format($res[1], 4, '.', ',') ?></h5>

        <br>
        <h5> Pada tanggal <?= date("d M Y", strtotime($periode)) ?> terpilih sebagai Guru berkinerja <b>TERBAIK</b> pada SDI Darul Mu'minin.</h5>
        <br>
        <br>
        

        <table align="center" style="width:800px; border:none;margin-top:100px;margin-bottom:20px;">
            <tr>
                <td align="right"><h5>Tangerang, <?php echo date('d-M-Y') ?></h5></td>
               
            </tr>
			<tr>
                <td align="right"><h5>Kepala Sekolah</h5></td>
            </tr>
            <tr>
                <td align="right"></td>
            </tr>

            <tr>
                <td><br /><br /><br /><br /></td>
            </tr>
            <tr>
                <td align="right">(..........................................)</td>
            </tr>
            <tr>
                <td align="center"></td>
            </tr>
        </table>
	

</body>
</html>


