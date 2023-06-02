<?php include './includes/api.php';
akses_pengguna(array(2,3));
if (!empty($_GET)) {

   // print_r($_GET); 
	
   // die;

    @$id = $_GET['id'];
    @$periode = $_GET['periode'];
    $q = $conn->prepare("DELETE FROM hasil WHERE id_alternatif='$id' and YEAR(periode) ='$periode'");
  //  print_r($q); 
    //die;
    
    $q->execute();
	
	
    $q = $conn->prepare("DELETE FROM nilai_alternatif WHERE alternatif='$id' and YEAR(periode) = '$periode'");
    $q->execute();
  //  print_r($q); 
   // die;
   // $q = $conn->prepare("DELETE FROM alternatif WHERE id='$id'");
    //$q->execute();
    header('Location: ./list-nilai-alternatif');
} else header('Location: ./list-nilai-alternatif');