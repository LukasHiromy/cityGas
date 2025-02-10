<?php
    require 'config.php';

    // Ambil jumlah pelanggan berdasarkan status
    $query = mysqli_query($conn, "SELECT status_capel, COUNT(*) AS total FROM pencapaianbbg GROUP BY status_capel");
    $data = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    echo json_encode($data);
    ?>