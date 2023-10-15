<?php
require '../../../app/config.php';
// Ambil id_siswa dari permintaan GET
$id_siswa = $_GET['id_siswa'];

$data = $con->query("SELECT * FROM konseling a LEFT JOIN siswa b ON a.id_siswa = b.id_siswa LEFT JOIN asuhan c ON a.id_asuhan = c.id_asuhan WHERE a.id_siswa = '$id_siswa' ORDER BY a.id_konseling DESC");

if ($data->num_rows > 0) {
    echo '
    <div class="table-responsive">
        <table id="tbl" class="table table-bordered table-hover table-striped dataTable">
            <thead class="bg-danger">
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>NOSIS</th>
                    <th>Tanggal</th>
                    <th>Tahun Asuhan</th>
                </tr>
            </thead>

            <tbody>';

    $no = 1; // Inisialisasi variabel nomor urut
    while ($row2 = $data->fetch_array()) {
        echo '<tr>
                <td align="center" width="5%">' . $no++ . '</td>
                <td>' . $row2['nm_siswa'] . '</td>
                <td align="center">' . $row2['nrp'] . '</td>
                <td align="center">' . tgl($row2['tgl_konseling']) . '</td>
                <td align="center">Tahun ' . $row2['tahun'] . ' ' . $row2['gelombang'] . '</td>
            </tr>';
    }
    echo '</tbody></table></div>';
} else {
    echo "<span>Tidak ada data Histroy Konseling untuk Siswa ini.</span>";
}

$con->close();
