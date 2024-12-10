<?php 
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if(!isset($_SESSION['role'])) {
    if($_SESSION['role'] == 'admin') {
        header('Location: index.php');
        exit();
    }
}

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../public/css/styles.css" rel="stylesheet" />
        <link href="../public/css/custom.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <!-- <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div> -->
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">MENU UTAMA</div>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Pelayanan
                            </a>
                            <?php 
                            if (isset($_SESSION['role'])) {
                                if ($_SESSION['role'] == 'admin') {
                                    // Tampilkan tautan untuk admin dan dokter
                                    echo '<a class="nav-link" href="admin.php">
                                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                            Admin
                                        </a>';
                                    echo '<a class="nav-link" href="dokter.html">
                                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                            Dokter
                                        </a>';
                                } elseif ($_SESSION['role'] == 'dokter') {
                                    // Tampilkan tautan hanya untuk dokter
                                    echo '<a class="nav-link" href="dokter.php">
                                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                            Dokter
                                        </a>';
                                }
                            }
                            ?>
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['username']; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Selamat Datang, <?php echo $_SESSION['username']; ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Pelayanan</li>
                        </ol>
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="c-card border-primary">
                                    <div class="c-card-header ">
                                        <h3 class="c-card-title">Dokter</h3>
                                    </div>
                                    <div class="c-card-body d-flex justify-content-between">
                                        <h6>Dokter <?php echo $_SESSION['username']; ?></h6>
                                        <p>08:00 - 13:00</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="c-card border-success">
                                    <div class="c-card-header">
                                        <h3 class="c-card-title">Antrean Saat Ini</h3>
                                    </div>
                                    <div class="c-card-body d-flex justify-content-between">
                                        <h6>UMUM - 2</h6>
                                        <p>estimasi 20 menit</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="c-card border-danger">
                                    <div class="c-card-header">
                                        <h3 class="c-card-title">Antrean Terakhir</h3>

                                    </div>
                                    <div class="c-card-body d-flex justify-content-between">
                                        <h6>UMUM - 5</h6>
                                        <p>estimasi selesai 100 menit</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="c-card border-warning">
                                    <div class="c-card-header">
                                        <h3 class="c-card-title">Pengambilan Obat</h3>
                                        
                                    </div>
                                    <div class="c-card-body d-flex justify-content-between">
                                        <h6>UMUM - 1</h6>
                                        <p>estimasi 5 menit</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        Pendaftaran Layanan
                                    </div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="mb-3">
                                                <label for="chooseDoctor">Pilih Jadwal</label>
                                                <select name="chooseDoctor" class="form-select" id="chooseDoctor">
                                                    <option value="dokter1" class="d-flex justify-content-between">
                                                        <h6>Dokter 1</h6>
                                                        <p>(08:00 - 13:00)</p>
                                                    </option>
                                                    <option value="dokter2" class="d-flex justify-content-between">
                                                        <h6>Dokter 2</h6>
                                                        <p>(14:00 - 19:00)</p>
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="keluhan">Keluhan</label></label>
                                                <input type="text" class="form-control" id="keluhan">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Daftar Antrean
                                    </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr>
                                                    <th>Nama Pasien</th>
                                                    <th>Keluhan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Nama Pasien</th>
                                                    <th>Keluhan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td>Klinik TI</td>
                                                    <td>Dokter 1</td>
                                                    <td>pusing, sakit kepala</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../public/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../public/assets/demo/chart-area-demo.js"></script>
        <script src="../public/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../public/js/datatables-simple-demo.js"></script>
    </body>
</html>
