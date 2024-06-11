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
<script>
    function edit(id) {
        window.location = ('/unit/edit/' + id);
    }

    function delet(unitname) {
        return confirm('Are you sure you want to delete the unit ' + unitname + '?');
    }
</script>

<?= $this->endSection('content') ?>