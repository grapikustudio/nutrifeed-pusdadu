<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/img/nutrifeed-logo.png">
    <title><?= $title; ?> | Pusat Data Terpadu NUTRIFEED</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="/plugins/dropzone/min/dropzone.min.css">
    <link rel="stylesheet" href="/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <style>
        #example1_filter {
            float: right;
        }

        .category,
        .link {
            max-width: 571px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .link:hover {
            overflow: visible;
            background-color: #ffffff;
            position: absolute;
            max-width: 100%;
            height: auto;
        }

        td:nth-child(5) {
            width: 20%;
        }

        .gap {
            height: 100px;
        }

        .icon-link {
            height: 80px;
            vertical-align: top;
        }

        .link-data {
            color: #ffffff;
        }

        .link-data:hover {
            color: #303030;
        }

        .link-data .card {
            background: linear-gradient(111deg, rgba(3, 153, 53, 1) 0%, rgba(63, 169, 127, 1) 90%);
        }

        .link-data .card:hover {
            color: #ffffff;
            background: linear-gradient(111deg, rgb(10, 194, 72) 0%, rgb(72, 189, 142) 90%);
        }
    </style>
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="/dasbor" class="navbar-brand">
                    <img src="/img/logo-nutrifeed.png" class="brand-image " style="opacity: .8">
                    <span class="brand-text font-weight-light">Pusat Data Terpadu NUTRIFEED</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <?php if (session()->get('role') != 5) { ?>
                            <li class="nav-item">
                                <a href="/dasbor" class="nav-link">Dasbor</a>
                            </li>
                            <?php if (session()->get('role') == 1 or session()->get('role') == 2) { ?>
                                <li class="nav-item">
                                    <a href="/dasbor/log" class="nav-link">Log</a>
                                </li>
                            <?php } ?>
                            <li class="nav-item">
                                <a href="/dasbor/file" class="nav-link">File Manager</a>
                            </li>
                            <li class="nav-item dropdown dropdown-hover">
                                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Manajemen User</a>
                                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                    <?php if (session()->get('role') == 1) { ?>
                                        <li><a href="/dasbor/user" class="dropdown-item"><i class="fa fa-chevron-right nav-icon"></i> Daftar User</a></li>
                                        <li><a href="/dasbor/user/tambah" class="dropdown-item"><i class="fa fa-chevron-right nav-icon"></i> Tambah User</a></li>
                                    <?php } ?>
                                    <li><a href="/dasbor/user/ubah" class="dropdown-item"><i class="fa fa-chevron-right nav-icon"></i> Ganti Password</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <li class="nav-item dropdown dropdown-hover">
                            <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Manajemen Agen</a>
                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                <li><a href="/dasbor/agen" class="dropdown-item"><i class="fa fa-chevron-right nav-icon"></i> Daftar Agen</a></li>
                                <?php if (session()->get('role') == 5 or session()->get('role') == 1 or session()->get('role') == 2) { ?>
                                    <li><a href="/dasbor/agen/tambah" class="dropdown-item"><i class="fa fa-chevron-right nav-icon"></i> Tambah Agen</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/dasbor/faq" class="nav-link">FAQ</a>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <?= $this->renderSection('content'); ?>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin hapus data ini?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                        <a href="javascript:;" class="btn btn-primary" id="modalDelete">Hapus Data</a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="modal-add-folder">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Folder</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/addDriveFolder" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="folder">Masukkan Nama Folder</label>
                                <input type="hidden" name="id" id="id">
                                <input type="text" class="form-control" name="folder" id="folder" placeholder="Nama Folder">
                            </div>
                            <?php if (!isset($_GET['folder'])) { ?>
                                <div class="form-group">
                                    <label for="desc">Masukkan Deskripsi</label>
                                    <input type="textarea" name="desc" id="desc" class="form-control" placeholder="Deskripsi Folder">
                                </div>
                            <?php } ?>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-primary">Tambah</a>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="modal-rename">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/updateDrive" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="folder">Masukkan Nama Baru</label>
                                <input type="hidden" name="id" id="id">
                                <input type="text" class="form-control" name="folder" id="folder" placeholder="Nama File / Folder">
                                <small>Perhatikan Ekstensi File Jangan Di Ubah</small>
                            </div>
                            <?php if (!isset($_GET['folder'])) { ?>
                                <div class="form-group">
                                    <label for="desc">Masukkan Deskripsi</label>
                                    <input type="textarea" name="desc" id="desc" class="form-control" placeholder="Deskripsi Folder">
                                </div>
                            <?php } ?>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-primary">Update</a>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- <div class="modal fade" id="modal-rename">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/updateDrive" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="folder">Masukkan Nama Baru</label>
                                <input type="hidden" name="id" id="id">
                                <input type="text" class="form-control" name="folder" id="folder" placeholder="Nama File / Folder">
                                <small>Perhatikan Ekstensi File Jangan Di Ubah</small>
                            </div>
                        </div>
                        
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-primary">Tambah</a>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->
        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-block">
                Developed with &#9829; <a href="https://grapiku.com">Grapiku Studio.</a>
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2022 </strong><a href="https://pakanternaknutrifeed.com">KJUB Puspetasari</a>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->


    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Grapiku App -->
    <script src="/js/adminlte.min.js"></script>
    <script src="/js/hapus.js"></script>
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="/plugins/datatables-rowreorder/js/dataTables.rowReorder.min.js"></script>
    <script src="/plugins/datatables-rowreorder/js/rowReorder.bootstrap4.min.js"></script>
    <!-- dropzonejs -->
    <script src="/plugins/dropzone/min/dropzone.min.js"></script>
    <script>
        $("#example1").DataTable({
            // rowReorder: {
            //     selector: 'td:nth-child(2)'
            // },
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        });
        $("#example2").DataTable({
            // rowReorder: {
            //     selector: 'td:nth-child(2)'
            // },
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        });
        // $(document).ready(function() {
        //     var table = $('#example1').DataTable({
        //         rowReorder: {
        //             selector: 'td:nth-child(2)'
        //         },
        //         responsive: true
        //     });
        // });
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script>
        function ambilId(file) {
            return document.getElementById(file);
        }

        $(document).ready(function() {
            $("#upload").click(function() {
                ambilId("progressBar").style.display = "block";
                var total = ambilId("file").files.length;
                var id = $('#id').val();
                if (file != "") {
                    var formdata = new FormData();
                    formdata.append("id", id);
                    for (var index = 0; index < total; index++) {
                        var file = ambilId("file").files[index];
                        formdata.append("file[]", file);
                        var ajax = new XMLHttpRequest();
                        ajax.upload.addEventListener("progress", progressHandler, false);
                        ajax.addEventListener("load", completeHandler, false);
                        ajax.addEventListener("error", errorHandler, false);
                        ajax.addEventListener("abort", abortHandler, false);
                        ajax.open("POST", "/doUpload");
                        ajax.send(formdata);
                    }

                }
            });
        });

        function progressHandler(event) {
            ambilId("loaded_n_total").innerHTML = "Telah diupload " + event.loaded + " bytes dari " + event.total;
            var percent = (event.loaded / event.total) * 100;
            ambilId("progressBar").value = Math.round(percent);
            ambilId("status").innerHTML = Math.round(percent) + "% sedang diupload... Mohon Tunggu";
        }

        function completeHandler(event) {
            ambilId("status").innerHTML = event.target.responseText;
            ambilId("progressBar").value = 0;
            $('#modal-upload').modal('hide');
            location.reload();
        }

        function errorHandler(event) {
            ambilId("status").innerHTML = "Upload Gagal";
        }

        function abortHandler(event) {
            ambilId("status").innerHTML = "Upload Dibatalkan";
        }
    </script>
</body>

</html>