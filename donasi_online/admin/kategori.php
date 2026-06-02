<?php
session_start();
include "../config/koneksi.php";

if(isset($_POST['simpan'])){

    $nama = $_POST['nama'];

    mysqli_query($conn,"
    INSERT INTO kategori(nama_kategori)
    VALUES('$nama')
    ");
}

$data = mysqli_query($conn,"
SELECT *
FROM kategori
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Kategori</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="container mx-auto p-5">

<h1 class="text-3xl font-bold mb-5">
Kategori Donasi
</h1>

<form method="POST">

<input
type="text"
name="nama"
placeholder="Nama kategori"
required
class="border p-2">

<button
name="simpan"
class="bg-green-600 text-white px-4 py-2">

Tambah

</button>

</form>

<table class="w-full mt-5 bg-white">

<tr class="bg-gray-200">
<th>ID</th>
<th>Nama</th>
<th>Aksi</th>
</tr>

<?php while($k=mysqli_fetch_assoc($data)){ ?>

<tr>

<td class="border p-2"><?= $k['id'] ?></td>

<td class="border p-2">
<?= $k['nama_kategori'] ?>
</td>

<td class="border p-2">

<a
href="hapus_kategori.php?id=<?= $k['id'] ?>"
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