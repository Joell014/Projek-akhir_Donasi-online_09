<?php
session_start();
include "../config/koneksi.php";

$idUser = $_SESSION['id'];

$data = mysqli_query($conn,"
SELECT
donasi.*,
campaign.judul
FROM donasi
JOIN campaign
ON campaign.id=donasi.campaign_id
WHERE user_id='$idUser'
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Riwayat Donasi</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="container mx-auto p-5">

<h1 class="text-3xl font-bold mb-5">
Riwayat Donasi
</h1>

<table class="w-full bg-white">

<tr class="bg-gray-200">
<th class="p-2">Campaign</th>
<th>Nominal</th>
<th>Status</th>
<th>Bukti</th>
</tr>

<?php while($d=mysqli_fetch_assoc($data)){ ?>

<tr>

<td class="border p-2">
<?= $d['judul'] ?>
</td>

<td class="border p-2">
Rp <?= number_format($d['nominal']) ?>
</td>

<td class="border p-2">
<?= ucfirst($d['status']) ?>
</td>

<td class="border p-2">
<a
href="../uploads/<?= $d['bukti_transfer'] ?>"
target="_blank"
class="text-blue-600">

Lihat

</a>
</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>