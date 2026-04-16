<?php
    $conn = mysqli_connect("localhost", "root", "", "uks_app");

    if(!$conn) {
        die("Koneksi Gagal: " . mysqli_connect_error());
    }
?>