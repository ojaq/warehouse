<?= $this->extend('main/layout') ?>

<?= $this->section('title') ?>
Data Item Management
<?= $this->endSection('title') ?>

<?= $this->section('subtitle') ?>
<button type="button" class="btn btn-primary" onclick="location.href=('/item/add')">
    <i class="fa fa-plus-circle"></i> Add Item
</button>
<?= $this->endSection('subtitle') ?>

<?= $this->section('content') ?>
<?= session()->getFlashdata('msg') ?>
<?= session()->getFlashdata('errmsg') ?>
<?= session()->getFlashdata('deleted') ?>
<?= session()->getFlashdata('saved') ?>
<?= session()->getFlashdata('updated') ?>
<table class="table table-striped table-bordered" style="width: 100%;">
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th>Item Code</th>
            <th>Item Name</th>
            <th>Category</th>
            <th>Unit</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Image</th>
            <th style="width: 15%;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $number = 1;
        foreach ($showdata as $row) : ?>
            <tr>
                <td><?= $number++; ?></td>
                <td><?= $row['itemid']; ?></td>
                <td><?= $row['itemname']; ?></td>
                <td><?= $row['categoryname']; ?></td>
                <td><?= $row['unitname']; ?></td>
                <td><?= number_format($row['itemprice'], 0); ?></td>
                <td><?= number_format($row['itemstock'], 0); ?></td>
                <td>
                    <?php if ($row['itemimage']) : ?>
                        <img src="<?= base_url($row['itemimage']); ?>" alt="<?= $row['itemname']; ?>" width="50">
                    <?php else : ?>
                        No Image
                    <?php endif; ?>
                </td>
                <td>
                    <button type="button" class="btn btn-warning" title="Edit Data" onclick="edit('<?= $row['itemid'] ?>')">
                        <i class="fa fa-edit"></i>
                    </button>

                    <form method="post" action="/item/delete/<?= $row['itemid'] ?>" style="display: inline;" onsubmit="return delet('<?= $row['itemname'] ?>');">
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
        window.location = ('/item/edit/' + id);
    }

    function delet(itemname) {
        return confirm('Are you sure you want to delete the item ' + itemname + '?');
    }
</script>
<?= $this->endSection('content') ?>