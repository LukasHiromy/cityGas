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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h1>Import Data BBG Dari Excel</h1>
    <form class="" action="" method="post" enctype="multipart/form-data">
        <input type="file" name="excel" required value="">
        <button type="submit" name="import">Import</button>
    </form>

    <hr>
    <table border=1>
        <tr>
            <td>#</td>
            <td>Nama Sales</td>
            <td>Tanggal Pencapaian</td>
            <td>FID Sales</td>
            <td>FID Perumahan</td>
            <td>Nama Perumahan/Cluster/Kampung</td>
            <td>Jenis Pelaporan</td>
            <td>Kegiatan</td>
            <td>Status Calon Pelanggan</td>
            <td>Sumber BBG</td>
            <td>Nama Calon Pelanggan</td>
            <td>NIK KTP Calon Pelanggan</td>
            <td>No Registrasi Berlangganan</td>
            <td>Action</td>
        </tr>
        <?php require 'config.php';
        $i = 1;
        $rows = mysqli_query($conn, "SELECT * FROM pencapaianbbg");
        foreach ($rows as $row) :
        ?>
            <tr>
                <td> <?php echo $i++; ?> </td>
                <td> <?php echo $row["nama_sales"]; ?> </td>
                <td> <?php echo $row["tanggal_pencapaian"]; ?> </td>
                <td> <?php echo $row["fid_sales"]; ?> </td>
                <td> <?php echo $row["fid_perumahan"]; ?> </td>
                <td> <?php echo $row["nama_perumahan"]; ?> </td>
                <td> <?php echo $row["jenis_pelaporan"]; ?> </td>
                <td> <?php echo $row["kegiatan"]; ?> </td>
                <td> <?php echo $row["status_capel"]; ?> </td>
                <td> <?php echo $row["sumber_bbg"]; ?> </td>
                <td> <?php echo $row["nama_capel"]; ?> </td>
                <td> <?php echo $row["nik_capel"]; ?> </td>
                <td> <?php echo $row["no_regis"]; ?> </td>
                <td>
                    <a href="?edit=<?= $row['id'] ?>">Edit</a> |
                    <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php if (isset($_GET['edit'])): ?>
        <?php
        $id = $_GET['edit'];
        $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pencapaianbbg WHERE id='$id'"));
        ?>
        <h2>Edit Data Pencapaian BBG</h2>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">

            <label for="nama_sales">Nama Sales:</label>
            <input type="text" name="nama_sales" value="<?= $data['nama_sales'] ?>" required>

            <label for="tanggal_pencapaian">Tanggal Pencapaian:</label>
            <input type="date" name="tanggal_pencapaian" value="<?= $data['tanggal_pencapaian'] ?>" required>

            <label for="fid_sales">FID Sales:</label>
            <input type="text" name="fid_sales" value="<?= $data['fid_sales'] ?>" required>

            <label for="fid_perumahan">FID Perumahan:</label>
            <input type="text" name="fid_perumahan" value="<?= $data['fid_perumahan'] ?>" required>

            <label for="nama_perumahan">Nama Perumahan:</label>
            <input type="text" name="nama_perumahan" value="<?= $data['nama_perumahan'] ?>" required>

            <label for="jenis_pelaporan">Jenis Pelaporan:</label>
            <input type="text" name="jenis_pelaporan" value="<?= $data['jenis_pelaporan'] ?>" required>

            <label for="kegiatan">Kegiatan:</label>
            <input type="text" name="kegiatan" value="<?= $data['kegiatan'] ?>" required>

            <label for="status_capel">Status Calon Pelanggan:</label>
            <input type="text" name="status_capel" value="<?= $data['status_capel'] ?>" required>

            <label for="sumber_bbg">Sumber BBG:</label>
            <input type="text" name="sumber_bbg" value="<?= $data['sumber_bbg'] ?>" required>

            <label for="nama_capel">Nama Calon Pelanggan:</label>
            <input type="text" name="nama_capel" value="<?= $data['nama_capel'] ?>" required>

            <label for="nik_capel">NIK KTP Calon Pelanggan:</label>
            <input type="text" name="nik_capel" value="<?= $data['nik_capel'] ?>" required>

            <label for="no_regis">No Registrasi Berlangganan:</label>
            <input type="text" name="no_regis" value="<?= $data['no_regis'] ?>" required>

            <button type="submit" name="update">Update</button>
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
    <h1>Statistik Pencapaian BBG</h1>
    <p>Total Pencapaian: <strong><?php echo $totalPencapaian; ?></strong></p>

    <h2>Jumlah Pelanggan Berdasarkan Status</h2>
    <ul>
        <?php foreach ($statusData as $status => $jumlah) : ?>
            <li><?php echo $status; ?>: <?php echo $jumlah; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Sumber BBG Terbanyak</h2>
    <p><?php echo $sumberTerbanyak['sumber_bbg']; ?> dengan <?php echo $sumberTerbanyak['jumlah']; ?> pelanggan</p>

    <canvas id="chartStatus" width="400" height="200"></canvas>

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

</body>

</html>