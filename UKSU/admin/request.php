<?php
    session_start();
    include '../config/koneksi.php';

    //Ambil data + siswa
    $data = mysqli_query($conn, "SELECT request_obat.*, siswa.nama, siswa.kelas FROM request_obat JOIN siswa ON request_obat.id_siswa = siswa.id_siswa
    ORDER BY request_obat.id_request DESC");

    //disetujui
    if(isset($_GET['disetujui'])){
        $id = $_GET['disetujui'];

        mysqli_query($conn, "UPDATE request_obat SET status = 'disetujui' WHERE id_request = '$id'");

        header("Location: request.php");
        exit();
    }

    //ditolak
    if(isset($_GET['ditolak'])){
        $id = $_GET['ditolak'];

        mysqli_query($conn, "UPDATE request_obat SET status = 'ditolak' WHERE id_request = '$id'");
        header("Location: request.php");
        exit();
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- FONT POPPINS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/request.css">
    <title>Request Obat - UKSU Admin</title>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                UK<span>SU</span>
            </div>

            <div class="menu">
                <a href="dashboard.php">Dashboard</a>
                <a href="obat.php">Obat</a>
                <a class="active" href="request.php">Request Obat</a>
                <a href="pengambilan.php">Pengambilan & Riwayat</a>
            </div>
        </div>

        <!-- MAIN -->
        <div class="main">
            <div class="top-bar">
                <h2>Request Obat</h2>
                <a href="../auth/logout.php" class="logout">Logout</a>
            </div>

        <div class="card">
            <table>
            <tr>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Nama Obat</th>
                <th>Alasan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['kelas']; ?></td>
                <td><?php echo $row['nama_obat']; ?></td>
                <td><?php echo $row['keterangan']; ?></td>
                <td>
                    <span class="status <?php echo strtolower($row['status']); ?>"><?php echo ucfirst($row['status']); ?></span>
                </td>
                <td class="aksi">
                    <?php if($row['status'] == 'menunggu') { ?>
                        <a href="request.php?disetujui=<?php echo $row['id_request']; ?>">Setujui</a> |
                        <a href="request.php?ditolak=<?php echo $row['id_request']; ?>">Tolak</a>
                    <?php } else { ?>
                        -
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
            </table>
        </div>
            </div> <!-- end main -->
        </div> <!-- end container -->



</body>
</html>