<?php
include "config/koneksi.php";

$campaign = mysqli_query($conn,"
SELECT *
FROM campaign
ORDER BY id DESC
LIMIT 6
");

$totalCampaign = mysqli_num_rows(
mysqli_query($conn,"
SELECT * FROM campaign
")
);

$totalDonasi = mysqli_num_rows(
mysqli_query($conn,"
SELECT * FROM donasi
")
);

$dana = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT SUM(terkumpul) as total
FROM campaign
")
);

$totalDana = $dana['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>PeduliSesama</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-50">

<!-- NAVBAR -->

<nav class="bg-white shadow sticky top-0 z-50">

<div class="container mx-auto px-6 py-4 flex justify-between items-center">

<div class="flex items-center gap-3">

<img
src="assets/logo.png"
alt="logo"
class="w-12 h-12 object-contain">

<h1 class="font-bold text-2xl text-blue-700">
PeduliSesama
</h1>

</div>

<div class="space-x-4">

<a href="#campaign">
Campaign
</a>

<a href="#cara">
Cara Donasi
</a>

<a href="#faq">
FAQ
</a>

<a
href="login.php"
class="bg-blue-600 text-white px-4 py-2 rounded">

Login

</a>

</div>

</div>

</nav>

<!-- HERO -->

<section class="bg-gradient-to-r from-blue-700 to-blue-500 text-white">

<div class="container mx-auto px-6 py-20 grid md:grid-cols-2 gap-10 items-center">

<div>

<h1 class="text-5xl font-bold leading-tight">

Bersama Kita Bisa Membantu
Sesama Yang Membutuhkan

</h1>

<p class="mt-6 text-lg">

Donasi Anda akan menjadi harapan baru
bagi mereka yang membutuhkan bantuan.

</p>

<div class="mt-8">

<a
href="#campaign"
class="bg-white text-blue-700 px-6 py-3 rounded-lg font-bold">

Donasi Sekarang

</a>

</div>

</div>

<div>

<img
src="assets/hero-donasi1.jpg"
class="w-full h-[500px] object-cover rounded-xl shadow-2xl">

</div>

</div>

</section>

<!-- STATISTIK -->

<section class="container mx-auto px-6 py-12">

<div class="grid md:grid-cols-3 gap-6">

<div class="bg-white p-6 rounded-xl shadow text-center">

<h3 class="text-gray-500">
Total Campaign
</h3>

<p class="text-4xl font-bold text-blue-600 mt-2">

<?= $totalCampaign ?>

</p>

</div>

<div class="bg-white p-6 rounded-xl shadow text-center">

<h3 class="text-gray-500">
Total Donasi
</h3>

<p class="text-4xl font-bold text-green-600 mt-2">

<?= $totalDonasi ?>

</p>

</div>

<div class="bg-white p-6 rounded-xl shadow text-center">

<h3 class="text-gray-500">
Dana Terkumpul
</h3>

<p class="text-3xl font-bold text-yellow-600 mt-2">

Rp <?= number_format($totalDana,0,',','.') ?>

</p>

</div>

</div>

</section>

<!-- CAMPAIGN -->

<section id="campaign" class="container mx-auto px-6 py-10">

<h2 class="text-4xl font-bold text-center mb-10">

Campaign Terbaru

</h2>

<div class="grid md:grid-cols-3 gap-8">

<?php while($c = mysqli_fetch_assoc($campaign)){ ?>

<div class="bg-white rounded-xl shadow overflow-hidden">

<img
src="uploads/<?= $c['gambar'] ?>"
class="w-full h-56 object-cover">

<div class="p-5">

<h3 class="font-bold text-xl">

<?= $c['judul'] ?>

</h3>

<p class="text-sm text-gray-500 mt-2">

Target:
Rp <?= number_format($c['target']) ?>

</p>

<p class="text-green-600 font-bold mt-2">

Terkumpul:
Rp <?= number_format($c['terkumpul']) ?>

</p>

<?php
$persen = 0;

if($c['target'] > 0){

$persen =
($c['terkumpul'] / $c['target']) * 100;

}
?>

<div class="w-full bg-gray-200 rounded-full h-3 mt-4">

<div
class="bg-green-500 h-3 rounded-full"
style="width:<?= $persen ?>%">
</div>

</div>

<a
href="login.php"
class="block text-center bg-blue-600 text-white py-2 rounded mt-5">

Donasi Sekarang

</a>

</div>

</div>

<?php } ?>

</div>

</section>

<!-- CARA DONASI -->

<section
id="cara"
class="bg-white py-16">

<div class="container mx-auto px-6">

<h2 class="text-4xl font-bold text-center mb-12">

Cara Berdonasi

</h2>

<div class="grid md:grid-cols-3 gap-8 text-center">

<div>

<div class="text-5xl mb-4">
1️⃣
</div>

<h3 class="font-bold text-xl">
Pilih Campaign
</h3>

</div>

<div>

<div class="text-5xl mb-4">
2️⃣
</div>

<h3 class="font-bold text-xl">
Kirim Donasi
</h3>

</div>

<div>

<div class="text-5xl mb-4">
3️⃣
</div>

<h3 class="font-bold text-xl">
Verifikasi Admin
</h3>

</div>

</div>

</div>

</section>

<!-- TESTIMONI -->

<section class="bg-gray-100 py-16">

<div class="container mx-auto px-6">

<h2 class="text-4xl font-bold text-center mb-10">

Apa Kata Donatur?

</h2>

<div class="grid md:grid-cols-3 gap-6">

<div class="bg-white p-5 rounded-xl shadow">

<p>
"Sistemnya mudah digunakan."
</p>

<p class="font-bold mt-3">
- Budi
</p>

</div>

<div class="bg-white p-5 rounded-xl shadow">

<p>
"Sangat membantu masyarakat."
</p>

<p class="font-bold mt-3">
- Siti
</p>

</div>

<div class="bg-white p-5 rounded-xl shadow">

<p>
"Campaign yang tersedia beragam."
</p>

<p class="font-bold mt-3">
- Andi
</p>

</div>

</div>

</div>

</section>

<!-- FAQ -->

<section
id="faq"
class="bg-white py-16">

<div class="container mx-auto px-6">

<h2 class="text-4xl font-bold text-center mb-10">

FAQ

</h2>

<div class="space-y-5">

<div class="bg-gray-100 p-5 rounded">

<b>
Bagaimana cara berdonasi?
</b>

<p>
Pilih campaign kemudian upload bukti transfer.
</p>

</div>

<div class="bg-gray-100 p-5 rounded">

<b>
Apakah donasi aman?
</b>

<p>
Semua donasi diverifikasi admin.
</p>

</div>

<div class="bg-gray-100 p-5 rounded">

<b>
Apakah ada minimal donasi?
</b>

<p>
Tidak ada batas minimum donasi.
</p>

</div>

</div>

</div>

</section>

<!-- FOOTER -->

<footer class="bg-blue-900 text-white py-10">

<div class="container mx-auto text-center">

<h2 class="text-3xl font-bold">

PeduliSesama

</h2>

<p class="mt-3">

© 2026 Sistem Donasi Online

</p>

</div>

</footer>

</body>
</html>