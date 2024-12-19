<?php
include_once('../_header.php');
require_once "../_config/config.php";

$id = $_GET['id']; // Ambil ID dari parameter URL
$query = "SELECT * FROM tb_rekammedis 
    INNER JOIN tb_pasien ON tb_rekammedis.id_pasien = tb_pasien.id_pasien
    INNER JOIN tb_dokter ON tb_rekammedis.id_dokter = tb_dokter.id_dokter
    INNER JOIN tb_poli ON tb_rekammedis.id_poli = tb_poli.id_poli
    WHERE id_rm = '$id'";
$sql_rm = mysqli_query($con, $query) or die(mysqli_error($con));
$data = mysqli_fetch_assoc($sql_rm);

// Ambil data obat yang dipilih
$sql_obat_terpilih = mysqli_query($con, "SELECT id_obat FROM tb_rm_obat WHERE id_rm = '$id'") or die(mysqli_error($con));
$obat_terpilih = [];
while ($row = mysqli_fetch_assoc($sql_obat_terpilih)) {
    $obat_terpilih[] = $row['id_obat'];
}

// Ambil data referensi (pasien, dokter, poli, obat)
$pasien = mysqli_query($con, "SELECT * FROM tb_pasien") or die(mysqli_error($con));
$dokter = mysqli_query($con, "SELECT * FROM tb_dokter") or die(mysqli_error($con));
$poli = mysqli_query($con, "SELECT * FROM tb_poli") or die(mysqli_error($con));
$obat = mysqli_query($con, "SELECT * FROM tb_obat") or die(mysqli_error($con));
?>

<div class="box">
    <h1>Edit Rekam Medis</h1>
    <h4>
        <small>Form Edit Rekam Medis</small>
    </h4>
    <form action="proses.php" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="form-group">
            <label for="pasien">Pasien</label>
            <select name="pasien" id="pasien" class="form-control" required>
                <?php while ($row = mysqli_fetch_assoc($pasien)) { ?>
                    <option value="<?= $row['id_pasien'] ?>" <?= $row['id_pasien'] == $data['id_pasien'] ? 'selected' : '' ?>><?= $row['nama_pasien'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="keluhan">Keluhan</label>
            <textarea name="keluhan" id="keluhan" class="form-control" required><?= $data['keluhan'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="dokter">Dokter</label>
            <select name="dokter" id="dokter" class="form-control" required>
                <?php while ($row = mysqli_fetch_assoc($dokter)) { ?>
                    <option value="<?= $row['id_dokter'] ?>" <?= $row['id_dokter'] == $data['id_dokter'] ? 'selected' : '' ?>><?= $row['nama_dokter'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="diagnosa">Diagnosa</label>
            <textarea name="diagnosa" id="diagnosa" class="form-control" required><?= $data['diagnosa'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="poli">Poliklinik</label>
            <select name="poli" id="poli" class="form-control" required>
                <?php while ($row = mysqli_fetch_assoc($poli)) { ?>
                    <option value="<?= $row['id_poli'] ?>" <?= $row['id_poli'] == $data['id_poli'] ? 'selected' : '' ?>><?= $row['nama_poli'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="tgl">Tanggal Periksa</label>
            <input type="date" name="tgl" id="tgl" class="form-control" value="<?= $data['tgl_periksa'] ?>" required>
        </div>
        <div class="form-group">
            <label for="obat">Obat</label>
            <select name="obat[]" id="obat" class="form-control" multiple>
                <?php while ($row = mysqli_fetch_assoc($obat)) { ?>
                    <option value="<?= $row['id_obat'] ?>" <?= in_array($row['id_obat'], $obat_terpilih) ? 'selected' : '' ?>><?= $row['nama_obat'] ?></option>
                <?php } ?>
            </select>
        </div>
        <input type="submit" name="edit" value="Simpan" class="btn btn-success">
    </form>
    <script>
        CKEDITOR.replace('keluhan');
    </script>
</div>

<?php include_once('../_footer.php'); ?>