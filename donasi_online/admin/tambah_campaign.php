<?php
session_start();
include "../config/koneksi.php";

if(!isset($_SESSION['id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

$kategori = mysqli_query($conn,"
SELECT * FROM kategori
ORDER BY nama_kategori ASC
");

if(isset($_POST['simpan'])){

    $kategori_id = $_POST['kategori_id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $target = $_POST['target'];
    $deadline = $_POST['deadline'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    $ext = strtolower(
        pathinfo(
            $gambar,
            PATHINFO_EXTENSION
        )
    );

    $allowed = ['jpg','jpeg','png'];

    if(!in_array($ext,$allowed)){
        echo "<script>alert('Format gambar harus JPG, JPEG, atau PNG');</script>";
    }else{

        $namaBaru =
        time().'_'.$gambar;

        move_uploaded_file(
            $tmp,
            "../uploads/".$namaBaru
        );

        mysqli_query($conn,"
        INSERT INTO campaign
        (
            kategori_id,
            judul,
            deskripsi,
            target,
            gambar,
            deadline
        )
        VALUES
        (
            '$kategori_id',
            '$judul',
            '$deskripsi',
            '$target',
            '$namaBaru',
            '$deadline'
        )
        ");

        echo "
        <script>
        alert('Campaign berhasil ditambahkan');
        window.location='campaign.php';
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Tambah Campaign</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

<div class="container mx-auto p-6">

<div class="bg-white p-6 rounded-lg shadow">

<h1 class="text-3xl font-bold mb-6">
Tambah Campaign
</h1>

<form
method="POST"
enctype="multipart/form-data"
class="space-y-4">

<div>

<label class="font-semibold">
Kategori
</label>

<select
name="kategori_id"
required
class="w-full border p-3 rounded">

<option value="">
Pilih Kategori
</option>

<?php while($k=mysqli_fetch_assoc($kategori)){ ?>

<option value="<?= $k['id']; ?>">
<?= $k['nama_kategori']; ?>
</option>

<?php } ?>

</select>

</div>

<div>

<label class="font-semibold">
Judul Campaign
</label>

<input
type="text"
name="judul"
required
class="w-full border p-3 rounded">

</div>

<div>

<label class="font-semibold">
Deskripsi
</label>

<textarea
name="deskripsi"
rows="5"
required
class="w-full border p-3 rounded"></textarea>

</div>

<div>

<label class="font-semibold">
Target Donasi
</label>

<input
type="number"
name="target"
required
class="w-full border p-3 rounded">

</div>

<div>

<label class="font-semibold">
Deadline
</label>

<input
type="date"
name="deadline"
required
class="w-full border p-3 rounded">

</div>

<div>

<label class="font-semibold">
Gambar Campaign
</label>

<input
type="file"
name="gambar"
accept=".jpg,.jpeg,.png"
required
class="w-full border p-3 rounded"
onchange="previewImage(event)">

</div>

<div>

<img
id="preview"
class="hidden w-80 rounded shadow">

</div>

<button
type="submit"
name="simpan"
class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">

Simpan Campaign

</button>

<a
href="campaign.php"
class="bg-gray-500 text-white px-6 py-3 rounded">

Kembali

</a>

</form>

</div>

</div>

<script>

function previewImage(event){

    let reader = new FileReader();

    reader.onload = function(){

        let output =
        document.getElementById('preview');

        output.src = reader.result;

        output.classList.remove('hidden');
    }

    reader.readAsDataURL(
        event.target.files[0]
    );
}

</script>

</body>
</html>