<?php
include '../../../../app/config.php';

$id = $_POST['id'];

$query = $con->query("DELETE FROM jadwal WHERE id_jadwal = '$id' ");
if ($query) {
    echo "Data Berhasil Dihapus";
} else {
    echo "Data Gagal Dihapus";
}
