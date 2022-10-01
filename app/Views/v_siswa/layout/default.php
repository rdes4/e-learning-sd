<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="<?=base_url()?>/template/img/logo.png">

    <title><?= $this->renderSection('title') ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?=base_url()?>/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=base_url()?>/template/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/datatables/DataTables-1.12.1/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="<?=base_url()?>/template/css/zoom-img.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-book-reader"></i>
                </div>
                <div class="sidebar-brand-text mx-3">E-Learning</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Divider -->

            <?php if (session()->get('logAdmin')) : ?>

            <!-- Heading -->
            <div class="sidebar-heading">
                MENU ADMIN
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('siswa')?>">
                    <i class="fas fa-fw fa-user-friends"></i>
                    <span>Data Siswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('guru')?>">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i>
                    <span>Data Guru</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('kelas')?>">
                    <i class="fas fa-fw fa-landmark"></i>
                    <span>Data Kelas</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('mapel')?>">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Data Mata Pelajaran</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <?php elseif(session()->get('logSiswa')) : ?>
            <!-- Heading -->
            <div class="sidebar-heading">
                MENU SISWA
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('detailsiswa/list_mapel_siswa')?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Mata Pelajaran</span>
                </a>
            </li>
            <?php endif ?> 
            
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">  

                        <!-- Nav Item - Messages -->
                        

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                        <?php if (session()->get('logAdmin')) : ?>
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=session()->get('nama_admin')?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?=base_url()?>/template/img/undraw_profile.svg">
                            </a>
                        <?php elseif (session()->get('logSiswa')) : ?>
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Siswa : <?=session()->get('nama_siswa')?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?=base_url()?>/template/img/undraw_profile.svg">
                            </a>
                        <?php endif ?>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <?php if (session()->get('logAdmin')) : ?>
                                    <a class="dropdown-item" href="<?=base_url('auth/logoutAdmin')?>">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                <?php elseif (session()->get('logSiswa')) : ?>
                                    <a class="dropdown-item" href="<?=base_url('auth/logoutSiswa')?>">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                <?php endif ?>
                                

                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- Page Heading -->
                <?= $this->renderSection('content') ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Rifqi 2022</span> 
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <!-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?=base_url('auth/logoutAdmin')?>">Logout</a>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url()?>/template/vendor/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=base_url()?>/template/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url()?>/template/js/sb-admin-2.min.js"></script>
    <script src="<?=base_url()?>/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?=base_url()?>/datatables/DataTables-1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        $('.form-check-input').on('click', function(){
            const idKelas = $(this).data('idKelas');
            const idMapel = $(this).data('idMapel');

            $.ajax({
                url: "<?=base_url('kelas/editaksesmapel')?>",
                type: 'post',
                data: {
                    idKelas: idKelas,
                    idMapel: idMapel
                },
                success: function(){
                    document.location.href = "<?=base_url('kelas/')?>"
                }
            });
        });
    </script>

<!-- Script CKEDITOR -->
    <script>
        CKEDITOR.replace( 'isi_tugas' );
    </script>

    <script>
        CKEDITOR.replace( 'isi_materi' );
    </script>

    <script>
        CKEDITOR.replace( 'jawaban_siswa' );
    </script>
<!-- Script CKEDITOR -->

<!-- Script Datatables -->
        <script>
            $(document).ready( function () {
                $('#tabel_tugas_siswa').DataTable();
            } );
        </script>

<!-- Script Datatables -->


    <script>
    document.getElementById('myButton').onclick = function() {
        document.getElementById('myInput').removeAttribute('readonly');
    };;
    </script>

    <?= $this->renderSection('script') ?>
    

</body>

</html>