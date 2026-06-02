<?php
session_start();
include "../config/koneksi.php";

$id = $_SESSION['id'];

if(isset($_POST['ubah'])){

    $password =
    password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    mysqli_query($conn,"
    UPDATE users
    SET password='$password'
    WHERE id='$id'
    ");

    echo "Password berhasil diubah";
}
?>

<form method="POST">

<input
type="password"
name="password">

<button name="ubah">
Ubah Password
</button>

</form>