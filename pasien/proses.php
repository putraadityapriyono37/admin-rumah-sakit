<?php
require_once "../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfieldDependencyException;

if (isset($_POST['tambah'])) {
    $uuid = Uuid::uuid4()->toString();
    $identitas = trim(mysqli_real_escape_string($con, $_POST['identitas']));
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
    $jk = trim(mysqli_real_escape_string($con, $_POST['jk']));
    $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
    $telp = trim(mysqli_real_escape_string($con, $_POST['telp']));
    $sql_cek_identitas = mysqli_query($con, "SELECT * FROM tb_pasien WHERE nomor_identitas = '$identitas'") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_cek_identitas) > 0) {
        echo "<script>alert('Nomor Identitas sudah ada!');window.location='tambah.php'</script>";
    } else {
        mysqli_query($con, "INSERT INTO tb_pasien (id_pasien, nomor_identitas, nama_pasien, jenis_kelamin, alamat, no_telp) VALUES ('$uuid', '$identitas', '$nama', '$jk', '$alamat', '$telp')") or die(mysqli_error($con));
        echo "<script>window.location='data.php'</script>";
    }
} else if (isset($_POST['import'])) {
    $file = $_FILES['file']['name'];
    $ekstensi = explode(".", $file);
    $file_name = "file-" . round(microtime(true)) . "." . end($ekstensi);
    $sumber = $_FILES['file']['tmp_name'];
    $target_dir = "../_file/";
    $target_file = $target_dir . $file_name;
    $upload = move_uploaded_file($sumber, $target_file);

    if ($upload) {
        $spreadsheet = IOFactory::load($target_file);
        $all_data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $sql = "INSERT INTO tb_pasien (id_pasien, nomor_identitas, nama_pasien, 
        jenis_kelamin, alamat, no_telp) VALUES ";
        $values = [];
        $duplicates = []; // Array untuk menyimpan data duplikat

        for ($i = 3; $i <= count($all_data); $i++) {
            $uuid = Uuid::uuid4()->toString();
            $no_id = $all_data[$i]['A'];
            $nama = $all_data[$i]['B'];
            $jk = $all_data[$i]['C'];
            $alamat = $all_data[$i]['D'];
            $telp = $all_data[$i]['E'];

            // Cek apakah nomor_identitas sudah ada di database
            $check_sql = "SELECT COUNT(*) as count FROM tb_pasien WHERE nomor_identitas = '$no_id'";
            $check_result = mysqli_query($con, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);

            if ($check_row['count'] == 0) { // Jika tidak ada data dengan nomor_identitas yang sama
                $values[] = "('$uuid', '$no_id', '$nama', '$jk', '$alamat', '$telp')";
            } else {
                $duplicates[] = $no_id; // Tambahkan nomor_identitas duplikat ke dalam array
            }
        }

        // Hanya eksekusi query jika ada data baru yang akan dimasukkan
        if (!empty($values)) {
            $sql .= implode(",", $values);
            mysqli_query($con, $sql) or die(mysqli_error($con));
        }

        unlink($target_file);

        // Jika ada data duplikat, tampilkan alert
        if (!empty($duplicates)) {
            $duplicate_list = implode(", ", $duplicates);
            echo "<script>alert('Data dengan nomor identitas berikut sudah ada: $duplicate_list');</script>";
        } else {
            echo "<script>alert('Data berhasil diimport!');</script>";
        }

        echo "<script>window.location='data.php'</script>";
    } else {
        echo "Upload gagal.";
    }
}
