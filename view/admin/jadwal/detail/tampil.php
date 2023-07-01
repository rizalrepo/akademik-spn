<table id="tbl" class="table table-striped table-bordered">
    <thead class="bg-danger">
        <tr align="center">
            <th>No</th>
            <th>Ruang Kelas</th>
            <th>Hari</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

        <?php
        include "../../../../app/config.php";
        $no1 = 1;
        $id1 = $_POST['id'];

        $data1 = mysqli_query($con, "SELECT * FROM jadwal a LEFT JOIN kelas_siswa b ON a.id_kelas_siswa = b.id_kelas_siswa LEFT JOIN kelas c ON b.id_kelas = c.id_kelas WHERE a.id_gadik_mapel = '$id1' ");
        while ($tampil1 = mysqli_fetch_array($data1)) {
        ?>
            <tr>
                <td align="center"><?= $no1++; ?></td>
                <td align="center"><?= $tampil1['nm_kelas'] ?></td>
                <td align="center"><?= $tampil1['hari'] ?></td>
                <td align="center"><?= $tampil1['jam_mulai'] ?></td>
                <td align="center"><?= $tampil1['jam_selesai'] ?></td>
                <td align="center">
                    <a class="btn btn-sm btn-danger" href="#" id="hapus" data-id="<?= $tampil1[0]; ?>"> <i class="fas fa-trash me-1"></i>Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>

</table>


<hr>