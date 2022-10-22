<?= $this->extend('layout/auth/template'); ?>
<?= $this->section('content'); ?>
<p class="login-box-msg">Registrasi Pengguna</p>

<form action="/doRegister" method="post">
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>
    <div class="input-group mb-3">
        <input type="text" name="name" class="form-control" placeholder="Nama Pengguna" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
    </div>
    <div class="input-group mb-3">
        <input type="password" name="pass" class="form-control" placeholder="Password" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-primary btn-block"><b>Register</b></button>
        </div>
        <!-- /.col -->
    </div>
</form>
<?= $this->endSection(); ?>