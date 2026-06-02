<?php
session_start();
include "config/koneksi.php";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn,"
    SELECT * FROM users
    WHERE email='$email'
    ");

    $user = mysqli_fetch_assoc($query);

    if($user && password_verify($password,$user['password'])){

        $_SESSION['id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['role'] = $user['role'];

        if($user['role']=="admin"){
            header("Location: admin/dashboard.php");
        }else{
            header("Location: user/dashboard.php");
        }

        exit;

    }else{
        $error = "Email atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - PeduliSesama</title>

<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-r from-blue-600 to-cyan-500">

<div class="min-h-screen flex items-center justify-center p-6">

<div class="bg-white rounded-3xl shadow-2xl overflow-hidden max-w-5xl w-full">

<div class="grid md:grid-cols-2">

<!-- KIRI -->
<div class="bg-blue-700 text-white p-10 flex flex-col justify-center">

<img
src="assets/logo.png"
class="w-24 mb-6">

<h1 class="text-4xl font-bold mb-4">
PeduliSesama
</h1>

<p class="text-lg opacity-90">
Mari berbagi dan membantu sesama melalui donasi online yang aman dan transparan.
</p>

<img
src="assets/hero-donasi.jpg"
class="mt-8 rounded-xl shadow-lg">

</div>

<!-- KANAN -->
<div class="p-10">

<h2 class="text-3xl font-bold mb-2">
Login
</h2>

<p class="text-gray-500 mb-6">
Masuk ke akun Anda
</p>

<?php if(isset($error)){ ?>
<div class="bg-red-100 text-red-700 p-3 rounded mb-4">
<?= $error ?>
</div>
<?php } ?>

<form method="POST">

<div class="mb-4">

<label class="block mb-2 font-semibold">
Email
</label>

<input
type="email"
name="email"
required
class="w-full border rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

</div>

<div class="mb-6">

<label class="block mb-2 font-semibold">
Password
</label>

<input
type="password"
name="password"
required
class="w-full border rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

</div>

<button
type="submit"
name="login"
class="w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-xl font-semibold transition">

Masuk

</button>

<div class="text-center mt-6">

Belum punya akun?

<a
href="register.php"
class="text-blue-600 font-bold">

Daftar

</a>

</div>

<div class="text-center mt-4">

<a
href="index.php"
class="text-gray-500">

← Kembali ke Beranda

</a>

</div>

</form>

</div>

</div>

</div>

</div>

</body>
</html>