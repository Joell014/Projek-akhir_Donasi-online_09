<?php

include "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($conn,"
DELETE FROM campaign
WHERE id='$id'
");

header("Location: campaign.php");