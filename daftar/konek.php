<?php 
$db = mysqli_connect('localhost', 'root', '', 'coba');
function registrasi($data)
{
	global $db;
	$username = strtolower(stripcslashes($data['username']));
	$password1 = mysqli_real_escape_string($db, $data['password1']);
	$password2 = mysqli_real_escape_string($db, $data['password2']);
	$kelas = $data['kelas'];
	$jk = $data['jenis_kelamin'];

	$result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");
	if (mysqli_fetch_assoc($result)) {
		echo "<script>alert('username sudah terdaftar Sebelumnya')</script>";
		return false;
		# code...
	}
	if ($password1 !== $password2) {
		echo "<script>alert('password anda sama')</script>";
		return false;
		# code...
	}
	// enkripsi password setelah pengkondisian
	$password = password_hash($password1, PASSWORD_DEFAULT);
	// masukan data ke database
	$query = "INSERT INTO users VALUES('', '$username', '$password', '$kelas', '$jk')";
	$result = mysqli_query($db,$query );
	return mysqli_affected_rows($db);

}



?>