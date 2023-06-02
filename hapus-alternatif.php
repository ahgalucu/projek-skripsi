<?php include './includes/api.php';
akses_pengguna(array(2,3));
if (!empty($_GET)) {
    @$id = $_GET['id'];
    $q = $conn->prepare("DELETE FROM hasil WHERE id_alternatif='$id'");
    $q->execute();
    $q = $conn->prepare("DELETE FROM nilai_alternatif WHERE alternatif='$id'");
    $q->execute();
    $q = $conn->prepare("DELETE FROM alternatif WHERE id='$id'");
    $q->execute();
    header('Location: ./list-alternatif');
} else header('Location: ./list-alternatif');