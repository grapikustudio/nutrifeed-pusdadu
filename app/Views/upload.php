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
                        <form action="/doUpload" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <?php if (session()->getFlashdata('sessionUpload')) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= session()->getFlashdata('sessionUpload'); ?>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="KategoriLink">Pilih Folder</label>
                                    <select name="catLink" class="form-control" id="KategoriLink" required>
                                        <option selected="true" disabled="disabled">Pilih Folder</option>
                                        <?php foreach ($link as $l) {
                                            $explode = explode("/", $l['link']);
                                            $idFolder = explode("?", $explode[5]);
                                        ?>
                                            <option value="<?= $idFolder[0]; ?>&<?= $l['category']; ?>"><?= $l['category']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fileUpload">Pilih File</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="fileUpload" name="file[]" multiple>
                                            <label class="custom-file-label" for="fileUpload">Klik Untuk Pilih File ...</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="/dasbor/file" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali ke Daftar File</a>
                                <button type="submit" style="float:right" class="btn btn-primary">Upload File</button>
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