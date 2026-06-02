<?php
session_start();
include "../config/koneksi.php";

$campaign_id = $_GET['id'];

if(isset($_POST['donasi'])){

    $user_id = $_SESSION['id'];
    $nominal = $_POST['nominal'];

    $bukti = $_FILES['bukti']['name'];
    $tmp = $_FILES['bukti']['tmp_name'];

    move_uploaded_file(
        $tmp,
        "../uploads/".$bukti
    );

    mysqli_query($conn,"
    INSERT INTO donasi
    (
    user_id,
    campaign_id,
    nominal,
    bukti_transfer
    )
    VALUES
    (
    '$user_id',
    '$campaign_id',
    '$nominal',
    '$bukti'
    )
    ");

    echo "
    <script>
    alert('Donasi berhasil dikirim');
    window.location='riwayat.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Donasi</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="max-w-lg mx-auto mt-10 bg-white p-5 shadow">

<h2 class="text-2xl font-bold mb-5">
Form Donasi
</h2>

<form method="POST" enctype="multipart/form-data">

<input
type="number"
name="nominal"
placeholder="Nominal Donasi"
required
class="w-full border p-2 mb-3">

<input
type="file"
name="bukti"
required
class="w-full border p-2 mb-3">

<button
name="donasi"
class="bg-green-600 text-white px-5 py-2">
Kirim Donasi
</button>

</form>

</div>

</body>
</html>