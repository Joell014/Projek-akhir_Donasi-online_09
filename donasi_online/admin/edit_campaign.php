<?php
session_start();
include "../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT * FROM campaign
WHERE id='$id'
")
);

$kategori = mysqli_query($conn,"
SELECT * FROM kategori
");

if(isset($_POST['update'])){

    $kategori_id = $_POST['kategori_id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $target = $_POST['target'];
    $deadline = $_POST['deadline'];

    if($_FILES['gambar']['name'] != ''){

        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        move_uploaded_file(
            $tmp,
            "../uploads/".$gambar
        );

        mysqli_query($conn,"
        UPDATE campaign SET
        kategori_id='$kategori_id',
        judul='$judul',
        deskripsi='$deskripsi',
        target='$target',
        gambar='$gambar',
        deadline='$deadline'
        WHERE id='$id'
        ");

    }else{

        mysqli_query($conn,"
        UPDATE campaign SET
        kategori_id='$kategori_id',
        judul='$judul',
        deskripsi='$deskripsi',
        target='$target',
        deadline='$deadline'
        WHERE id='$id'
        ");

    }

    header("Location: campaign.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Campaign</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="max-w-2xl mx-auto mt-10 bg-white p-5 shadow">

<h2 class="text-2xl font-bold mb-5">
Edit Campaign
</h2>

<form method="POST" enctype="multipart/form-data">

<select
name="kategori_id"
class="w-full border p-2 mb-3">

<?php while($k=mysqli_fetch_assoc($kategori)){ ?>

<option
value="<?= $k['id'] ?>"
<?= $k['id']==$data['kategori_id']?'selected':'' ?>>

<?= $k['nama_kategori'] ?>

</option>

<?php } ?>

</select>

<input
type="text"
name="judul"
value="<?= $data['judul'] ?>"
class="w-full border p-2 mb-3">

<textarea
name="deskripsi"
class="w-full border p-2 mb-3"><?= $data['deskripsi'] ?></textarea>

<input
type="number"
name="target"
value="<?= $data['target'] ?>"
class="w-full border p-2 mb-3">

<input
type="date"
name="deadline"
value="<?= $data['deadline'] ?>"
class="w-full border p-2 mb-3">

<img
src="../uploads/<?= $data['gambar'] ?>"
width="150"
class="mb-3">

<input
type="file"
name="gambar"
class="w-full border p-2 mb-3">

<button
name="update"
class="bg-blue-600 text-white px-5 py-2">
Update
</button>

</form>

</div>

</body>
</html>