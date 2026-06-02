<?php
session_start();
include "../config/koneksi.php";

$idUser = $_SESSION['id'];

$data = mysqli_query($conn,"
SELECT *
FROM notifikasi
WHERE user_id='$idUser'
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Notifikasi</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="container mx-auto p-5">

<h1 class="text-3xl font-bold mb-5">
Notifikasi
</h1>

<?php while($n=mysqli_fetch_assoc($data)){ ?>

<div class="bg-white p-4 shadow mb-3">

<p><?= $n['pesan'] ?></p>

<small>
<?= $n['created_at'] ?>
</small>

</div>

<?php } ?>

</div>

</body>
</html>