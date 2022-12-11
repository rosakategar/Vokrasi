<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow">

        <div class="card-header py-3">
            <h class="m-0 font-weight-bold text-primary">Import File</h>
            <button class="btn btn-outline-primary waves-effect btn-sm float-right" data-toggle="modal" data-target="#excel">Import Excel</button>
            <a href="<?= base_url('admin/Data_mahasiswa/mpdf'); ?>" class="btn btn-outline-primary waves-effect btn-sm float-right">Export PDF</a>
            <a href="<?= base_url('admin/Data_mahasiswa/export_excel'); ?>" class="btn btn-outline-primary waves-effect btn-sm float-right">Export Excel</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-md text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Angkatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($mahasiswa as $cs) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $cs->nim; ?></td>
                                <td><?= $cs->nama; ?></td>
                                <td><?= $cs->angkatan; ?></td>
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

<!-- Modal Tambah -->
<div class="modal fade" id="excel" tabindex="-1" aria-labelledby="newCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCustomerModalLabel">Import Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('admin/Data_mahasiswa/tambah_mahasiswa'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <input type="file" class="form-control form-control-user" id="excel" name="excel" accept=".xlsx,.xls">
                    <?= form_error('folder', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>