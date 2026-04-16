<?php
    session_start();
    include '../config/koneksi.php';

    if(!isset($_GET['id'])){
        header("Location: obat.php");
        exit();
    }

    $id = $_GET['id'];

    // ambil data lama
    $data = mysqli_query($conn, "SELECT * FROM obat WHERE id_obat='$id'");
    $row = mysqli_fetch_assoc($data);

    // UPDATE
    if(isset($_POST['update'])){
        $nama = $_POST['nama_obat'];
        $stok = $_POST['stok'];
        $keterangan = $_POST['keterangan'];

        // cek kalau upload gambar baru
        if(isset($_FILES['gambar']) && $_FILES['gambar']['name'] != ""){
            $gambar = $_FILES['gambar']['name'];
            $tmp = $_FILES['gambar']['tmp_name'];

            move_uploaded_file($tmp, "../assets/images/" . $gambar);
        } else {
            $gambar = $row['gambar']; // pakai gambar lama
        }

        mysqli_query($conn, "UPDATE obat SET 
            nama_obat='$nama',
            stok='$stok',
            keterangan='$keterangan',
            gambar='$gambar'
            WHERE id_obat='$id'
        ");

        header("Location: obat.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Obat</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/edit.css">
</head>
<body>

<h2>Edit Obat</h2>

<p class="back-link"><a href="obat.php">← Kembali</a></p>

<div class="card">
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="nama_obat" value="<?php echo $row['nama_obat']; ?>"><br><br>

    <input type="number" name="stok" value="<?php echo $row['stok']; ?>"><br><br>

    <textarea name="keterangan"><?php echo $row['keterangan']; ?></textarea><br><br>

    <p>Gambar sekarang:</p>
    <img src="../assets/images/<?php echo $row['gambar']; ?>" width="100"><br><br>

    <input type="file" name="gambar"><br><br>

            <button name="update">Update</button>
        </form>
    </div>

</body>
</html>
