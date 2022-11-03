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
                    <a href="<?= previous_url(); ?>" class="float-sm-right btn"><i class="fa fa-chevron-left"> </i> Kembali Folder Sebelumnya</a>
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
                                <h3 class="card-title mt-2">Lokasi : <a href="/dasbor/file">File</a> / <a href="?folder=<?= $folder->id ?>"><?= $folder->name ?></a></h3>
                            </div>
                            <div style="float: right;">
                                <a href="javascript:;" class="btn btn-default" data-toggle="modal" data-target="#modal-add-folder" data-id="<?= $folder->id; ?>">Tambah Folder</a>
                                <a href="javascript:;" class="btn btn-primary" data-toggle="modal" data-target="#modal-upload" data-id="<?= $folder->id; ?>">Upload File</a>
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
                                        <th>Kategori</th>
                                        <th>Link</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;

                                    foreach ($file as $f) {
                                    ?>
                                        <tr>
                                            <?php
                                            $parents = isset($f->parents[0]) ? $f->parents[0] : 0;
                                            $icon = isset($f->iconLink[0]) ? $f->iconLink : null;
                                            if ($f->mimeType === "application/vnd.google-apps.folder") {
                                                $link = '<a href="/dasbor/file?folder=' . $f->id . '"><img src="' . $icon . '"> ' . $f->name . '</a>';
                                            } else {
                                                $link = '<img src="' . $icon . '"> ' . $f->name;
                                            }
                                            ?>
                                            <td><?= $i++; ?></td>
                                            <td><?= $link; ?></td>
                                            <td><?= $f->mimeType; ?></td>
                                            <td><a href="<?= $f->webViewLink; ?>" target="_blank">Tampilkan</a></td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-danger" data-toggle="modal" data-target="#modal-default" data-button-type="file" data-id="<?= $f['id']; ?>"><i class="fas fa-trash"></i> Hapus</a>
                                                <a href="javascript:;" class="btn btn-warning" data-toggle="modal" data-target="#modal-rename" data-id="<?= $f['id']; ?>" data-name="<?= $f->name; ?>"><i class="fas fa-pen"></i> Update</a>
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
            <div class="row">
                <div class="col">
                    <div class="callout callout-warning">
                        <h5>File Manager</h5>

                        <p>Untuk menambahkan atau mengunggah file, anda dapat mengklik tombol “UPLOAD FILE”. Di halaman ini anda juga dapat menambahkan folder dengan mengklik tombol “TAMBAH FOLDER”.
                            Apabila anda ingin memasukkan file ke dalam folder yang telah dibuat, terlebih dahulu klik nama folder dan unggah file di dalamnya.
                        </p>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<div class="modal fade" id="modal-upload">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload File</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/doUpload" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <label for="fileUpload">Pilih File</label>
                        <div class="input-group">
                            <div class="custom-file">

                                <input type="file" class="custom-file-input" id="fileUpload" name="file[]" multiple>
                                <label class="custom-file-label" for="fileUpload">Klik Untuk Pilih File ...</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Tambah</a>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>