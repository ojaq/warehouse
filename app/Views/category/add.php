<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Add Category
<?= $this->endSection('title') ?>

<?= $this->section('subtitle') ?>
<?= form_button('', '<i class="fa fa-backward"></i> Back', [
    'class' => 'btn btn-warning',
    'onclick' => "location.href=('" . site_url('category/index') . "')"
]) ?>
<?= $this->endSection('subtitle') ?>

<?= $this->section('content') ?>
<?= form_open('category/save') ?>
<div class="form-group">
    <label for="category">Category</label>
    <?= form_input('categoryname', '', [
        'class' => 'form-control',
        'id' => 'category',
        'autofocus' => true,
        'placeholder' => 'Category',
    ]) ?>
    <?= session()->getFlashdata('errorCategoryName') ?>
</div>

<div class="form-group">
    <?= form_submit('', 'Add', [
        'class' => 'btn btn-success'
    ]) ?>
</div>
<?= form_close() ?>
<?= $this->endSection('content') ?>