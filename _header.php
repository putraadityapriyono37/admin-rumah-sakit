<?php
require_once "_config/config.php";
require "_assets/libs/vendor/autoload.php";
if (!isset($_SESSION['user'])) {
    echo "<script>window.location='" . base_url('auth/login.php') . "';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>RST WijayaKusuma Purwokerto</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('_assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('_assets/css/simple-sidebar.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('_assets/libs/DataTables/datatables.min.css'); ?>" rel="stylesheet">
    <link rel="icon" href="<?= base_url('_assets/rswk.jpg') ?>">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Styling Sidebar */
        #sidebar-wrapper {
            background-color: #343a40;
            color: #fff;
            min-height: 100vh;
        }

        .brand-item {
            padding: 20px;
            color: #1abc9c;
            text-align: center;
            font-size: 18px;
        }

        .brand-item i {
            margin-right: 10px;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav li {
            margin: 0;
            padding: 0;
        }

        .sidebar-nav li a {
            display: flex;
            /* Menggunakan flexbox untuk merapikan */
            align-items: center;
            /* Ikon dan teks sejajar secara vertikal */
            gap: 10px;
            /* Jarak antar ikon dan teks */
            padding: 12px 20px;
            /* Padding seragam */
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: background-color 0.3s;
        }

        .sidebar-nav li a i {
            flex-shrink: 0;
            /* Pastikan ikon tidak menyusut */
            width: 20px;
            /* Lebar konsisten untuk semua ikon */
            text-align: center;
        }

        .sidebar-nav li a:hover {
            background-color: #1abc9c;
            color: #fff;
        }

        .sidebar-nav li.sidebar-brand a {
            font-size: 18px;
            font-weight: bold;
            background-color: #1abc9c;
            color: white;
            text-align: center;
            display: block;
        }

        .sidebar-nav li.sidebar-brand a:hover {
            background-color: #343a40;
        }
    </style>
</head>

<body>
    <script src="<?= base_url('_assets/js/jquery.js') ?>"></script>
    <script src="<?= base_url('_assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('_assets/libs/DataTables/datatables.min.js') ?>"></script>
    <script src="<?= base_url('_assets/libs/vendor/ckeditor/ckeditor/ckeditor.js') ?>"></script>
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <h4 class="brand-item">
                    <i class="fas fa-hospital"></i>
                    <b>RST Wijayakusuma</b>
                </h4>
                <li>
                    <a href="<?= base_url('dashboard') ?>">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('pasien/data.php') ?>">
                        <i class="fas fa-user-injured"></i>Data Pasien
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('dokter/data.php') ?>">
                        <i class="fas fa-user-md"></i>Data Dokter
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('poliklinik/data.php') ?>">
                        <i class="fas fa-clinic-medical"></i>Data Poliklinik
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('obat/data.php') ?>">
                        <i class="fas fa-pills"></i>Data Obat
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('rekam_medis/data.php') ?>">
                        <i class="fas fa-file-medical"></i>Rekam Medis
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('auth/logout.php') ?>" class="text-danger">
                        <i class="fas fa-sign-out-alt" style="color: red"></i><span style="color: red"> Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">