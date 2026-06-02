<?php
session_start();
include "../config/koneksi.php";

$data = mysqli_query($conn,"
SELECT * FROM users
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Kelola User</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="container mx-auto p-5">

<h1 class="text-3xl font-bold mb-5">
Kelola User
</h1>

<table class="w-full bg-white">

<tr class="bg-gray-200">
<th>ID</th>
<th>Nama</th>
<th>Email</th>
<th>Role</th>
<th>Aksi</th>
</tr>

<?php while($u=mysqli_fetch_assoc($data)){ ?>

<tr>

<td class="border p-2"><?= $u['id'] ?></td>
<td class="border p-2"><?= $u['nama'] ?></td>
<td class="border p-2"><?= $u['email'] ?></td>
<td class="border p-2"><?= $u['role'] ?></td>

<td class="border p-2">

<?php if($u['role']!='admin'){ ?>

<a
href="hapus_user.php?id=<?= $u['id'] ?>"
onclick="return confirm('Hapus user?')"
class="bg-red-600 text-white px-3 py-1">

Hapus

</a>

<?php } ?>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>