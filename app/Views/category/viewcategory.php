<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Data Category Management
<?= $this->endSection('title') ?>

<?= $this->section('subtitle') ?>
<?= form_button('', '<i class="fa fa-plus-circle"></i> Tambah Data', [
    'class' => 'btn btn-primary',
    'onclick' => "location.href=('" . site_url('category/add') . "')"
]) ?>
<?= $this->endSection('subtitle') ?>

<?= $this->section('content') ?>
<?= session()->getFlashdata('success') ?>
<table class="table table-striped table-borderer" style="width: 100%;">
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th>Category</th>
            <th style="width: 15%;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $number = 1;
        foreach ($showdata as $row) :
        ?>
            <tr>
                <td><?= $number++; ?></td>
                <td><?= $row['catname']; ?></td>
                <td>
                    
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection('content') ?>