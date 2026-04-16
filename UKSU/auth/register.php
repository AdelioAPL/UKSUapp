<?php
    session_start();
    include '../config/koneksi.php';

    $error = "";

    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama = $_POST['nama'];
        $kelas = $_POST['kelas'];

        // simpan ke tabel user
        mysqli_query($conn, "INSERT INTO user (username, password, role) 
        VALUES ('$username', '$password', 'siswa')");

        // ambil id_user terakhir
        $id_user = mysqli_insert_id($conn);

        // simpan ke tabel siswa
        mysqli_query($conn, "INSERT INTO siswa (id_user, nama, kelas) 
        VALUES ('$id_user', '$nama', '$kelas')");

        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register UKSU</title>
    <link rel="stylesheet" href="../assets/registercss.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body class="register-body">
<div class="register-container">
    <div class="register-card">
        <h2>Selamat datang</h2>
        <h1 class="logo">UKSU</h1>
        <p class="subtitle">Register Page</p>

        <?php if(isset($error) && $error != "") echo "<p class='error'>$error</p>"; ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            
            <select name="kelas" class="select-input" required>
                <option value="">-- Pilih Kelas --</option>
                <option value="X SIJA 1">X SIJA 1</option>
                <option value="X SIJA 2">X SIJA 2</option>
                <option value="X TJAT 1">X TJAT 1</option>
                <option value="X TJAT 2">X TJAT 2</option>
                <option value="X TJAT 3">X TJAT 3</option>
                <option value="X TJAT 4">X TJAT 4</option>
                <option value="X TJAT 5">X TJAT 5</option>
                <option value="X TJAT 6">X TJAT 6</option>
            </select>

            <p class="login-text">
                Sudah punya akun? <a href="login.php">Login</a>
            </p>

            <button type="submit" name="register">Register</button>
        </form>
    </div>
</div>
</body>
</html>

