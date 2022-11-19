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
                        <form action="/doChgPass" method="post">
                            <div class="card-body">
                                <?php if (session()->getFlashdata('success_chg')) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('success_chg'); ?>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="hidden" name="id" value="<?= session()->get('id'); ?>">
                                    <input type="email" class="form-control" id="email" name="email" required value="<?= session()->get('email'); ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Pengguna</label>
                                    <input type="text" class="form-control" id="name" name="name" required value="<?= session()->get('name'); ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="pass">Masukkan Password Baru</label>
                                    <input type="password" class="form-control" id="pass" name="pass" required placeholder="Masukkan Password">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="/dasbor/" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali ke Dasbor</a>
                                <button type="submit" style="float:right" class="btn btn-primary">Ubah Password</button>
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