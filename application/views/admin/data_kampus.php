<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow">
        <div class="card-header py-3">
            <h class="m-0 font-weight-bold text-primary">Data Kampus</h>
            <a href="<?= base_url('admin/data_kampus/tambah_kampus') ?>" class="btn btn-outline-primary waves-effect btn-sm float-right"> Tambah Kampus </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-md text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Institusi</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Daerah</th>
                            <th scope="col">Link</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($kampus as $mb) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <img width="60px" src="<?= base_url() . './assets/assets_user/img/portfolio/' . $mb->gambar; ?>">
                                </td>
                                <td><?= $mb->kode_perguruan; ?></td>
                                <td><?= $mb->nama; ?></td>
                                <td><?= $mb->daerah; ?></td>
                                <td><?= $mb->link; ?></td>
                                <td>
                                    <a href="" type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#detailModal<?= $mb->id_perguruan ?>"><i class="fas fa-eye"></i></a>
                                    <a href="" type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editModal<?= $mb->id_perguruan ?>"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url() ?>admin/data_kampus/destroy_datakampus/<?= $mb->id_perguruan ?>" type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php foreach ($kampus as $mb) : ?>
    <div class="modal fade" id="editModal<?= $mb->id_perguruan ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Edit Kampus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/data_kampus/update_kampus_aksi/'); ?><?= $mb->id_perguruan ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id_perguruan" value="<?php echo $mb->id_perguruan; ?>">
                            <select name="kode_perguruan" id="kode_perguruan" class="form-control">
                                <?php foreach ($perguruan as $tp) : ?>
                                    <option value="<?php echo $tp->kode_perguruan ?>"><?php echo $tp->nama_perguruan;  ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('kode_perguruan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $mb->nama; ?>">
                            <?= form_error('merk', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="daerah" id="daerah" placeholder="Daerah" value="<?php echo $mb->daerah; ?>">
                            <?= form_error('daerah', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="link" id="link" placeholder="Link" value="<?php echo $mb->link; ?>">
                            <?= form_error('warna', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?= base_url() . './assets/assets_user/img/portfolio/' . $mb->gambar; ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="form-control" name="gambar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php foreach ($kampus as $dt) : ?>
    <div class="modal fade" id="detailModal<?= $dt->id_perguruan ?>" tabindex="-1" aria-labelledby="detailPerguruanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailPerguruanModalLabel">Detail Kampus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <table class="table table-striped ">
                            <tr>
                                <th>Kode Perguruan</th>
                                <td><?= $dt->kode_perguruan ?></td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td><?= $dt->nama ?></td>
                            </tr>
                            <tr>
                                <th>Daerah</th>
                                <td><?= $dt->daerah ?></td>
                            </tr>
                            <tr>
                                <th>Link</th>
                                <td><?= $dt->link ?></td>
                            </tr>
                            <tr>
                                <th>Gambar</th>
                                <td class="col-sm-7">
                                    <img src="<?= base_url() . './assets/assets_user/img/portfolio/' . $dt->gambar; ?>" class="img-thumbnail">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $dt->id_perguruan ?>">Update</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>