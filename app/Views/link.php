<!DOCTYPE html>

<head>
    <title>Pusat Data Terpadu NUTRIFEED</title>
    <link rel="icon" type="image/x-icon" href="/img/nutrifeed-logo.png">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karla|Source+Sans+Pro">
    <script src="/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container-lg p-5">
        <div class="row">
            <div class="col-sm-3">
                <img class="logo" src="img/logo-nutrifeed.png">

            </div>
            <div class="col-sm-9">

                <h1 class="title">Pusat Data Terpadu NUTRIFEED</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <!-- Start Button Link -->
                <div class="d-grid gap-5">
                    <?php if (session()->get('role') != 4 and session()->get('role') != 3) {
                        if (isset($perusahaan['link'])) {
                            echo '
                            <a href="/link/redir?url=' . $perusahaan['link'] . '&cat=perusahaan" target="_blank" class="btn-link ps-3">
                                <div class="link">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <img class="link-icon" src="img/link.svg" width="100px">
                                        </div>
                                        <div class="col-sm-10">
                                            <b>Data Perusahaan</b><br>
                                            <p>Data berupa company profile, e-katalog, dan informasi perusahaan.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                           ';
                        }
                    } ?>
                    <?php if (session()->get('role') != 4) {
                        if (isset($template['link'])) {
                            echo '
                        <a href="/link/redir?url=' . $template['link'] . '&cat=template" target="_blank" class="btn-link ps-3">
                        <div class="link">
                            <div class="row">
                                <div class="col-sm-2">
                                    <img class="link-icon" src="img/link.svg" width="100px">
                                </div>
                                <div class="col-sm-10">
                                    <b>Data Template</b><br>
                                    <p>Data berupa info produk, brosur, flyer, banner, dan template promosi jadi lainnya.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                   ';
                        }
                    } ?>
                    <?php if (session()->get('role') != 4) {
                        if (isset($desain['link'])) {
                            echo '
                        <a href="/link/redir?url=' . $desain['link'] . '&cat=desain" target="_blank" class="btn-link ps-3">
                        <div class="link">
                            <div class="row">
                                <div class="col-sm-2">
                                    <img class="link-icon" src="img/link.svg" width="100px">
                                </div>
                                <div class="col-sm-10">
                                    <b>Data Desain</b><br>
                                    <p>Data berupa desain produk, brosur, flyer, banner, dan desain jadi lainnya.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                   ';
                        }
                    } ?>
                    <?php if (session()->get('role') != 4) {
                        if (isset($foto['link'])) {
                            echo '
                        <a href="/link/redir?url=' . $foto['link'] . '&cat=foto" target="_blank" class="btn-link ps-3">
                        <div class="link">
                            <div class="row">
                                <div class="col-sm-2">
                                    <img class="link-icon" src="img/link.svg" width="100px">
                                </div>
                                <div class="col-sm-10">
                                    <b>Data Foto</b><br>
                                    <p>Data berbagi foto kegiatan oleh seluruh staf marketing Nutrifeed.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                   ';
                        }
                    } ?>
                    <?php if (session()->get('role') != 4) {
                        if (isset($video['link'])) {
                            echo '
                            <a href="/link/redir?url=' . $video['link'] . '&cat=video" target="_blank" class="btn-link ps-3">
                            <div class="link">
    
                                <div class="row">
                                    <div class="col-sm-2">
                                        <img class="link-icon" src="img/link.svg" width="100px">
                                    </div>
                                    <div class="col-sm-10">
                                        <b>Data Video</b><br>
                                        <p>Data berbagi video kegiatan oleh seluruh staf marketing Nutrifeed.</p>
                                    </div>
                                </div>
    
                            </div>
                        </a>
                       ';
                        }
                    } ?>
                    <?php if (isset($agen['link'])) { ?>
                        <a href="/link/redir?url=<?= $agen['link']; ?>&cat=agen" target="_blank" class="btn-link ps-3">
                            <div class="link">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <img class="link-icon" src="img/link.svg" width="100px">
                                    </div>
                                    <div class="col-sm-10">
                                        <b>Data Agen</b><br>
                                        <p>Data berbagi aset grafis dan template untuk distributor dan agen resmi.</p>
                                    </div>
                                </div>

                            </div>
                        </a>
                    <?php } ?>
                </div>

                <!-- End Button Link -->
            </div>

        </div>
        <div class="fixed-bottom container-lg d-sm-block d-xs-block d-md-block d-lg-none d-xl-none d-xxl-none">
            <div class="row box-socmed ">
                <div class="col-4 text-socmed d-flex align-items-center justify-content-center">
                    Ikuti Kami
                </div>
                <div class="col-2 btn-socmed d-flex align-items-center justify-content-center">
                    <img src="img/fb.svg" class="icon-socmed">
                </div>
                <div class="col-2 btn-socmed d-flex align-items-center justify-content-center">
                    <img src="img/ig.svg" class="icon-socmed">
                </div>
                <div class="col-2 btn-socmed d-flex align-items-center justify-content-center">
                    <img src="img/yt.svg" class="icon-socmed">
                </div>
                <div class="col-2 btn-socmed d-flex align-items-center justify-content-center">
                    <img src="img/wa.svg" class="icon-socmed">
                </div>
            </div>
        </div>
    </div>



</body>

</html>