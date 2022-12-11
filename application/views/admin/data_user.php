<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow">
        <div class="card-header py-3">
            <h class="m-0 font-weight-bold text-primary">Data User</h>
            <a href="" class="btn btn-outline-primary waves-effect btn-sm float-right" data-toggle="modal" data-target="#newCustomerModal"> Tambah User </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-md text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Role</th>
                            <th scope="col">Aktif</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($users as $cs) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $cs->name; ?></td>
                                <td><?= $cs->nim; ?></td>
                                <td><?php
                                    if ($cs->role_id == "1") {
                                        echo "Admin";
                                    } else {
                                        echo "Member";
                                    } ?></td>
                                <td><?= date('d F Y', $cs->date_created); ?></td>
                                <td>
                                    <a href="" type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#detailModal<?= $cs->id ?>"><i class="fas fa-eye"></i></a>
                                    <a href="" type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editModal<?= $cs->id ?>"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url() ?>admin/data_user/destroy_datauser/<?= $cs->id ?>" type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
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

<!-- Modal Tambah -->
<div class="modal fade" id="newCustomerModal" tabindex="-1" aria-labelledby="newCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCustomerModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('auth/registration'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nim" name="nim" placeholder="NIM">
                        <?= form_error('nim', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<?php foreach ($users as $cs) : ?>
    <div class="modal fade" id="detailModal<?= $cs->id ?>" tabindex="-1" aria-labelledby="detailCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailCustomerModalLabel">Detail User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <table class="table table-striped ">
                            <tr>
                                <th>Nama</th>
                                <td><?= $cs->name ?></td>
                            </tr>
                            <tr>
                                <th>NIM</th>
                                <td><?= $cs->nim ?></td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>
                                    <?php
                                    if ($cs->role_id == "1") {
                                        echo "<span class='badge badge-danger'>Admin</span>";
                                    } else {
                                        echo "<span class='badge badge-primary'>Member</span>";
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Aktif</th>
                                <td><?= date('d F Y', $cs->date_created); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $cs->id ?>">Update</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Edit -->
<?php foreach ($users as $cs) : ?>
    <div class="modal fade" id="editModal<?= $cs->id ?>" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/data_user/update_user/'); ?><?= $cs->id ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $cs->id ?>">
                            <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?php echo $cs->name ?>">
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class=" form-group">
                            <input type="text" class="form-control" id="nim" name="nim" placeholder="nim" value="<?php echo $cs->nim ?>" readonly>
                            <?= form_error('nim', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class=" form-group">
                            <select name="role_id" id="role_id" class="form-control">
                                <option <?php if ($cs->role_id == "1") {
                                            echo "selected='selected'";
                                        }
                                        echo $cs->role_id; ?> value="1">Admin</option>
                                <option <?php if ($cs->role_id == "0") {
                                            echo "selected='selected'";
                                        }
                                        echo $cs->role_id; ?> value="2">Member</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="date_created" name="date_created" placeholder="Telepon" value="<?= date('d F Y', $cs->date_created); ?>" readonly>
                            <?= form_error('date_created', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>