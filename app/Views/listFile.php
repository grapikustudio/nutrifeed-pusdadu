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
                                <h3 class="card-title mt-2">Daftar file yang telah upload</h3>
                            </div>
                            <div style="float: right;">
                                <a href="/dasbor/file/upload" class="btn btn-primary">Upload File</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if (session()->getFlashdata('successUpload')) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('successUpload'); ?>
                                </div>
                            <?php } ?>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Folder</th>
                                        <th>Link</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($file as $f) {
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $f['name']; ?> </td>
                                            <td><?= $f['folder']; ?></td>
                                            <td><a href="https://drive.google.com/file/d/<?= $f['id_file']; ?>/view">Buka File</a></td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-danger" data-toggle="modal" data-target="#modal-default" data-button-type="file" data-id="<?= $f['id_file']; ?>"><i class="fas fa-trash"></i> Hapus</a>
                                                <a href="/dasbor/file/update/<?= $f['id']; ?>" class="btn btn-warning"><i class="fas fa-pen"></i> Update</a>
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