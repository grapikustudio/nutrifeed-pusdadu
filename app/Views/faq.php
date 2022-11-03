<?= $this->extend('layout/dash/template'); ?>
<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <?= $breadcrumb; ?>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            <h3 class="card-title mt-2">Pertanyaan yang Sering Ditanyakan</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="callout callout-warning">
                                        <h5>File apa saja yang bisa saya upload di Bank Data Nutrifeed?</h5>
                                        <p>File yang berhubungan dengan marketing perusahaan seperti hasil desain canva berupa gambar maupun video. Juga dapat mengunggah file-file yang berhubungan dengan materi pemasaran seperti dokumen untuk berbagi ke rekan lainnya.
                                            Dilarang mengunggah file yang tidak ada hubungannya dengan Nutrifeed. Apabila ditemukan file terlarang maupun cadangan pribadi, anda akan dikenakan sanksi oleh perusahaan.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="callout callout-warning">
                                        <h5>Siapa yang boleh mengakses Bank Data Nutrifeed?</h5>
                                        <p>Semua yang telah terdaftar pada sistem Pusat Data Terpadu Nutrifeed dengan persetujuan administrator</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="callout callout-warning">
                                        <h5>Siapa yang boleh menambahkan data agen?</h5>
                                        <p>Pengguna dengan status PIC Agen yang diperbolehkan untuk menambah agen (referal). Dan PIC tersebut yang akan memberikan pengarahan kepada agen bagaimana cara menggunakan bank data Nutrifeed.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="callout callout-warning">
                                        <h5>Upload file saya tidak berhasil, apa yang harus saya lakukan?</h5>
                                        <p>Pertama pastikan jaringan internet anda stabil. Anda dapat menggunakan wifi apabila mengunggah file dengan ukuran besar. Apabila tidak kunjung berhasil, hubungi administrator Nutrifeed untuk bantuan unggah.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="callout callout-warning">
                                        <h5>Apakah data analisis di dasbor bersifat realtime?</h5>
                                        <p>Benar. Data statistik yang tampil di dasbor dapat berubah setiap hari menyesuaikan performa digital marketing Nutrifeed. Anda juga dapat melihat dengan rentang waktu tertentu.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>