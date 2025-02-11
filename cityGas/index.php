<?php
require 'config.php';

if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $nama_sales = $_POST["nama_sales"];
    $tanggal_pencapaian = $_POST["tanggal_pencapaian"];
    $fid_sales = $_POST["fid_sales"];
    $fid_perumahan = $_POST["fid_perumahan"];
    $nama_perumahan = $_POST["nama_perumahan"];
    $jenis_pelaporan = $_POST["jenis_pelaporan"];
    $kegiatan = $_POST["kegiatan"];
    $status_capel = $_POST["status_capel"];
    $sumber_bbg = $_POST["sumber_bbg"];
    $nama_capel = $_POST["nama_capel"];
    $nik_capel = $_POST["nik_capel"];
    $no_regis = $_POST["no_regis"];

    mysqli_query($conn, "UPDATE pencapaianbbg SET 
        nama_sales='$nama_sales', 
        tanggal_pencapaian='$tanggal_pencapaian', 
        fid_sales='$fid_sales', 
        fid_perumahan='$fid_perumahan', 
        nama_perumahan='$nama_perumahan', 
        jenis_pelaporan='$jenis_pelaporan', 
        kegiatan='$kegiatan', 
        status_capel='$status_capel', 
        sumber_bbg='$sumber_bbg', 
        nama_capel='$nama_capel', 
        nik_capel='$nik_capel', 
        no_regis='$no_regis' 
        WHERE id='$id'");

    header("Location: index.php");
}

