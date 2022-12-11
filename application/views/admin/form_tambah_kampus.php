<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header py-3">
            <h class="m-0 font-weight-bold text-primary">Tambah Kampus</h>
            <a href="<?= base_url('admin/data_kampus/tambah_kampus') ?>" class="btn btn-outline-primary waves-effect btn-sm float-right"> <i class="fas fa-fw fa-plus"></i> Tambah Kampus </a>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/data_kampus/tambah_kampus_aksi'); ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kode Perguruan</label>
                            <select name="kode_perguruan" id="kode_perguruan" class="form-control">
                                <option value="">--Pilih Perguruan--</option>
                                <?php foreach ($perguruan as $pr) : ?>
                                    <option value="<?= $pr->kode_perguruan; ?>"><?= $pr->nama_perguruan; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('kode_perguruan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control">
                            <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Daerah</label>
                            <input type="text" name="daerah" id="daerah" class="form-control">
                            <?= form_error('daerah', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Link</label>
                            <input type="text" name="link" id="link" class="form-control">
                            <?= form_error('link', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="gambar" id="gambar" class="form-control">
                        </div>
                        <button type="submit" class="btn-sm btn btn-primary float-right mt-4 ml-2">Simpan</button>
                        <button type="reset" class=" btn-sm btn btn-danger float-right mt-4 ml-2">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->