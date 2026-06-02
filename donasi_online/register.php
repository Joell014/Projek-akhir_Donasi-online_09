<?php
include "config/koneksi.php";

if(isset($_POST['register'])){

    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($cek)>0){
        echo "<script>alert('Email sudah digunakan');</script>";
    }else{

        mysqli_query($conn,"
        INSERT INTO users(nama,email,password)
        VALUES('$nama','$email','$password')
        ");

        echo "<script>
        alert('Registrasi berhasil');
        window.location='login.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">

<h2 class="text-2xl font-bold mb-4">Register</h2>

<form method="POST">

<input type="text"
name="nama"
placeholder="Nama"
class="w-full border p-2 mb-3"
required>

<input type="email"
name="email"
placeholder="Email"
class="w-full border p-2 mb-3"
required>

<input type="password"
name="password"
placeholder="Password"
class="w-full border p-2 mb-3"
required>

<button
name="register"
class="bg-green-600 text-white w-full p-2 rounded">
Daftar
</button>

</form>

</div>

</body>
</html>