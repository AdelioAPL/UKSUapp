<?php
    session_start();
    include '../config/koneksi.php';

    // SETUJUI

    if(isset($_POST['disetujui'])){
        $id = $_POST['id_ambil'];
        $catatan = $_POST['catatan'];

        mysqli_query($conn, "
            UPDATE pengambilan 
            SET status='disetujui' 
            WHERE id_ambil='$id'
        ");

        mysqli_query($conn, "
            UPDATE obat 
            JOIN pengambilan ON obat.id_obat = pengambilan.id_obat
            SET obat.stok = obat.stok - 1
            WHERE pengambilan.id_ambil = '$id'
        ");

        mysqli_query($conn, "
            INSERT INTO detail_pengambilan(id_ambil, catatan)
            VALUES ('$id', '$catatan')
        ");

        header("Location: pengambilan.php");
        exit();
    }

    //delete
    if(isset($_GET['hapus'])){
        $id = $_GET['hapus'];

        // hapus detail dulu biar nggak nyangkut relasi
        mysqli_query($conn, "DELETE FROM detail_pengambilan WHERE id_ambil='$id'");

        // baru hapus utama
        mysqli_query($conn, "DELETE FROM pengambilan WHERE id_ambil='$id'");

        header("Location: pengambilan.php");
        exit();
    }

    // DITOLAK

    if(isset($_GET['ditolak'])){
        $id = $_GET['ditolak'];

        mysqli_query($conn, "
            UPDATE pengambilan 
            SET status='ditolak' 
            WHERE id_ambil='$id'
        ");

        header("Location: pengambilan.php");
        exit();
    }

    // QUERY 1: DATA MENUNGGU

    $data = mysqli_query($conn, "
        SELECT 
            pengambilan.id_ambil,
            siswa.nama,
            siswa.kelas,
            obat.nama_obat,
            pengambilan.tanggal,
            pengambilan.status
        FROM pengambilan
        JOIN siswa ON pengambilan.id_siswa = siswa.id_siswa
        JOIN obat ON pengambilan.id_obat = obat.id_obat
        WHERE pengambilan.status = 'menunggu'
        ORDER BY pengambilan.tanggal DESC
    ");


    // QUERY 2R: RIWAYAT

    $data_setuju = mysqli_query($conn, "
        SELECT 
            pengambilan.id_ambil,
            siswa.nama,
            siswa.kelas,
            obat.nama_obat,
            pengambilan.tanggal,
            detail_pengambilan.catatan
        FROM pengambilan
        JOIN siswa ON pengambilan.id_siswa = siswa.id_siswa
        JOIN obat ON pengambilan.id_obat = obat.id_obat
        LEFT JOIN detail_pengambilan 
            ON pengambilan.id_ambil = detail_pengambilan.id_ambil
        WHERE pengambilan.status = 'disetujui'
    ");


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- FONT POPPINS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/pengambilan.css">
    <title>Pengambilan & Riwayat - UKSU Admin</title>
</head>
<body>
    <div class="container">
                <!-- SIDEBAR -->
                <div class="sidebar">
                    <div class="logo">
                        UK<span>SU</span>
                    </div>

                    <div class="menu">
                        <a href="dashboard.php">Dashboard</a>
                        <a href="obat.php">Obat</a>
                        <a href="request.php">Request Obat</a>
                        <a href="pengambilan.php" class="active">Pengambilan & Riwayat</a>
                    </div>
                </div>
               <!-- MAIN -->
            <div class="main">
                        <div class="top-bar">
                            <h2>Pengambilan & Riwayat</h2>
                            <a href="../auth/logout.php" class="logout">Logout</a>
                        </div>

                        <div class="section">
                            <h2>Pengambilan</h2>

                <table>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Nama Obat</th>
                        <th>Tanggal Pengambilan</th>
                        <th>Status</th>
                    </tr>

                    <?php while($row = mysqli_fetch_assoc($data)) { ?>
                    <tr>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['kelas']; ?></td>
                        <td><?php echo $row['nama_obat']; ?></td>
                        <td><?php echo date('d M Y', strtotime($row['tanggal'])); ?></td>
                        <td>
                        <?php if($row['status'] == 'menunggu') { ?>
                        <form method="POST">
                            <input type="hidden" name="id_ambil" value="<?php echo $row['id_ambil']; ?>">
                            <input type="text" name="catatan" placeholder="Catatan..." required>
                            <button type="submit" name="disetujui">Terima</button>
                        </form>
                            <a href="pengambilan.php?ditolak=<?php echo $row['id_ambil']; ?>">Tolak</a>
                        <?php } else { ?>
                            Sudah diproses
                        <?php } ?>
                        </td>
                    </tr>
                        <?php } ?>
                    </table>
                        </div> <!-- end section -->

                    <div class='section'>
                            <h2>Riwayat Pengambilan</h2>
                            <table class='riwayat-table'>
                        <tr>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Obat</th>
                            <th>Tanggal</th>
                            <th>Catatan</th>
                        </tr>

                        <?php while($row = mysqli_fetch_assoc($data_setuju)) { ?>
                        <tr>
                            <td><?php echo $row['nama']?></td>
                            <td><?php echo $row['kelas']?></td>
                            <td><?php echo $row['nama_obat']?></td>
                            <td><?php echo date('d M Y', strtotime($row['tanggal']))?></td>
                            <td>
                            <?php echo $row['catatan'] ? $row['catatan'] : '-'; ?>
                            </td>
                            <td>
                                <a href="pengambilan.php?hapus=<?php echo $row['id_ambil']; ?>" 
                                onclick="return confirm('Yakin mau hapus data ini?')">
                                Hapus
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                        </table>
                        </div> <!-- end riwayat section -->

                </div> <!-- end main -->
        </div> <!-- end container -->

</body>
</html>
