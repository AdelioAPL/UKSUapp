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

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #1e1e1e;
        }

        .container {
            display: flex;
        }

        .sidebar {
            width: 230px;
            background: #f5f5f5;
            height: 100vh;
            padding: 20px;
        }

        .logo {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .logo span {
            color: #3498db;
        }

        .menu a {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            text-decoration: none;
            color: black;
            border-radius: 8px;
        }

        .menu a.active {
            background: #cfe6f3;
        }

        .menu a:hover {
            background: #e3f2fd;
        }

        .main {
            flex: 1;
            padding: 30px;
            background: #eaeaea;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card {
            background: #dcdcdc;
            padding: 20px;
            border-radius: 12px;
            margin-top: 15px;
        }

        table {
            width: 100%;
            margin-top: 10px;
            background: white;
            border-radius: 8px;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
        }

        th {
            background: #ddd;
        }

        select, button {
            padding: 6px;
            margin-top: 10px;
        }

        .logout {
            text-decoration: none;
            background: #ff6b6b;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
        }

        a:hover {
            color: #c0392b;
        }

        a {
            color: #e74c3c;
            text-decoration: none;
            margin: 0 5px;
        }

        
    </style>
</head>
<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">
            UK<span>SU</span>
        </div>

        <div class="menu">
            <a class="active">Dashboard</a>
            <a href="obat.php">Obat</a>
            <a href="request.php">Request Obat</a>
            <a href="pengambilan.php">Pengambilan & Riwayat</a>
        </div>
    </div>

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