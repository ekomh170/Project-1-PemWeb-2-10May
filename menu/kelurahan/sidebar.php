<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="../../dist/img/img_logo/logo_ryo.jpg " alt="Apps Puskesmas" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Apps CRUD Puskes</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../assets/foto/users/<?= $user['foto'] ?>" class="img-circle elevation-2" alt="User Image" style="height: 35px; height: 35px;">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $user['fullname']?></a>
            </div>
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="../index.php" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Halaman Utama
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../profile.php" class="nav-link">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>
                            Profile Kreator
                        </p>
                    </a>
                </li>

                <li class="nav-header">Menu Utama</li>

                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Master Data Medis
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../pasien/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Table Pasien</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../dokter/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Table Dokter</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../periksa/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Table Periksa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../kelurahan/index.php" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Table Kelurahan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../unit_kerja/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Table Unit Kerja</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Data Pengguna
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../users/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Table Users</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Menu Tambahan</li>
                <li class="nav-item">
                    <a href="https://www.linkedin.com/in/eko-haryono-290/" class="nav-link" target="_blank">
                        <i class="nav-icon fab fa-linkedin"></i>
                        <p>
                            Profile Linkedin
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="https://github.com/ekomh170" class="nav-link" target="_blank">
                        <i class="nav-icon fab fa-github"></i>
                        <p>
                            Profile Github
                        </p>
                    </a>
                </li>

                <li class="nav-header">Keluar Dari Akses Administrator</li>

                <li class="nav-item">
                    <a href="../../config/logout.php" class="nav-link">
                        <i class="nav-icon fas  fa-sign-out-alt"></i>
                        <p>
                            Log-Out 
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>