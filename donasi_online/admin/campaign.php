<?php
session_start();
include "../config/koneksi.php";

if($_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
}

$cari = "";

if(isset($_GET['cari'])){
    $cari = $_GET['cari'];

    $data = mysqli_query($conn,"
    SELECT campaign.*, kategori.nama_kategori
    FROM campaign
    LEFT JOIN kategori ON kategori.id=campaign.kategori_id
    WHERE judul LIKE '%$cari%'
    ");
}else{

    $data = mysqli_query($conn,"
    SELECT campaign.*, kategori.nama_kategori
    FROM campaign
    LEFT JOIN kategori ON kategori.id=campaign.kategori_id
    ");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Kelola Campaign</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-5">

<h1 class="text-3xl font-bold mb-5">
Kelola Campaign
</h1>

<a href="tambah_campaign.php"
class="bg-green-600 text-white px-4 py-2 rounded">
Tambah Campaign
</a>

<form class="mt-4">

<input
type="text"
name="cari"
placeholder="Cari campaign..."
value="<?= $cari ?>"
class="border p-2">

<button
class="bg-blue-600 text-white px-3 py-2">
Cari
</button>

</form>

<table class="w-full mt-5 bg-white">

<tr class="bg-gray-200">
<th class="p-2">No</th>
<th>Gambar</th>
<th>Judul</th>
<th>Kategori</th>
<th>Target</th>
<th>Aksi</th>
</tr>

<?php
$no=1;
while($d=mysqli_fetch_assoc($data)){
?>

<tr>

<td class="border p-2"><?= $no++ ?></td>

<td class="border p-2">
<img
src="../uploads/<?= $d['gambar'] ?>"
width="100">
</td>

<td class="border p-2">
<?= $d['judul'] ?>
</td>

<td class="border p-2">
<?= $d['nama_kategori'] ?>
</td>

<td class="border p-2">
Rp <?= number_format($d['target']) ?>
</td>

<td class="border p-2">

<a
href="edit_campaign.php?id=<?= $d['id'] ?>"
class="bg-yellow-500 text-white px-3 py-1">
Edit
</a>

<a
href="hapus_campaign.php?id=<?= $d['id'] ?>"
onclick="return confirm('Hapus data?')"
class="bg-red-600 text-white px-3 py-1">
Hapus
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>