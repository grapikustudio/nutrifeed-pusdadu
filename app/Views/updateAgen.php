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
                        <form action="/doUpdateAgen" method="post">
                            <div class="card-body">
                                <?php foreach ($data as $link) { ?>
                                    <div class="form-group">
                                        <label for="referal">Referal</label>
                                        <input type="text" class="form-control" id="referal" name="referal" disabled value="<?= $link['referer']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" disabled value="<?= $link['email']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama Agen</label>
                                        <input type="text" class="form-control" id="name" name="name" disabled value="<?= $link['nama_agen']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="nameOwner">Nama Pemilik</label>
                                        <input type="text" class="form-control" id="nameOwner" name="nameOwner" disabled value="<?= $link['nama_pemilik']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" disabled value="<?= $link['alamat']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="pass">Password</label>
                                        <input type="password" class="form-control" id="pass" name="pass" required placeholder="Masukkan Password">
                                    </div>
                                    <input type="hidden" name="uid" value="<?= $link['id_user']; ?>">
                                <?php } ?>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="/dasbor/agen" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali ke Daftar Agen</a>
                                <button type="submit" style="float:right" class="btn btn-primary">Update Agen</button>
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