// Hapus Data
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    mysqli_query($conn, "DELETE FROM pencapaianbbg WHERE id='$id'");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Gas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <!-- Logo & Title -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="logo.png" alt="City Gas" width="40" height="40" class="me-2">
                <span class="fw-bold">City Gas</span>
            </a>

            <!-- Navbar Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Pencapaian BBG</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Door To Door</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sosialisasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Open Booth</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kunjungan Pengurus Warga / PK</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Penanganan Keluhan</a></li>
                </ul>
            </div>

            <!-- Profile Section -->
            <div class="d-flex align-items-center">
                <!-- Icon Notifikasi -->
                <a href="#" class="text-white me-3">
                    <i class="bi bi-bell"></i>
                </a>
                <!-- Nama Pengguna -->
                <span class="text-white me-2">Lukas Hiromy Simatupang</span>
                <!-- Foto Profil -->
                <img src="profile.jpg" alt="Profile" class="rounded-circle" width="40" height="40">
                <!-- Icon Pengaturan -->
                <a href="#" class="text-white ms-3">
                    <i class="bi bi-gear"></i>
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Import Data BBG Dari Excel</h1>

        <!-- Form Upload File -->
        <form action="" method="post" enctype="multipart/form-data" class="mb-3">
            <div class="input-group">
                <input type="file" name="excel" class="form-control" required>
                <button type="submit" name="import" class="btn btn-primary">Import</button>
            </div>
        </form>

        <hr>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama Sales</th>
                        <th>Tanggal Pencapaian</th>
                        <th>FID Sales</th>
                        <th>FID Perumahan</th>
                        <th>Nama Perumahan</th>
                        <th>Jenis Pelaporan</th>
                        <th>Kegiatan</th>
                        <th>Status Calon Pelanggan</th>
                        <th>Sumber BBG</th>
                        <th>Nama Calon Pelanggan</th>
                        <th>NIK KTP</th>
                        <th>No Registrasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'config.php';
                    $i = 1;
                    $rows = mysqli_query($conn, "SELECT * FROM pencapaianbbg");
                    foreach ($rows as $row) :
                    ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $row["nama_sales"]; ?></td>
                            <td><?= $row["tanggal_pencapaian"]; ?></td>
                            <td><?= $row["fid_sales"]; ?></td>
                            <td><?= $row["fid_perumahan"]; ?></td>
                            <td><?= $row["nama_perumahan"]; ?></td>
                            <td><?= $row["jenis_pelaporan"]; ?></td>
                            <td><?= $row["kegiatan"]; ?></td>
                            <td><?= $row["status_capel"]; ?></td>
                            <td><?= $row["sumber_bbg"]; ?></td>
                            <td><?= $row["nama_capel"]; ?></td>
                            <td><?= $row["nik_capel"]; ?></td>
                            <td><?= $row["no_regis"]; ?></td>
                            <td>
                                <a href="?edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Form Edit Data -->
        <?php if (isset($_GET['edit'])): ?>
            <?php
            $id = $_GET['edit'];
            $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pencapaianbbg WHERE id='$id'"));
            ?>
            <h2 class="mt-4">Edit Data Pencapaian BBG</h2>
            <form action="" method="post" class="border p-3 rounded shadow-sm">
                <input type="hidden" name="id" value="<?= $data['id'] ?>">

                <div class="mb-2">
                    <label class="form-label">Nama Sales:</label>
                    <input type="text" name="nama_sales" class="form-control" value="<?= $data['nama_sales'] ?>" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Tanggal Pencapaian:</label>
                    <input type="date" name="tanggal_pencapaian" class="form-control" value="<?= $data['tanggal_pencapaian'] ?>" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">FID Sales:</label>
                    <input type="text" name="fid_sales" class="form-control" value="<?= $data['fid_sales'] ?>" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">FID Perumahan:</label>
                    <input type="text" name="fid_perumahan" class="form-control" value="<?= $data['fid_perumahan'] ?>" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Nama Perumahan:</label>
                    <input type="text" name="nama_perumahan" class="form-control" value="<?= $data['nama_perumahan'] ?>" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Jenis Pelaporan:</label>
                    <input type="text" name="jenis_pelaporan" class="form-control" value="<?= $data['jenis_pelaporan'] ?>" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Kegiatan:</label>
                    <input type="text" name="kegiatan" class="form-control" value="<?= $data['kegiatan'] ?>" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Status Calon Pelanggan:</label>
                    <input type="text" name="status_capel" class="form-control" value="<?= $data['status_capel'] ?>" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Sumber BBG:</label>
                    <input type="text" name="sumber_bbg" class="form-control" value="<?= $data['sumber_bbg'] ?>" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Nama Calon Pelanggan:</label>
                    <input type="text" name="nama_capel" class="form-control" value="<?= $data['nama_capel'] ?>" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">NIK KTP Calon Pelanggan:</label>
                    <input type="text" name="nik_capel" class="form-control" value="<?= $data['nik_capel'] ?>" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">No Registrasi Berlangganan:</label>
                    <input type="text" name="no_regis" class="form-control" value="<?= $data['no_regis'] ?>" required>
                </div>

                <button type="submit" name="update" class="btn btn-success">Update</button>
            </form>
        <?php endif; ?>

        <?php
        if (isset($_POST["import"])) {
            $fileName = $_FILES["excel"]["name"];
            $fileExtension = explode('.', $fileName);
            $fileExtension = strtolower(end($fileExtension));
            $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

            $targetDirectory = "uploads/" . $newFileName;
            move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

            error_reporting(0);
            ini_set('display_errors', 0);

            require 'excelReader/excel_reader2.php';
            require 'excelReader/SpreadsheetReader.php';

            $reader = new SpreadsheetReader($targetDirectory);
            $firstRow = true; // Variabel untuk menandai header

            foreach ($reader as $key => $row) {
                if ($firstRow) {
                    $firstRow = false;
                    continue;
                }

                $nama_sales = $row[1];
                $tanggal_pencapaian = $row[2];
                $fid_sales = $row[3];
                $fid_perumahan = $row[4];
                $nama_perumahan = $row[5];
                $jenis_pelaporan = $row[6];
                $kegiatan = $row[7];
                $status_capel = $row[8];
                $sumber_bbg = $row[9];
                $nama_capel = $row[10];
                $nik_capel = $row[11];
                $no_regis = $row[12];

                mysqli_query($conn, "INSERT INTO pencapaianbbg (nama_sales, tanggal_pencapaian, fid_sales, fid_perumahan, nama_perumahan, jenis_pelaporan, kegiatan, status_capel, sumber_bbg, nama_capel, nik_capel, no_regis) VALUES('$nama_sales', '$tanggal_pencapaian', '$fid_sales', '$fid_perumahan', '$nama_perumahan', '$jenis_pelaporan', '$kegiatan', '$status_capel', '$sumber_bbg', '$nama_capel', '$nik_capel', '$no_regis')");
            }
            echo
            "
			<script>
			alert('Succesfully Imported');
			document.location.href = '';
			</script>
			";
        }
        ?>

        <?php
        require 'config.php';

        // Total pencapaian
        $totalPencapaian = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM pencapaianbbg"))['total'];

        // Jumlah pelanggan berdasarkan status
        $statusCapel = mysqli_query($conn, "SELECT status_capel, COUNT(*) as jumlah FROM pencapaianbbg GROUP BY status_capel");
        $statusData = [];
        while ($row = mysqli_fetch_assoc($statusCapel)) {
            $statusData[$row['status_capel']] = $row['jumlah'];
        }

        // Sumber BBG yang paling banyak digunakan
        $sumberBBG = mysqli_query($conn, "SELECT sumber_bbg, COUNT(*) as jumlah FROM pencapaianbbg GROUP BY sumber_bbg ORDER BY jumlah DESC LIMIT 1");
        $sumberTerbanyak = mysqli_fetch_assoc($sumberBBG);

        ?>

        <div class="container py-5">
            <h1 class="text-center mb-4">Statistik Pencapaian BBG</h1>

            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-sm p-3 mb-4">
                        <h3 class="text-center">Total Pencapaian</h3>
                        <p class="text-center display-5 fw-bold text-primary"> <?php echo $totalPencapaian; ?> </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm p-3 mb-4">
                        <h3 class="text-center">Sumber BBG Terbanyak</h3>
                        <p class="text-center fs-4 fw-bold"> <?php echo $sumberTerbanyak['sumber_bbg']; ?> </p>
                        <p class="text-center text-muted"> dengan <?php echo $sumberTerbanyak['jumlah']; ?> pelanggan</p>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm p-3 mb-4">
                <h3 class="text-center">Jumlah Pelanggan Berdasarkan Status</h3>
                <canvas id="chartStatus"></canvas>
            </div>

            <script>
                fetch('data_statistik.php')
                    .then(response => response.json())
                    .then(data => {
                        const labels = data.map(item => item.status_capel);
                        const values = data.map(item => item.total);

                        const ctx = document.getElementById('chartStatus').getContext('2d');
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Jumlah Calon Pelanggan',
                                    data: values,
                                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    });
            </script>
        </div>
    </div>
</body>

</html>