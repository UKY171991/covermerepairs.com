<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Part Details</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Brand</th>
                                <td><?php echo htmlspecialchars($part->brand_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                            <tr>
                                <th>Model</th>
                                <td><?php echo htmlspecialchars($part->model_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                            <tr>
                                <th>Part Type</th>
                                <td><?php echo htmlspecialchars($part->part_type_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                            <tr>
                                <th>Min Price</th>
                                <td><?php echo htmlspecialchars($part->price_min, ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                            <tr>
                                <th>Max Price</th>
                                <td><?php echo htmlspecialchars($part->price_max, ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                            <tr>
                                <th>Added By</th>
                                <td><?php echo htmlspecialchars($part->user_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="<?php echo base_url('part'); ?>" class="btn btn-primary mt-3">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
