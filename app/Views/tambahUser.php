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
                    <?php if (session()->getFlashdata('user_found')) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('user_found'); ?>
                        </div>
                    <?php }
                    ?>
                    <div class="card card-primary">
                        <!-- form start -->
                        <form action="/doAddUser" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required placeholder="Masukkan Alamat Email Anda">
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Pengguna</label>
                                    <input type="text" class="form-control" id="name" name="name" required placeholder="Masukkan Nama Anda">
                                </div>
                                <div class="form-group">
                                    <label for="KategoriUser">Kategori User</label>
                                    <select name="catUser" class="form-control" id="KategoriUser" required>
                                        <option selected="true" disabled="disabled">Pilih Kategori User</option>
                                        <option value="1">Administrator</option>
                                        <option value="2">Direksi</option>
                                        <option value="3">Marketing</option>
                                        <option value="4">Agen</option>
                                        <option value="5">PIC Agen</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pass">Password</label>
                                    <input type="password" class="form-control" id="pass" name="pass" required placeholder="Masukkan Password">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="/dasbor/user" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali ke Daftar User</a>
                                <button type="submit" style="float:right" class="btn btn-primary">Tambah User</button>
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