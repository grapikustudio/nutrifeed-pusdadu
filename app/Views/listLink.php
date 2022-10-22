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
                                <h3 class="card-title">Daftar link yang telah ditambahkan</h3>
                            </div>
                            <?php if (!session()->get('role') == 3) { ?>
                                <div style="float: right;">
                                    <a href="/dasbor/link/tambah" class="btn btn-primary">Tambah Link</a>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if (session()->getFlashdata('success_link')) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('success_link'); ?>
                                </div>
                            <?php } ?>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori Link</th>
                                        <?php if (!session()->get('role') == 3) { ?>
                                            <th>Link</th>
                                        <?php } ?>
                                        <th>Jumlah Klik</th>
                                        <?php if (!session()->get('role') == 3) { ?>
                                            <th>Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($link as $l) { ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td class="category"><?= $l['category']; ?> </td>
                                            <?php if (!session()->get('role') == 3) { ?>
                                                <td class="link"><?= $l['link']; ?></td>
                                            <?php } ?>
                                            <td><?= $l['click']; ?></td>
                                            <?php if (!session()->get('role') == 3) { ?>
                                                <td>
                                                    <a href="javascript:;" class="btn btn-danger" data-toggle="modal" data-button-type="link" data-target="#modal-default" data-id="<?= $l['id']; ?>"><i class="fas fa-trash"></i> Hapus</a>
                                                    <a href="/dasbor/link/update/<?= $l['id']; ?>" class="btn btn-warning"><i class="fas fa-pen"></i> Update</a>
                                                </td>
                                            <?php } ?>
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