<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Stock Out</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active">Stock Out</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Stock Out List</h3>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#stockOutModal" onclick="openAddStockOutModal()">Add Stock Out</button>
                </div>
                <div class="card-body">
                    <input type="hidden" class="base_url" value="<?= base_url() ?>" />
                    <table class="table table-bordered table-striped" id="stockOutTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Part Name</th>
                                <th>Quantity</th>
                                <th>Date</th>
                                <th>Issued By</th>
                                <th>Remarks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($stock_out)) : ?>
                                <?php foreach ($stock_out as $item) : ?>
                                    <tr data-id="<?= $item['id'] ?>">
                                        <td><?= htmlspecialchars($item['id']) ?></td>
                                        <td><?= htmlspecialchars($item['part_name']) ?></td>
                                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                                        <td><?= htmlspecialchars($item['date']) ?></td>
                                        <td><?= htmlspecialchars($item['issued_by']) ?></td>
                                        <td><?= htmlspecialchars($item['remarks']) ?></td>
                                        <td>
                                            <button class="btn btn-info btn-xs edit-btn" onclick="openEditStockOutModal(<?= $item['id'] ?>, this)">Edit</button>
                                            <button class="btn btn-danger btn-xs delete-btn" onclick="deleteStockOut(<?= $item['id'] ?>, this)">Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No stock out records found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Stock Out Modal -->
    <div class="modal fade" id="stockOutModal" tabindex="-1" role="dialog" aria-labelledby="stockOutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="stockOutForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="stockOutModalLabel">Add Stock Out</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="stockOutId">
                        <div class="form-group">
                            <label for="part_name">Part Name</label>
                            <input type="text" class="form-control" name="part_name" id="part_name" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity" id="quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" name="date" id="date" required>
                        </div>
                        <div class="form-group">
                            <label for="issued_by">Issued By</label>
                            <input type="text" class="form-control" name="issued_by" id="issued_by" required>
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <input type="text" class="form-control" name="remarks" id="remarks">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveStockOutBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 