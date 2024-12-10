<?php 
session_start();

require_once '../controllers/AuthController.php';
require_once '../controllers/AntrianController.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if(isset($_POST['antrean'])) {
    $username = $_SESSION['user_id'];
    $dokterId = $_POST['chooseDoctor'];
    $tanggal = $_POST['date'];
    $keluhan = $_POST['keluhan'];

    $controller = new AntrianController($db);
    $controller->addQueue($username, $dokterId, $tanggal, $keluhan);

    echo '<script>alert("Antrean berhasil ditambahkan");</script>';
    echo '<script>window.location.href = "index.php";</script>';
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
            <a class="navbar-brand ps-3" href="index.php">Klinik TI</a>
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
                            <a class="nav-link" href="index.php">
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
                                                <?php 
                                                require_once '../database/connection.php';

                                                try {
                                                    $sql = "SELECT * FROM dokter";
                                                    $stmt = $db->query($sql); 
                                                    $dokters = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                    if ($dokters) {
                                                        foreach ($dokters as $row) {
                                                            echo '<option value="' . $row['id'] . '">' . $row['nama'] . ' (' . ($row['jadwal'] == '"pagi"' ? "08:00-13:00" : "14:00-19:00") . ')' . '</option>';

                                                        }
                                                    } else {
                                                        echo '<option value="">Tidak ada dokter tersedia</option>';
                                                    }
                                                } catch (PDOException $e) {
                                                    echo "Kesalahan: " . $e->getMessage();
                                                }
                                                ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="date">Pilih tanggal</label>
                                                <input type="date" name="date" class="form-control" id="date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="keluhan">Keluhan</label></label>
                                                <input type="text" name="keluhan" class="form-control" id="keluhan">
                                            </div>
                                            <button type="submit" name="antrean" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Riwayat Pendaftaranmu
                                    </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr>
                                                    <th>Nama Klinik</th>
                                                    <th>Dokter</th>
                                                    <th>Keluhan</th>
                                                    <th>Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                <th>Nama Klinik</th>
                                                    <th>Dokter</th>
                                                    <th>Keluhan</th>
                                                    <th>Tanggal</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td>Klinik TI</td>
                                                    <td>Dokter 1</td>
                                                    <td>pusing, sakit kepala</td>
                                                    <td>2011/04/25</td>
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
        <button class="btn btn-primary"
            type="button"
            style="position: fixed;
            top: 4em;
            right: 1em;"
            data-bs-toggle="modal" data-bs-target="#exampleModal">
            Resep Kamu
        </button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Resep Kamu</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <?php 
                        require_once '../controllers/ResepController.php';

                        $resepController = new ResepController($db);
                        $resep = $resepController->getByPasienId($_SESSION['user_id']);

                        foreach ($resep as $row) {
                            echo '<div class="card mb-3">';
                            echo '<div class="card-header">';
                            echo '<h5 class="card-title">KLINIK TI</h5>';
                            echo '</div>';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . $row['obat'] . '</h5>';
                            echo '<p class="card-text">' . $row['ketentuan'] . '</p>';
                            echo '<small class="text-muted">Resep otomatis dihapus setelah 24 jam</small>';
                            echo '</div>';
                            echo '<div class="card-footer">';
                            echo '<small class="text-muted">Resep dibuat pada </small>';
                            echo '<small class="text-muted">' . date("d F Y, H:i", strtotime($row['tanggal'])) . '</small>';
                            echo '</div>';
                            echo '</div>';
                        }
                    
                    ?>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
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
