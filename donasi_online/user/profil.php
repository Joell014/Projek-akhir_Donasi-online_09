<?php
session_start();
include "../config/koneksi.php";

$id = $_SESSION['id'];

$user = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT * FROM users
WHERE id='$id'
")
);

if(isset($_POST['update'])){

    $nama = $_POST['nama'];
    $email = $_POST['email'];

    mysqli_query($conn,"
    UPDATE users
    SET
    nama='$nama',
    email='$email'
    WHERE id='$id'
    ");

    $_SESSION['nama']=$nama;

    echo "<script>alert('Profil berhasil diubah')</script>";
}
?>

<form method="POST">

<input
type="text"
name="nama"
value="<?= $user['nama'] ?>">

<input
type="email"
name="email"
value="<?= $user['email'] ?>">

<button name="update">
Update
</button>

</form>