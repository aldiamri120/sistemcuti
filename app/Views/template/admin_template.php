<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sistem Cuti</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="System absensi online" name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">
    <!-- jstree css -->
    <link href="/assets/css/vendor/jstree.min.css" rel="stylesheet" type="text/css">

    <!-- third party css -->
    <link href="/assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/vendor/select.bootstrap5.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
    <!-- third party css end -->

    <!-- Datatables css -->
    <link href="/assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/app-modern.min.css" rel="stylesheet" type="text/css" id="light-style">
    <link href="/assets/css/app-modern-dark.min.css" rel="stylesheet" type="text/css" id="dark-style">

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

</head>

<body data-layout="detached" data-layout-config='{"darkMode":false}'>

    <!-- Topbar Start -->
    <div class="navbar-custom topnav-navbar topnav-navbar-dark">
        <div class="container-fluid">

            <!-- LOGO -->
            <a href="/home" class="topnav-logo">
                <div class="text-white heading">APLIKASI SISTEM CUTI
                </div>
                <!-- <span class="topnav-logo-lg">
                    <img src="/assets/images/logo-jkt.png" alt="" height="16">
                </span>
                <span class="topnav-logo-sm">
                    <img src="/assets/images/logo_sm.png" alt="" height="16">
                </span> -->
            </a>
            <ul class="list-unstyled topbar-menu float-end mb-0">
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#"
                        id="topbar-notifydrop" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="dripicons-bell noti-icon"></i>
                        <span id="tanda" class="noti-icon-badge" style="display:none"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg"
                        aria-labelledby="topbar-notifydrop">

                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0">
                                <span class="float-end">

                                </span>Notification
                            </h5>
                        </div>

                        <div style="max-height: 230px;" data-simplebar="">
                            <!-- item-->
                            <div id="my-notif">

                            </div>
                        </div>







                    </div>
                </li>
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown"
                        id="topbar-userdrop" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="row">
                            <div class="col">
                                <span class="account-user-avatar">
                                    <img src="<?= strtoupper(session()->foto) ?>" alt="user-image"
                                        class="rounded-circle">

                                </span>
                                <span>
                                    <span class="account-user-name"><?= strtoupper(session()->nama) ?></span>
                                    <span class="account-position"><?= strtoupper(session()->nama_jabatan) ?> </span>
                                </span>
                            </div>
                            <div class="col">
                                <i class="dripicons-chevron-down"></i>
                            </div>
                        </div>


                    </a>

                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown"
                        aria-labelledby="topbar-userdrop">
                        <!-- item-->
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>

                        <!-- item-->
                        <a href="/home/my-account" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-circle me-1"></i>
                            <span>My Account</span>
                        </a>

                        <!-- item-->
                        <a href="/api/logout" class="dropdown-item notify-item">
                            <i class="mdi mdi-logout me-1"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>

            </ul>
            <a class="button-menu-mobile disable-btn">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>

        </div>
    </div>
    <!-- end Topbar -->

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- Begin page -->
        <div class="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu leftside-menu-detached">

                <div class="leftbar-user">
                    <a href="javascript: void(0);">
                        <img src="/assets/images/logo-jkt.png" alt="user-image" height="42"
                            class="img-fluid avatar-lg shadow-sm">
                        <!-- session name -->

                        <span class="leftbar-user-name"></span>
                        <span class="leftbar-user-name"></span>
                    </a>
                </div>

                <!--- Sidemenu -->
                <ul class="side-nav">

                    <li class="side-nav-title side-nav-item">Dashboard</li>
                    <li class="side-nav-item">
                        <a href="/home" class="side-nav-link">
                            <i class="uil-home-alt"></i>
                            <span> Home</span>
                        </a>
                    </li>
                    <?php if (session()->role == 'master admin') : ?>
                    <li class="side-nav-item">
                        <a href="/home/data-pegawai" class="side-nav-link">
                            <i class="uil-user-circle"></i>
                            <span> Data Pegawai</span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="/home/data-admin" class="side-nav-link">
                            <i class="uil-user-circle"></i>
                            <span> Data Admin</span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="/home/jabatan" class="side-nav-link">
                            <i class="mdi mdi-account-hard-hat"></i>
                            <span> Jabatan</span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="/home/lokasi-kerja" class="side-nav-link">
                            <i class="uil-building"></i>
                            <span> Data Lokasi Kerja</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <li class="side-nav-item">
                        <a href="/home/permintaan-cuti" class="side-nav-link">
                            <i class="uil-book-open"></i>
                            <span> Data Cuti Pegawai</span>
                        </a>
                    </li>
                    <?php if (str_contains(session()->role, 'admin') and session()->nama_jabatan == 'pengawas') : ?>

                    <li class="side-nav-item">
                        <a href="/home/permintaan-cuti-anda" class="side-nav-link">
                            <i class="uil-book-open"></i>
                            <span> Data Cuti Anda</span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="/home/permintaan-cuti-pengawas" class="side-nav-link">
                            <i class="uil-book-open"></i>
                            <span> Ajukan Cuti</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (session()->nama_jabatan == 'pengawas' || session()->nama_jabatan == 'ka pusyankeswannak' || str_contains(session()->role, 'master admin')) : ?>
                    <li class="side-nav-item">
                        <a href="/home/cuti-disetujui" class="side-nav-link">
                            <i class="mdi mdi-book-plus-multiple-outline"></i>
                            <span> Cuti Disetujui</span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="/home/cuti-ditolak" class="side-nav-link">
                            <i class="mdi mdi-book-remove-multiple-outline"></i>
                            <span> Cuti Ditolak</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="side-nav-title side-nav-item">Dokumentasi</li>
                    <li class="side-nav-item">
                        <a href="/dokumentasi" class="side-nav-link">
                            <i class="mdi mdi-book"></i>
                            <span> Readme</span>
                        </a>
                    </li>


                    <!-- end Help Box -->
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>
                    <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->



            <div class="content-page">
                <!-- content start here -->
                <?= $this->renderSection('content') ?>
                <!-- End Content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>
                                document.write(new Date().getFullYear())
                                </script> © SISTEM CUTI
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>
            <!-- content-page -->

        </div> <!-- end wrapper-->
    </div>
    <!-- END Container -->




    <div class="rightbar-overlay"></div>
    <!-- /End-bar -->

    <!-- jstree js -->
    <script src="/assets/js/vendor/jstree.min.js"></script>
    <script src="/assets/js/notif.js"></script>
    <script src="/assets/js/pages/demo.jstree.js"></script>
    <!-- bundle -->
    <script src="/assets/js/vendor.min.js"></script>
    <script src="/assets/js/app.min.js"></script>

    <!-- third party js -->
    <script src="/assets/js/vendor/apexcharts.min.js"></script>
    <script src="/assets/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="/assets/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
    <!-- third party js -->
    <script src="/assets/js/vendor/jquery.dataTables.min.js"></script>
    <script src="/assets/js/vendor/dataTables.bootstrap5.js"></script>
    <script src="/assets/js/vendor/dataTables.responsive.min.js"></script>
    <script src="/assets/js/vendor/responsive.bootstrap5.min.js"></script>
    <script src="/assets/js/vendor/dataTables.buttons.min.js"></script>
    <script src="/assets/js/vendor/buttons.bootstrap5.min.js"></script>
    <script src="/assets/js/vendor/buttons.html5.min.js"></script>
    <script src="/assets/js/vendor/buttons.flash.min.js"></script>
    <script src="/assets/js/vendor/buttons.print.min.js"></script>
    <script src="/assets/js/vendor/dataTables.keyTable.min.js"></script>
    <script src="/assets/js/vendor/dataTables.select.min.js"></script>

    <!-- Datatables js -->
    <script src="/assets/js/vendor/dataTables.buttons.min.js"></script>
    <script src="/assets/js/vendor/buttons.bootstrap5.min.js"></script>
    <script src="/assets/js/vendor/buttons.html5.min.js"></script>
    <script src="/assets/js/vendor/buttons.flash.min.js"></script>
    <script src="/assets/js/vendor/buttons.print.min.js"></script>
    <!-- third party js ends -->

    <!-- demo app -->
    <script src="/assets/js/pages/demo.dashboard.js"></script>
    <!-- end demo js-->

</body>

</html>