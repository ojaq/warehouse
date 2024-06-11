<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Edit Category
<?= $this->endSection('title') ?>

<?= $this->section('subtitle') ?>
<?= form_button('', '<i class="fa fa-backward"></i> Back', [
    'class' => 'btn btn-warning',
    'onclick' => "location.href=('" . site_url('category/index') . "')"
]) ?>
<?= $this->endSection('subtitle') ?>

<?= $this->section('content') ?>
<?= form_open('category/update', '', [
    'idcategory' => $id,
]) ?>
<div class="form-group">
    <label for="category">Category</label>
    <?= form_input('categoryname', $name, [
        'class' => 'form-control',
        'id' => 'category',
        'autofocus' => true,
    ]) ?>
    <?= session()->getFlashdata('errorCategoryName') ?>
</div>

<div class="form-group">
    <?= form_submit('', 'Update', [
        'class' => 'btn btn-success'
    ]) ?>
</div>
<?= form_close() ?>
<?= $this->endSection('content') ?>