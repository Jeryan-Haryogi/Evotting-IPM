<?php 
include 'konek.php';
if (isset($_POST['kirim'])) {
	if (registrasi($_POST) > 0) {
		echo "<script>alert('Berhasil Di Tambahkan')</script>";
		# code...
	}else {
		echo mysqli_error($db);
	}
	# code...
}


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Daftar</title>
	<style type="text/css">
		label {
			display: block;
		}
	</style>
</head>
<body>
	<h1>Daftar Siswa</h1>
	<form action="" method="POST">
	<ul>
		<li>
			<label>Username</label>
			<input type="text" name="username" placeholder="username" autocomplete="off">
		</li>
		<li>
			<label>Password</label>
			<input type="Password" name="password1">
		</li>
		<li>
			<label>Konfirmasi Password</label>
			<input type="Password" name="password2">
		</li>
		<li>
			<label>Kelas</label>
			<input type="number" name="kelas">
		</li>
		<li>
			<label>Jenis Kelamin</label>
			<select name="jenis_kelamin">
				<option value="Laki-laki">Laki-Laki</option>
				<option value="Perempuan">Perempuan</option>
			</select>
		</li>
		<br>
		<li>
			<button type="submit" name="kirim">Kirim</button>
		</li>
	</ul>
	</form>
</body>
</html>