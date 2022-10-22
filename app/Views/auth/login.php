<?= $this->extend('layout/auth/template'); ?>
<?= $this->section('content'); ?>
<p class="login-box-msg">Silahkan Login Terlebih Dahulu!</p>
<p class="msg"><?= session()->getFlashdata('error'); ?></p>

<form action="/doLogin" method="post">
  <div class="input-group mb-3">
    <input type="email" class="form-control" name="email" required placeholder="Email">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-envelope"></span>
      </div>
    </div>
  </div>
  <div class="input-group mb-3">
    <input type="password" class="form-control" name="pass" placeholder="Password">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-lock"></span>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <button type="submit" class="btn btn-primary btn-block"><b>LOGIN</b></button>
    </div>
    <!-- /.col -->
  </div>
</form>
<?= $this->endSection(); ?>