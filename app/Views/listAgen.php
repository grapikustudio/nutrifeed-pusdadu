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
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h3 class="card-title mt-2">Daftar Agen yang Telah Registrasi</h3>
                            </div>
                            <div style="float: right;">
                                <a href="/dasbor/agen/tambah" class="btn btn-primary">Tambah Agen</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if (session()->getFlashdata('success_user')) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('success_user'); ?>
                                </div>
                            <?php } ?>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Nama Agen</th>
                                        <th>Referer</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($users as $u) {

                                        if (!$u['status']) {
                                            $status = '  <a href="/dasbor/user/enable/' . $u['id_user'] . '" class="btn btn-danger">Denied</a>';
                                        } else {
                                            $status = '  <a href="/dasbor/user/disable/' . $u['id_user'] . '" class="btn btn-success">Allowed</a>';
                                        }
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $u['email']; ?> </td>
                                            <td><?= $u['name']; ?></td>
                                            <td><?= $u['referer']; ?> </td>
                                            <td><?= $status; ?></td>

                                            <td>
                                                <a href="javascript:;" class="btn btn-danger" data-toggle="modal" data-target="#modal-default" data-button-type="agen" data-id="<?= $u['id']; ?>" data-id-user="<?= $u['id_user']; ?>"><i class="fas fa-trash"></i> Hapus</a>
                                                <a href="/dasbor/agen/update/<?= $u['id']; ?>" class="btn btn-warning"><i class="fas fa-pen"></i> Update</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
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