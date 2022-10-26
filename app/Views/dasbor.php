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
            <div class="col-lg-3 col-6">
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
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?= $klik[0]->click; ?></h3>
                  <p>Total Link Klik</p>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?= $user; ?></h3>
                  <p>Pengguna Terdaftar</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?= $agen; ?></h3>
                  <p>Agen Terdaftar</p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5>Data Folder Sentral NUTRIFEED</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <?php foreach ($folder as $f) { ?>
              <div class="col-12 col-lg-6">
                <a href="<?= $f['link']; ?>" class="link-data">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-inline-block">
                        <img class="icon-link" src="/img/link.svg">
                        <div class="d-inline-block col-9">
                          <h5><?= $f['folder']; ?></h5>
                          <hr>
                          <p><?= $f['desc']; ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            <?php } ?>
          </div>
          <div class="row">
            <div class="col">
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