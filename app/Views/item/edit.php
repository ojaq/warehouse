<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Edit Item
<?= $this->endSection('title') ?>

<?= $this->section('subtitle') ?>
<button type="button" class="btn btn-warning" onclick="location.href=('/item/index')">
    <i class="fa fa-backward"></i> Back
</button>
<?= $this->endSection('subtitle') ?>

<?= $this->section('content') ?>
<?= form_open_multipart('item/update') ?>
<?= session()->getFlashdata('errmsg') ?>
<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Item Code</label>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="itemid" name="itemid" readonly value="<?= $itemid ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Item Name</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="itemname" name="itemname" value="<?= $itemname ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Category</label>
    <div class="col-sm-8">
        <select name="category" id="category" class="form-control">
            <?php foreach ($datacategory as $cat) : ?>
                <?php if ($cat['catid'] == $category) : ?>
                    <option selected value="<?= $cat['catid'] ?>"><?= $cat['catname'] ?></option>
                <?php else : ?>
                    <option value="<?= $cat['catid'] ?>"><?= $cat['catname'] ?></option>
                <?php endif ?>
            <?php endforeach ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Unit</label>
    <div class="col-sm-8">
        <select name="unit" id="unit" class="form-control">
            <?php foreach ($dataunit as $unit) : ?>
                <?php if ($unit['unitid'] == $unit) : ?>
                    <option selected value="<?= $unit['unitid'] ?>"><?= $unit['unitname'] ?></option>
                <?php else : ?>
                    <option value="<?= $unit['unitid'] ?>"><?= $unit['unitname'] ?></option>
                <?php endif ?>
            <?php endforeach ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Price</label>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="itemprice" name="itemprice" value="<?= $itemprice ?>">
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-4 col-form-label">Stock</label>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="itemstock" name="itemstock" value="<?= $itemstock ?>">
    </div>
</div>

<div class="form-group row">
    <label for="image" class="col-sm-4 col-form-label">Upload Image (<i>Optional</i>)</label>
    <div class="col-sm-8">
        <?php if (!empty($itemimage)) : ?>
            <div class="mb-3">
                <img src="<?= base_url($itemimage) ?>" alt="Current Image" class="img-thumbnail" style="max-width: 150px;">
            </div>
        <?php endif; ?>
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