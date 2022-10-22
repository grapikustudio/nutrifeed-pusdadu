<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?> | Pusat Data Terpadu NUTRIFEED</title>
    <link rel="icon" type="image/x-icon" href="img/nutrifeed-logo.png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminlte.css">
</head>

<body class="hold-transition login-page shape">
    <div class="login-box">
        <div class="login-logo">
            <img src="../img/logo-nutrifeed.png" width="150px" style="display: block;margin: auto;">
            <a href="/">Pusat Data Terpadu <b>NUTRIFEED</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">

                <?= $this->renderSection('content'); ?>

                <div class="fixed-bottom d-sm-block d-xs-block d-md-block d-lg-none d-xl-none d-xxl-none">
                    <div class="row box-socmed ">
                        <div class="col-4 text-socmed d-flex align-items-center justify-content-center">
                            Ikuti Kami
                        </div>
                        <div class="col-2 btn-socmed d-flex align-items-center justify-content-center">
                            <img src="../img/fb.svg" class="icon-socmed">
                        </div>
                        <div class="col-2 btn-socmed d-flex align-items-center justify-content-center">
                            <img src="../img/ig.svg" class="icon-socmed">
                        </div>
                        <div class="col-2 btn-socmed d-flex align-items-center justify-content-center">
                            <img src="../img/yt.svg" class="icon-socmed">
                        </div>
                        <div class="col-2 btn-socmed d-flex align-items-center justify-content-center">
                            <img src="../img/wa.svg" class="icon-socmed">
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="js/adminlte.min.js"></script>
</body>

</html>