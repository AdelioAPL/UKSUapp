<?php
session_start();
include '../config/koneksi.php';

// cek admin
if($_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit();
}

// TAMBAH OBAT
if(isset($_POST['tambah'])){
    $nama = $_POST['nama_obat'];
    $stok = $_POST['stok'];
    $keterangan = $_POST['keterangan'];

    // HANDLE GAMBAR
    if(isset($_FILES['gambar']) && $_FILES['gambar']['name'] != ""){
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        move_uploaded_file($tmp, "../assets/images/" . $gambar);
    } else {
        $gambar = "";
    }

    mysqli_query($conn, "INSERT INTO obat (nama_obat, stok, keterangan, gambar)
    VALUES ('$nama', '$stok', '$keterangan', '$gambar')");
}

// HAPUS
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM obat WHERE id_obat='$id'");
}

// AMBIL DATA
$data = mysqli_query($conn, "SELECT * FROM obat");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Obat</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/obatcss.css">
</head>
<body>

<div class="container">
    <div class="sidebar">
        <div class="logo">
            UK<span>SU</span>
        </div>

        <div class="menu">
            <a href="dashboard.php">Dashboard</a>
            <a href="obat.php" class="active">Obat</a>
            <a href="request.php">Request Obat</a>
            <a href="pengambilan.php">Pengambilan & Riwayat</a>
        </div>
    </div>

    <div class="main">

        <div class="top-bar">
            <h2>Manajemen Obat</h2>
            <a href="../auth/logout.php" class="logout">Logout</a>
        </div>

        <!-- FORM -->
    <div class="card">
        <h3>Tambah Obat</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="nama_obat" placeholder="Nama Obat" required>
            <input type="number" name="stok" placeholder="Stok" required>
            <textarea name="keterangan" placeholder="Keterangan"></textarea>

            <input type="file" name="gambar">

            <button name="tambah">Tambah</button>
        </form>
    </div>

    <!-- TABEL -->
     <h3>Daftar Obat</h3>
    <div class="card">

        <table>
            <tr>
                <th>Gambar</th>
                <th>Nama Obat</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td>
                    <?php if($row['gambar'] != "") { ?>
                        <img src="../assets/images/<?php echo $row['gambar']; ?>" width="80">
                    <?php } else { ?>
                        Tidak ada
                    <?php } ?>
                </td>
                <td><?php echo $row['nama_obat']; ?></td>
                <td><?php echo $row['stok']; ?></td>
                <td><?php echo $row['keterangan']; ?></td>
                <td>
                    <a href="edit_obat.php?id=<?php echo $row['id_obat']; ?>">Edit</a> |
                    <a href="obat.php?hapus=<?php echo $row['id_obat']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>

        </table>
    </div>
        </div>
    </div>
</div>
</body>
</html>
