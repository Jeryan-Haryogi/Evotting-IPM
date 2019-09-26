		<?php 
include '../konek.php';
session_start();
if (!isset($_SESSION['login'])) {
	header('Location: login.php');
	exit();
	# code...
}
$tipe = 'siswa';
$pemilih = $_SESSION['idpemilih'];
$kandidat = $_GET['id'];
$result = mysqli_query($db, "INSERT INTO datapemilihan SET tipe = '$tipe', idpemilih = '$pemilih', idkandidat = '$kandidat'");
if ($result) {
	header('Location: index.php');
	$ubah = mysqli_query($db, "UPDATE kandidat SET jumlah_suara = jumlah_suara+1 WHERE idkandidat = '$kandidat'");
	# code...
}
 ?>