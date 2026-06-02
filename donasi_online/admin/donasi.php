<?php
session_start();
include "../config/koneksi.php";

if(isset($_GET['terima'])){

    $id = $_GET['terima'];

    $donasi = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT *
    FROM donasi
    WHERE id='$id'
    ")
    );

    mysqli_query($conn,"
    UPDATE donasi
    SET status='diterima'
    WHERE id='$id'
    ");

    mysqli_query($conn,"
    UPDATE campaign
    SET terkumpul = terkumpul + ".$donasi['nominal']."
    WHERE id='".$donasi['campaign_id']."'
    ");

    header("Location: donasi.php");
}

$data = mysqli_query($conn,"
SELECT
donasi.*,
users.nama,
campaign.judul
FROM donasi
JOIN users ON users.id=donasi.user_id
JOIN campaign ON campaign.id=donasi.campaign_id
ORDER BY donasi.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Verifikasi Donasi</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="container mx-auto p-5">

<h1 class="text-3xl font-bold mb-5">
Verifikasi Donasi
</h1>

<table class="w-full bg-white">

<tr class="bg-gray-200">

<th>Donatur</th>
<th>Campaign</th>
<th>Nominal</th>
<th>Bukti</th>
<th>Status</th>
<th>Aksi</th>

</tr>

<?php while($d=mysqli_fetch_assoc($data)){ ?>

<tr>

<td class="border p-2">
<?= $d['nama'] ?>
</td>

<td class="border p-2">
<?= $d['judul'] ?>
</td>

<td class="border p-2">
Rp <?= number_format($d['nominal']) ?>
</td>

<td class="border p-2">

<a
href="../uploads/<?= $d['bukti_transfer'] ?>"
target="_blank">

Lihat

</a>

</td>

<td class="border p-2">
<?= $d['status'] ?>
</td>

<td class="border p-2">

<?php if($d['status']=="pending"){ ?>

<a
href="?terima=<?= $d['id'] ?>"
class="bg-green-600 text-white px-3 py-1">

Terima

</a>

<?php } ?>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>