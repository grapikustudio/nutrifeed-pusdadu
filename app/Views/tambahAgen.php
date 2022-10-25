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
                        <form action="/doAddAgen" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required placeholder="Masukkan Alamat Email Agen">
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Agen</label>
                                    <input type="text" class="form-control" id="name" name="name" required placeholder="Masukkan Nama Agen">
                                </div>
                                <div class="form-group">
                                    <label for="nameOwner">Nama Pemilik</label>
                                    <input type="text" class="form-control" id="nameOwner" name="nameOwner" required placeholder="Masukkan Nama Pemilik">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" required placeholder="Masukkan Alamat">
                                </div>
                                <div class="form-group">
                                    <label for="pass">Password</label>
                                    <input type="password" class="form-control" id="pass" name="pass" required placeholder="Masukkan Password">
                                </div>
                                <input type="hidden" name="referal" id="referal" value="<?= session()->get('name'); ?>">
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="/dasbor/agen" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali ke Daftar Agen</a>
                                <button type="submit" style="float:right" class="btn btn-primary">Tambah Agen</button>
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