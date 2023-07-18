<table id="tbl" class="table table-striped table-bordered">
    <thead class="bg-danger">
        <tr align="center">
            <th>No</th>
            <th>Nama Siswa</th>
            <th>NOSIS</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

        <?php
        include "../../../../app/config.php";
        $no1 = 1;
        $id1 = $_POST['id'];

        $data1 = mysqli_query($con, "SELECT * FROM kelas_siswa_detail a LEFT JOIN kelas_siswa b ON a.kode = b.kode LEFT JOIN siswa c ON a.id_siswa = c.id_siswa WHERE a.kode = '$id1' ");
        while ($tampil1 = mysqli_fetch_array($data1)) {
        ?>
            <tr>
                <td align="center"><?= $no1++; ?></td>
                <td><?= $tampil1['nm_siswa'] ?></td>
                <td align="center"><?= $tampil1['nrp'] ?></td>
                <td align="center">
                    <a class="btn btn-sm btn-danger" href="#" id="hapus" data-id="<?= $tampil1[0]; ?>"> <i class="fas fa-trash me-1"></i>Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>

</table>


<hr>