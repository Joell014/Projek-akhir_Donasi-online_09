<?php
session_start();
include "../config/koneksi.php";

$cari = "";

if(isset($_GET['cari'])){

    $cari = $_GET['cari'];

    $data = mysqli_query($conn,"
    SELECT *
    FROM campaign
    WHERE judul LIKE '%$cari%'
    ");

}else{

    $data = mysqli_query($conn,"
    SELECT *
    FROM campaign
    ORDER BY id DESC
    ");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Campaign Donasi</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-5">

<h1 class="text-3xl font-bold mb-5">
Campaign Donasi
</h1>

<form>

<input
type="text"
name="cari"
placeholder="Cari Campaign..."
class="border p-2">

<button
class="bg-blue-600 text-white px-4 py-2">
Cari
</button>

</form>

<div class="grid md:grid-cols-3 gap-5 mt-5">

<?php while($c=mysqli_fetch_assoc($data)){ ?>

<div class="bg-white rounded shadow">

<img
src="../uploads/<?= $c['gambar'] ?>"
class="w-full h-48 object-cover">

<div class="p-4">

<h3 class="font-bold text-lg">
<?= $c['judul'] ?>
</h3>

<p>
Target :
Rp <?= number_format($c['target']) ?>
</p>

<p>
Terkumpul :
Rp <?= number_format($c['terkumpul']) ?>
</p>

<a
href="detail_campaign.php?id=<?= $c['id'] ?>"
class="bg-green-600 text-white px-4 py-2 inline-block mt-3">

Lihat Detail

</a>

</div>

</div>

<?php } ?>

</div>

</div>

</body>
</html>