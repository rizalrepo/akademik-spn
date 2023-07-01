<?php
include '../../../../app/config.php';

$id = $_POST['id'];

$query = $con->query("DELETE FROM kelas_siswa_detail WHERE id_kelas_siswa_detail = '$id' ");
if ($query) {
    echo "Data Berhasil Dihapus";
} else {
    echo "Data Gagal Dihapus";
}
