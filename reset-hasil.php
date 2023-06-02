<?php
include './includes/api.php';
if (!empty($_GET)) {

//@$id = $_GET['id_alternatif'];
@$periode = $_GET['periode'];
$q = $conn->prepare("DELETE FROM hasil WHERE YEAR(periode) ='$periode'");
//$id  = $_GET['id_alternatif'];
//$periode = $_GET['periode'];
// echo $id;
// echo $periode;
// echo 'periode';
// echo console.log('testing')
//$q = $conn->prepare("DELETE FROM hasil where periode='$periode' AND id_alternatif='$id'"); //hapus
// print_r($_GET);
	
// die;

$q->execute();

header('Location: ./proses-data.php');
}
else header('Location: ./proses-data.php');

//AND id_alternatif='$id'
?>