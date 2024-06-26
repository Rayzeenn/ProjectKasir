<?php
require 'function.php';
$h1 = mysqli_query($c, "SELECT * FROM pelanggan");
$h2 = mysqli_num_rows($h1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <a class="navbar-brand ps-3" href="index.php">Kasirku</a>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-address-book"></i></div>
                            Order
                        </a>
                        <a class="nav-link" href="stock.php">
                            <div class="sb-nav-link-icon"><i class="fab fa-dropbox"></i></div>
                            Stock Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-dolly-flatbed"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="pelanggan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-dolly-flatbed"></i></div>
                            Kelola Pelanggan
                        </a>
                        <a class="nav-link" href="lo.html">
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Pelanggan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active ">Selamat Datang</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Jumlah Pelanggan : <?= $h2 ?></div>
                            </div>
                        </div>
                        <div class="">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info col-xl-2 mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Tambah Pelanggan
                            </button>
                        </div>

                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Barang
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pelanggan</th>
                                        <th>No. Telepon</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $get = mysqli_query($c, "SELECT * FROM pelanggan");
                                    $i = 1;

                                    while ($p = mysqli_fetch_array($get)) {
                                        $namapelanggan = $p['namapelanggan'];
                                        $notelp = $p['notelp'];
                                        $alamat = $p['alamat'];
                                        $idpl = $p['idpelanggan'];

                                    ?>

                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $namapelanggan; ?></td>
                                            <td><?= $notelp; ?></td>
                                            <td><?= $alamat; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning col-xl-3" data-bs-toggle="modal" data-bs-target="#edit<?= $idpl; ?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger col-xl-3" data-bs-toggle="modal" data-bs-target="#delete<?= $idpl; ?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="edit<?=$idpl; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $namapelanggan; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form method="post">

                                                        <div class="modal-body">
                                                            <input type="text" name="namapelanggan" class="form-control" placeholder="Nama Pelanggan" value="<?= $namapelanggan; ?>">
                                                            <input type="text" name="notelp" class="form-control mt-2" placeholder="No. Telp" value="<?= $notelp; ?>">
                                                            <input type="num" name="alamat" class="form-control mt-2" placeholder="Alamat" value="<?= $alamat; ?>">
                                                            <input type="hidden" name="idpl" value="<?= $idpl; ?>">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="editpelanggan">Submit</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="delete<?= $idpl; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $namapelanggan; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form method="post">

                                                        <div class="modal-body">
                                                            Apakah Anda Yakin?
                                                            <input type="hidden" name="idpl" value="<?= $idpl; ?>">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="hapuspelanggan">Submit</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }; //end of while
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post">

                <div class="modal-body">
                    <input type="text" name="namapelanggan" class="form-control" placeholder="Nama Pelanggan">
                    <input type="text" name="notelp" class="form-control mt-2" placeholder="No. Telepon">
                    <input type="num" name="alamat" class="form-control mt-2" placeholder="Alamat">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="tambahpelanggan">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>




</html>