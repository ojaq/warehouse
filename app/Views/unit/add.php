<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Add Unit
<?= $this->endSection('title') ?>

<?= $this->section('subtitle') ?>
<?= form_button('', '<i class="fa fa-backward"></i> Back', [
    'class' => 'btn btn-warning',
    'onclick' => "location.href=('" . site_url('unit/index') . "')"
]) ?>
<?= $this->endSection('subtitle') ?>

<?= $this->section('content') ?>
<?= form_open('unit/save') ?>
<div class="form-group">
    <label for="unit">Unit</label>
    <?= form_input('unitname', '', [
        'class' => 'form-control',
        'id' => 'unit',
        'autofocus' => true,
        'placeholder' => 'Unit',
    ]) ?>
    <?= session()->getFlashdata('errorUnitName') ?>
</div>

<div class="form-group">
    <?= form_submit('', 'Add', [
        'class' => 'btn btn-success'
    ]) ?>
</div>
<?= form_close() ?>
<?= $this->endSection('content') ?>