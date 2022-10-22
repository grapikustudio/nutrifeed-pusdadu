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
                        <?php
                        switch ($user['role']) {
                            case '1':
                                $role = "Administrator";
                                break;
                            case '2':
                                $role = "Direksi";
                                break;
                            case '3':
                                $role = "Marketing";
                                break;
                            case '4':
                                $role = "Agen";
                                break;
                        }
                        ?>
                        <form action="/doUpdateUser" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" disabled value="<?= $user['email']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Pengguna</label>
                                    <input type="text" class="form-control" id="name" name="name" disabled value="<?= $user['name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="KategoriUser">Kategori User</label>
                                    <select name="catUser" class="form-control" id="KategoriUser" disabled>
                                        <option selected="true" disabled="disabled" value="<?= $user['role']; ?>"><?= $role; ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pass">Password</label>
                                    <input type="password" class="form-control" id="pass" name="pass" required placeholder="Ubah Password">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="/dasbor/user" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali ke Daftar User</a>
                                <button type="submit" style="float:right" class="btn btn-primary">Update User</button>
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