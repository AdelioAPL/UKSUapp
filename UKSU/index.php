<?php
session_start();

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header('Location: admin/dashboard.php');
        exit();
    } elseif ($_SESSION['role'] == 'siswa') {
        header('Location: siswa/dashboard.php');
        exit();
    }
}

header('Location: landing/landing.html');
exit();
?>
