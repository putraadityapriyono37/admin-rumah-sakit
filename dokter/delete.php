<?php
require_once "../_config/config.php";
if (!isset($_POST['checked'])) {
    echo "<script>alert('Tidak ada data yang dipilih!'); window.location='data.php';</script>";
} else {
    $chk = $_POST['checked'];
    foreach ($chk as $id) {
        $sql = mysqli_query($con, "DELETE FROM tb_dokter WHERE id_dokter = '$id'") or die(mysqli_error($con));
    }
    if ($sql) {
        echo "<script>alert('" . count($chk) . " Data berhasil dihapus'); window.location='data.php';</script>";
    } else {
        echo "<script>alert('Gagal hapus data, coba lagi');</script>";
    }
}
