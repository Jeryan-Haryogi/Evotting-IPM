<?php 
require '../konek.php';
session_start();
if ( !isset($_SESSION['login'])) {
	header("Location: login.php");
	exit();
	# code...
}
$queryjs = mysqli_query($db, "SELECT sum(jumlah_suara) as jsuara FROM kandidat");
$rjs = mysqli_fetch_array($queryjs);

$idpemilih = $_SESSION['idpemilih'];
$querypilih = mysqli_query($db, "SELECT * FROM datapemilihan WHERE idpemilih = '$idpemilih'");
$ada = mysqli_num_rows($querypilih);

function kandidat($data)
{
	global $db;
	$rows = [];	
	$querykandidat = mysqli_query($db,$data);
	while ($row = mysqli_fetch_assoc($querykandidat)) {
		$rows[] = $row;
		# code...
	}
	return $rows;
}
$kandidat = kandidat("SELECT * FROM kandidat");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Pemilihan Ketua Umum</title>
	<meta name="description" content="Thanks for purchasing Huge. If you need any support, please contact with us.">
	<meta name="author" content="lucidtemplate">
	<meta name="copyright" content="lucidtemplate">
	<link rel="shortcut icon" type="image/png" href="img/favicon.ico">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/tree-viewer.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="sweetalert/sweetalert2.min.css">

	<script src="sweetalert/sweetalert2.min.js"></script>
</head>

<body>

	<div class="wrapper">
		<div class="left-side">
			<div class="logo">
				<img src="img/ipm.png" alt="" width="100" height="100" />
			</div>
			<br>
			<h4 style="color: white; text-align: center;">IKATAN PELAJAR MUHAMMADIYAH 9</h4>
			<div class="left-content">
				<ul role="tablist">
					<li role="presentation" class="active"><a href="#one" aria-controls="home" role="tab" data-toggle="tab"><span><i class="fa fa-home"></i></span>Pemilihan</a></li>
					<li role="presentation"><a href="logout.php"><span><i class="fa fa-slideshare"></i></span>Keluar</a></li>
				</ul>
			</div>
			<div class="copyright">
				<p>Copyright &#169; Karya Asli IPM SMK Muhammadiyah 9 </p>
			</div>
		</div>
		<div class="right-side">
			<div class="right-content">
				<div id="one" class="content active fade in">
					<h1><span>Pemilihan Ketua Umum</span> 2019-2020</h1>
					<marquee><h4>Organisasi Yang Baik Adalah Organisasi Yang Berkemajuan Untuk Masa Depan</h4></marquee>
					<h2 style="text-align: center;">Silahkan Melilih Calon Ketua Umum</h2>
					<br>
					<div class="row">
						<?php foreach ($kandidat as $as) : ?>
							<div class="col-sm-4">
								<div class="thumbnail">
									<img src="img/default.jpg" alt="..." style="border-radius: 10%; border: 2px solid orange; box-shadow: 5px 3px 15px;">
									<div class="caption">
										<h2 style="text-align: center;"><?= $as['non_kandidat'] ?></h2>
										<h3 style="text-align: center;"><?php echo $as['nama_lengkap']; ?></h3>
										
										<b>Pemilih : <?=  round(($as['jumlah_suara']/$rjs['jsuara']*100),2) ?>%</b>
										<br>
										<b>Suara : <?= $as['jumlah_suara']; ?></b>
										<br>	
										<?php if ($ada == 0) : ?>
											<a href="pilihan.php?id=<?php echo $as['idkandidat']; ?>" style="color: white;">
												<button type="button" class="btn btn-warning btn-lg" name="klik">
													Pilih
												</button>
											</a>
										<?php endif ?>
									</div>
								</div>
							</div>
						<?php endforeach ?>
					<?php if ($ada == 1) { ?>
						<button type="button" id="klik" id="klik1" class="btn btn-warning btn-lg" style="border-radius: 8%;">
							<a href="#" style="color: white;">Anda Sudah Memilih</a>
						</button>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script type="">
	var pilih = document.getElementById('klik');
	pilih.addEventListener('click', function(){
		Swal.fire({
			position: 'top-end',
			type: 'error',
			title: 'Anda Sudah Memilih',
			text: 'Silahkan Anda Keluar',
			footer: '<h4><br>Terima Kasih Suda Memilih<b></h4>',
			showConfirmButton: false,
			timer: 1500
		})
	});

</script>
<script src="js/jquery-3.1.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jstree.min.js"></script>
<script src="js/jstree.active.js"></script>
<script src="js/main.js"></script>
</body>

</html>
