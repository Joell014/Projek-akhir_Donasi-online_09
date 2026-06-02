<?php
session_start();
include "../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT *
FROM campaign
WHERE id='$id'
")
);

$persen = 0;

if($data['target'] > 0){
    $persen = ($data['terkumpul'] / $data['target']) * 100;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Detail Campaign</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="container mx-auto p-10">

<img
src="../uploads/<?= $data['gambar'] ?>"
class="w-full h-96 object-cover rounded">

<h1 class="text-4xl font-bold mt-5">
<?= $data['judul'] ?>
</h1>

<p class="mt-5">
<?= $data['deskripsi'] ?>
</p>

<div class="mt-5">

<p>
Target :
Rp <?= number_format($data['target']) ?>
</p>

<p>
Terkumpul :
Rp <?= number_format($data['terkumpul']) ?>
</p>

<div class="w-full bg-gray-300 h-5 rounded mt-3">

<div
class="bg-green-600 h-5 rounded"
style="width:<?= $persen ?>%">
</div>

</div>

</div>

<a
href="donasi.php?id=<?= $data['id'] ?>"
class="bg-blue-600 text-white px-5 py-3 inline-block mt-5">

Donasi Sekarang

</a>

</div>

</body>
</html>