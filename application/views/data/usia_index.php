<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $judul?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= $judul?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-white">
              
              <!-- /.card-header -->
             <div class="row">
             <div class="col-lg">
                <?= form_error('rentang_usia', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
               
                <?= $this->session->flashdata('message'); ?>

    
      
            <div class="card-body">
             <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#datakabModal">Tambah Data usia</a>

                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Rentang Usia</th>
                    <th scope="col">Action</th>
                  </tr>
                  </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($data_usia as $k) : ?>

                          <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $k['rentang_usia']; ?></td>
                            <td>
                              <a href="<?= base_url() ?>admin/edit_kategori/" class="badge badge-success">edit</a>
                              <a href="<?= base_url() ?>admin/deletekategori/" class="badge badge-danger" onclick="return confirm('yakin ingin menghapus?')">hapus</a>
                            </td>
                          </tr>
                          <?php $i++; ?>
                        <?php endforeach; ?>
                      </tbody>
                  </table>
                </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
            </div>
              <div class="modal fade " id="datakabModal" tabindex="-1" role="dialog" aria-labelledby="datakabModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg " role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="datakabModalLabel">Input Data usia</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="<?= base_url('/adm/data/store_usia'); ?>" method="post">
                      <div class="modal-body">


                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Rentang usia </label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="rentang_usia" name="rentang_usia">
                        <?= form_error('rentang_usia', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                   
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                  </div>
                </form>
              </div>
            </div>
          </div>


          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
 
   