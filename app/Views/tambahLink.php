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
                    <div class="card card-primary">

                        <!-- form start -->
                        <form action="/doAddLink" method="post">
                            <div class="card-body">
                                <?php if (session()->getFlashdata('link_status')) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= session()->getFlashdata('link_status'); ?>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="KategoriLink">Kategori Link</label>
                                    <select name="catLink" class="form-control" id="KategoriLink" required>
                                        <option selected="true" disabled="disabled">Pilih Kategori Link</option>
                                        <option value="Data Perusahaan">Data Perusahaan</option>
                                        <option value="Data Desain">Data Desain</option>
                                        <option value="Data Template">Data Template</option>
                                        <option value="Data Foto">Data Foto</option>
                                        <option value="Data Video">Data Video</option>
                                        <option value="Data Agen">Data Agen</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="link">Link</label>
                                    <input type="text" class="form-control" id="link" name="link" placeholder="Masukkan Link Google Drive">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="/dasbor/link" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali ke Daftar Link</a>
                                <button type="submit" style="float:right" class="btn btn-primary">Tambah Link</button>
                            </div>
                        </form>
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