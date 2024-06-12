<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Add Item
<?= $this->endSection('title') ?>

<?= $this->section('subtitle') ?>
<button type="button" class="btn btn-warning" onclick="location.href=('/item/index')">
    <i class="fa fa-backward"></i> Back
</button>
<?= $this->endSection('subtitle') ?>

<?= $this->section('content') ?>
<?= form_open_multipart('item/save') ?>
<?= session()->getFlashdata('error') ?>
<?= session()->getFlashdata('success') ?>
<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Item Code</label>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="itemid" name="itemid" autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Item Name</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="itemname" name="itemname">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Category</label>
    <div class="col-sm-8">
        <select name="category" id="category" class="form-control">
            <option selected value="">Choose</option>
            <?php foreach ($datacategory as $cat) : ?>
            <option value="<?= $cat['catid'] ?>"><?= $cat['catname'] ?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Unit</label>
    <div class="col-sm-8">
        <select name="unit" id="unit" class="form-control">
            <option selected value="">Choose</option>
            <?php foreach ($dataunit as $unit) : ?>
            <option value="<?= $unit['unitid'] ?>"><?= $unit['unitname'] ?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Price</label>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="itemprice" name="itemprice">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Stock</label>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="itemstock" name="itemstock">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Upload Image (<i>Optional</i>)</label>
    <div class="col-sm-8">
        <input type="file" id="image" name="image">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label"></label>
    <div class="col-sm-8">
        <input type="submit" value="Add" class="btn btn-success">
    </div>
</div>
<?= form_close() ?>
<?= $this->endSection('content') ?>