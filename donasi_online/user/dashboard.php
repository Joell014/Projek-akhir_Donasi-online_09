<?php
session_start();
include "../config/koneksi.php";

if(!isset($_SESSION['id']) || $_SESSION['role'] != 'user'){
    header("Location: ../login.php");
    exit;
}

$idUser = $_SESSION['id'];

$totalDonasi = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as total
FROM donasi
WHERE user_id='$idUser'
"));

$totalNominal = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(nominal) as total
FROM donasi
WHERE user_id='$idUser'
"));

$totalDiterima = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as total
FROM donasi
WHERE user_id='$idUser'
AND status='diterima'
"));

$totalPending = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) as total
FROM donasi
WHERE user_id='$idUser'
AND status='pending'
"));

$campaign = mysqli_query($conn,"
SELECT *
FROM campaign
ORDER BY id DESC
LIMIT 3
");

$riwayat = mysqli_query($conn,"
SELECT d.*, c.judul
FROM donasi d
JOIN campaign c ON d.campaign_id=c.id
WHERE d.user_id='$idUser'
ORDER BY d.id DESC
LIMIT 5
");

$notifikasi = mysqli_query($conn,"
SELECT *
FROM notifikasi
WHERE user_id='$idUser'
ORDER BY id DESC
LIMIT 5
");
?><!DOCTYPE html><html>
<head>
<meta charset="UTF-8">
<title>Dashboard User</title>
<script src="https://cdn.tailwindcss.com"></script>
</head><body class="bg-gray-100"><nav class="bg-blue-700 text-white p-4"><div class="container mx-auto flex justify-between"><h1 class="font-bold text-xl">
PeduliSesama
</h1><div>
<?= $_SESSION['nama']; ?><a href="../logout.php"
class="ml-4 bg-red-500 px-3 py-1 rounded">
Logout
</a>

</div></div></nav><div class="container mx-auto p-6"><h2 class="text-3xl font-bold mb-6">
Selamat Datang,
<?= $_SESSION['nama']; ?>
</h2><div class="grid md:grid-cols-4 gap-5 mb-8"><div class="bg-white p-5 rounded shadow">
<h3>Total Donasi</h3>
<p class="text-3xl font-bold text-blue-600">
<?= $totalDonasi['total']; ?>
</p>
</div><div class="bg-white p-5 rounded shadow">
<h3>Total Nominal</h3>
<p class="text-xl font-bold text-green-600">
Rp <?= number_format($totalNominal['total'] ?? 0,0,',','.'); ?>
</p>
</div><div class="bg-white p-5 rounded shadow">
<h3>Diterima</h3>
<p class="text-3xl font-bold text-green-700">
<?= $totalDiterima['total']; ?>
</p>
</div><div class="bg-white p-5 rounded shadow">
<h3>Pending</h3>
<p class="text-3xl font-bold text-yellow-500">
<?= $totalPending['total']; ?>
</p>
</div></div><h3 class="text-2xl font-bold mb-4">
Campaign Terbaru
</h3><div class="grid md:grid-cols-3 gap-5 mb-10"><?php while($c=mysqli_fetch_assoc($campaign)){ ?><div class="bg-white rounded shadow overflow-hidden"><img
src="../uploads/<?= $c['gambar']; ?>"
class="w-full h-48 object-cover">

<div class="p-4"><h4 class="font-bold text-lg">
<?= $c['judul']; ?>
</h4><p class="mt-2 text-sm">
Target:
Rp <?= number_format($c['target']); ?>
</p><p class="text-green-600 font-bold">
Terkumpul:
Rp <?= number_format($c['terkumpul']); ?>
</p><a
href="detail_campaign.php?id=<?= $c['id']; ?>"
class="block text-center bg-blue-600 text-white py-2 mt-3 rounded">

Lihat Detail

</a></div></div><?php } ?></div><div class="grid md:grid-cols-2 gap-6"><div class="bg-white p-5 rounded shadow"><h3 class="text-xl font-bold mb-4">
Riwayat Donasi
</h3><table class="w-full"><tr class="border-b">
<th>Campaign</th>
<th>Nominal</th>
<th>Status</th>
</tr><?php while($r=mysqli_fetch_assoc($riwayat)){ ?><tr class="border-b"><td><?= $r['judul']; ?></td><td>
Rp <?= number_format($r['nominal']); ?>
</td><td><?= $r['status']; ?></td></tr><?php } ?></table></div><div class="bg-white p-5 rounded shadow"><h3 class="text-xl font-bold mb-4">
Notifikasi
</h3><?php while($n=mysqli_fetch_assoc($notifikasi)){ ?><div class="border-b py-3"><?= $n['pesan']; ?></div><?php } ?></div></div></div></body>
</html>
?>