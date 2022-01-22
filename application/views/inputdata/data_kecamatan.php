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
      <?= form_error('nama_kecamatan', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= form_error('id_kabupaten_kota', '<div class="alert alert-danger" role="alert">', '</div>'); ?>


      <?= $this->session->flashdata('message'); ?>

    
      
         <div class="card-body">
             <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#kecamatanModal">Tambah Data Kecamatan</a>
                <table id="example2" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Kecamatan</th>
            <th scope="col">Kabupaten/Kota</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($kecamatan as $k) : ?>

            <tr>
              <th scope="row"><?= $i; ?></th>
              <td><?= $k['nama_kecamatan']; ?></td>
              <td><?= $k['jenis']; ?> | <?= $k['nama_kabupaten_kota']; ?> </td>
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
<div class="modal fade " id="kecamatanModal" tabindex="-1" role="dialog" aria-labelledby="kecamatanModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kecamatanModalLabel">Input Data Kecamatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/inputdata_kecamatan'); ?>" method="post">
        <div class="modal-body">


          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Kecamatan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama_kecamatan" name="nama_kecamatan">
              <?= form_error('nama_kecamatan', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>
            <div class="form-group row">
           <label class="col-sm-2 col-form-label">Kabupaten/Kota</label>
            <div class="col-lg">
              <select name="id_kabupaten_kota" class="form-control">
                <option value="">Select</option>
                <!--   pilih pegawai berdasarkan bagian -->
                <?php foreach ($kabupaten_kota as $p) : ?>
                  <option value="<?= $p['id']; ?>"><?= $p['jenis']; ?><?= $p['nama_kabupaten_kota']; ?></option>
                <?php endforeach; ?>
              </select>
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
  
 
   