<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Kode Wilayah</h4>
                <p class="card-category">Menu Kode Wilayah</p>
            </div>
            <div class="card-body">
                <a href="<?= site_url('KodeWilayah/import') ?>" class="btn btn-primary">Tambah Data</a>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="text-primary">
                            <tr>
                                <th>No</th>
                                <th>Kode Wilayah</th>
                                <th>Nama Wilayah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($kodeWilayah as $key=>$value): ?>
                                <tr>
                                    <td><?= $key+1 ?></td>
                                    <td><?= $value->kode_wilayah ?></td>
                                    <td><?= $value->nama_wilayah ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>