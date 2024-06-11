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
                    <button type="button" class="btn btn-warning" title="Edit Data" onclick="edit('<?= $row['catid'] ?>')">
                        <i class="fa fa-edit"></i>
                    </button>

                    <form method="post" action="/category/delete/<?= $row['catid'] ?>" style="display: inline;" onsubmit="return delet('<?= $row['catname'] ?>');">
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
        window.location = ('/category/edit/' + id);
    }

    function delet(catname) {
        return confirm('Are you sure you want to delete the category ' + catname + '?');
    }
</script>

<?= $this->endSection('content') ?>