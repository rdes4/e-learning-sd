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
    <!-- Custom styles for this template-->
    <link href="<?=base_url()?>/template/css/custom-login-guru.css" rel="stylesheet">

</head>

<div class="wrapper">
    <div class="col">
        <a href="<?=base_url('auth/login')?>"><h6><i class="fas fa-angle-left"></i> Kembali</h6></a>
    </div>
        <div class="text-center mt-4 name">
            Login Siswa
        </div>

        <?php if(session()->get('message')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?=session()->getFlashdata('message')?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <form class="p-3 mt-3" action="<?=base_url('auth/loginsiswaprocess')?>" method="POST">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="nis" id="userName" placeholder="NIS" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password" required>
            </div>
            <button type="submit" class="btn mt-3">Login</button>
        </form>
    </div>

</html>