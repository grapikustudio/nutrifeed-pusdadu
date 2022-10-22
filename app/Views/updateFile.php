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

                        <form action="/doUpdateFile" method="post">
                            <?= csrf_field(); ?>
                            <div class="card-body">
                                <?php if (session()->getFlashdata('sessionUpload')) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= session()->getFlashdata('sessionUpload'); ?>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?= $file['id']; ?>">
                                    <input type="hidden" name="id_file" value="<?= $file['id_file']; ?>">
                                    <label for="name">Nama File</label>
                                    <input type="text" class="form-control" id="name" name="name" required value="<?= $file['name']; ?>">
                                    <small>Pastikan ekstensi file tidak berubah. Cth: Data Ternak<b>.pdf</b>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="/dasbor/user" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali ke Daftar File</a>
                                <button type="submit" style="float:right" class="btn btn-primary">Update File</button>
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