    <?= $this->extend('layout/dash/template'); ?>
    <?= $this->section('content'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"> Selamat Datang, <small><?= session()->get('name'); ?></small></h1>
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
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?= $link; ?></h3>

                  <p>Jumlah Link</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?= $klik[0]->click; ?></h3>
                  <p>Total Link Klik</p>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-12">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?= $user; ?></h3>
                  <p>Pengguna Terdaftar</p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col-md-6 -->
            <?php if (session()->get('role') != 1) {
              $col = 'col-lg';
            } else {
              $col = 'col-lg-6';
            } ?>
            <?php if (session()->get('role') != 3) { ?>
              <div class="<?= $col; ?>">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h5 class="card-title m-0">Tambah Link</h5>
                  </div>
                  <div class="card-body">
                    <p class="card-text">Klik tombol di bawah untuk menambahkan Link Data</p>
                    <a href="/dasbor/link/tambah" class="btn btn-primary">Pergi Tambah Link</a>
                  </div>
                </div>
              </div>
            <?php } ?>
            <?php if (session()->get('role') == 1) { ?>
              <div class="col-lg-6">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h5 class="card-title m-0">Tambah User</h5>
                  </div>
                  <div class="card-body">
                    <p class="card-text">Klik tombol di bawah untuk menambahkan Pengguna</p>
                    <a href="/dasbor/user/tambah" class="btn btn-primary">Pergi Tambah User</a>
                  </div>
                </div>
              </div>
            <?php } ?>
            <div class="col-lg">
              <iframe style="width: inherit;" height="700" src="https://datastudio.google.com/embed/reporting/0e29b03b-e92a-479b-b247-4df28b2b0e74/page/tWDGB" frameborder="0" style="border:0" allowfullscreen></iframe>
              <div class="gap"></div>
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?= $this->endSection(); ?>