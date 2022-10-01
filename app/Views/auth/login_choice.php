
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-Learning - Login</title>
    <link rel="icon" type="image/x-icon" href="<?=base_url()?>/template/img/logo.png">
    <!-- Custom fonts for this template-->
    <link href="<?=base_url()?>/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=base_url()?>/template/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success" style="background-color: #8EC5FC;
background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);
">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-10">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            
                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h3 text-gray-900 mb-4">Selamat Datang!</h1>
                                    </div>
                                        <a href="<?=base_url('auth/loginadmin')?>" class="btn btn-lg btn-google btn-user btn-block">
                                            <i class="fas fa-user-shield fa-fw"></i> Login sebagai Admin
                                        </a>
                                        <hr>
                                        <div class="container">
                                            <div class="row">
                                            <div class="col">
                                                
                                                <a href="<?=base_url('auth/loginguru')?>" class="btn btn-lg btn-facebook btn-user btn-block">
                                                <i class="fas fa-chalkboard-teacher fa-fw"></i> Login sebagai Guru
                                                
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a href="<?=base_url('auth/loginsiswa')?>" class="btn btn-lg btn-facebook btn-user btn-block">
                                                <i class="fas fa-user fa-fw"></i> Login sebagai Siswa
                                                </a>
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url()?>/template/vendor/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=base_url()?>/template/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url()?>/template/js/sb-admin-2.min.js"></script>

</body>

</html>