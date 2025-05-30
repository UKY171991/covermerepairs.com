<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Stock In</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active">Stock In</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Stock In List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Part Name</th>
                                <th>Quantity</th>
                                <th>Date</th>
                                <th>Received By</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($stock_in)) : ?>
                                <?php foreach ($stock_in as $item) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['id']) ?></td>
                                        <td><?= htmlspecialchars($item['part_name']) ?></td>
                                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                                        <td><?= htmlspecialchars($item['date']) ?></td>
                                        <td><?= htmlspecialchars($item['received_by']) ?></td>
                                        <td><?= htmlspecialchars($item['remarks']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No stock in records found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div> 