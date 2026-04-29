<?php

    session_start();
    include '../config/koneksi.php';

    $error = ""; // <-- tambahin ini

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT id_user, password, role FROM user WHERE username=?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id_user, $hashed_password, $role);
    mysqli_stmt_fetch($stmt);

    if($password == $hashed_password) {
        $_SESSION['id_user'] = $id_user;
        $_SESSION['role'] = $role;
        $_SESSION['id_siswa'] = $row['id_siswa'];
        $_SESSION['nama'] = $row['nama'];

        if ($role == 'admin') {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../siswa/dashboard.php");
        }
        exit();
    } else {
    $error = "Username / Password salah!";
    }

    }
    
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login UKSU</title>
    <link rel="stylesheet" href="../assets/logincss.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap">
</head>
<body class="login-body">
<div class="login-container">
    <div class="login-card">
        <h2>Selamat datang</h2>
        <h1 class="logo"UKSU</h1>
        <p class="subtitle">Login Page</p>

        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Nama Lengkap" required>
            <input type="password" name="password" placeholder="Password" required>

            <p class="register-text">
                Tidak punya akun? <a href="register.php">Register</a>
            </p>

            <button type="submit" name="login">Submit</button>
        </form>
    </div>
</div>

</body>
</html>