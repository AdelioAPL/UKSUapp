<?php
session_start();
include '../config/koneksi.php';

if($_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit();
}

// ambil filter kelas
$kelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';

// query join + filter
if($kelas != ''){
    $data = mysqli_query($conn, "
        SELECT siswa.nama, siswa.kelas, user.username
        FROM siswa
        JOIN user ON siswa.id_user = user.id_user
        WHERE siswa.kelas = '$kelas'
    ");
} else {
    $data = mysqli_query($conn, "
        SELECT siswa.nama, siswa.kelas, user.username
        FROM siswa
        JOIN user ON siswa.id_user = user.id_user
    ");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <!-- FONT POPPINS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/dashboardadmin.css">
</head>
<body>

<div class="container">

    <!-- SIDEBAR -->
    <nav class="sidebar">
        <div class="logo">
            UK<span>SU</span>
        </div>

        <div class="menu">
            <a class="active">Dashboard</a>
            <a href="obat.php">Obat</a>
            <a href="request.php">Request Obat</a>
            <a href="pengambilan.php">Pengambilan & Riwayat</a>
        </div>
    </nav>

    <!-- MAIN -->
    <div class="main">

        <div class="top-bar">
            <h2>Dashboard Admin</h2>
            <a href="../auth/logout.php" class="logout">Logout</a>
        </div>

        <p>Daftar akun siswa yang terdaftar</p>

        <!-- FILTER -->
        <form method="GET">
            <label>Filter Kelas:</label>
            <select name="kelas">
                <option value="">-- Semua Kelas --</option>

                <option value="X SIJA 1" <?php if($kelas=='X SIJA 1') echo 'selected'; ?>>X SIJA 1</option>
                <option value="X SIJA 2" <?php if($kelas=='X SIJA 2') echo 'selected'; ?>>X SIJA 2</option>

                <option value="X TJAT 1" <?php if($kelas=='X TJAT 1') echo 'selected'; ?>>X TJAT 1</option>
                <option value="X TJAT 2" <?php if($kelas=='X TJAT 2') echo 'selected'; ?>>X TJAT 2</option>
                <option value="X TJAT 3" <?php if($kelas=='X TJAT 3') echo 'selected'; ?>>X TJAT 3</option>
                <option value="X TJAT 4" <?php if($kelas=='X TJAT 4') echo 'selected'; ?>>X TJAT 4</option>
                <option value="X TJAT 5" <?php if($kelas=='X TJAT 5') echo 'selected'; ?>>X TJAT 5</option>
                <option value="X TJAT 6" <?php if($kelas=='X TJAT 6') echo 'selected'; ?>>X TJAT 6</option>
            </select>

            <button type="submit">Tampilkan</button>
        </form>

        <!-- TABEL -->
        <div class="card">

            <table>
                <tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                </tr>

                <?php while($row = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['kelas']; ?></td>
                </tr>
                <?php } ?>

            </table>

        </div>

    </div>

</div>

</body>
</html>