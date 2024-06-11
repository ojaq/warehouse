<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Data Unit Management
<?= $this->endSection('title') ?>

<?= $this->section('subtitle') ?>
<?= form_button('', '<i class="fa fa-plus-circle"></i> Tambah Data', [
    'class' => 'btn btn-primary',
    'onclick' => "location.href=('" . site_url('unit/add') . "')"
]) ?>
<?= $this->endSection('subtitle') ?>

<?= $this->section('content') ?>
<?= session()->getFlashdata('success') ?>

<?= form_open('unit/index') ?>
<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Search unit!" name="search" value="<?= $search ?>">
    <div class="input-group-append">
        <button class="btn btn-outline-primary" type="submit" id="searchbutton" name="searchbutton">
            <i class="fa fa-search"></i>
        </button>
    </div>
</div>
<?= form_close() ?>
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
        $number = 1 + (($pagenum - 1) * 5);
        foreach ($showdata as $row) :
        ?>
            <tr>
                <td><?= $number++; ?></td>
                <td><?= $row['unitname']; ?></td>
                <td>
                    <button type="button" class="btn btn-warning" title="Edit Data" onclick="edit('<?= $row['unitid'] ?>')">
                        <i class="fa fa-edit"></i>
                    </button>

                    <form method="post" action="/unit/delete/<?= $row['unitid'] ?>" style="display: inline;" onsubmit="return delet('<?= $row['unitname'] ?>');">
                        <input type="hidden" value="DELETE" name="_method">
                        <button type="submit" class="btn btn-danger" title="Delete Data">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="float-center">
    <?= $pager->links('unit', 'paging') ?>
</div>

<script>
    function edit(id) {
        window.location = ('/unit/edit/' + id);
    }

    function delet(unitname) {
        return confirm('Are you sure you want to delete the unit ' + unitname + '?');
    }
</script>

<?= $this->endSection('content') ?>