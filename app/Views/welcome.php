<?= $this->extend('layout/auth/template'); ?>
<?= $this->section('content'); ?>
<p class="login-box-msg">Selamat Datang, <?= session()->get('name'); ?></p>
<p>Silahkan pilih halaman tujuan anda.</p>
<div class="row">
    <div class="col">
        <a href="/dasbor" class="btn btn-primary btn-block">
            <b>Dasbor Admin</b>
        </a>
    </div>
    <div class="col">
        <a href="/link" class="btn btn-primary btn-block">
            <b>Beranda Link</b>
        </a>
    </div>
    <!-- /.col -->
</div>
<div class="row">
    <div class="col">
        <hr>
        <div style="text-align:center">
            <a href="/logout" style="color:#666666;">Keluar</a>
        </div>

    </div>
</div>
<?= $this->endSection(); ?>