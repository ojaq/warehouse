<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Data Unit Management
<?= $this->endSection('title') ?>

<?= $this->section('subtitle') ?>
<?= form_button('', '<i class="fa fa-plus-circle"></i> Tambah Data',[
    'class' => 'btn btn-primary',
    'onclick' => "location.href=('".site_url('unit/add')."')"
]) ?>
<?= $this->endSection('subtitle') ?>

<?= $this->section('content') ?>
<?= session()->getFlashdata('success') ?>
<table class="table table-striped table-borderer" style="width: 100%;">
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th>Unit</th>
            <th style="width: 15%;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $number = 1;
        foreach ($showdata as $row):
        ?>
            <tr>
                <th><?= $number++; ?></th>
                <th><?= $row['unitname']; ?></th>
                <th></th>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection('content') ?>