<?php $ajax = 'model'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Model Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Model</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <?php if($this->session->userdata('user_type') =='1' OR $this->session->userdata('user_type') =='4'){ ?>
                            <button class="card-btn btn btn-info btn-sm" data-toggle='modal' data-target='#edit_data' onclick="reset()">Add Model</button>
                            <?php } ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="model-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Model Name<br><input type="text" class="form-control form-control-sm search-col" data-col="name" placeholder="Search Model"></th>
                                        <th>Brand Name<br><input type="text" class="form-control form-control-sm search-col" data-col="brand" placeholder="Search Brand ID"></th>
                                        <th>User Name<br><input type="text" class="form-control form-control-sm search-col" data-col="user" placeholder="Search User ID"></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="model-tbody">
                                    <!-- Data will be loaded here by JS -->
                                </tbody>
                            </table>
                            <div class="mt-3" id="pagination-links"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

<!-- Modal for Add/Edit Model -->
<div class="modal fade" id="edit_data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add/Edit Model</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=base_url('part/add_model')?>" method="post" id="submit_data">
                <div class="modal-body">
                    <input type="hidden" name="id" class="form-control id">
                    <div class="form-group">
                        <label>Model Name</label>
                        <input type="text" name="name" class="form-control name" required>
                    </div>
                    <div class="form-group">
                        <label>Brand Name</label>
                        <select name="brand_id" class="form-control brand_id" required>
                            <option value="">Select Brand</option>
                            <?php foreach($brand as $brands){ ?>
                            <option Value="<?=$brands->id?>"><?=$brands->name?></option>
                            <?php } ?>
                            <!-- Dynamic Brands -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let currentPage = 1;
    let perPage = 10;
    let search = { name: '', brand: '', user: '' };

    function fetchData(page = 1) {
        let params = {
            page: page,
            limit: perPage,
            name: search.name,
            brand: search.brand,
            user: search.user
        };
        $.getJSON('<?= base_url('part/model_ajax') ?>', params, function(res) {
            let rows = '';
            if (res.data.length > 0) {
                let i = (page - 1) * perPage + 1;
                res.data.forEach(function(row) {
                    rows += `<tr>
                        <td>${i++}</td>
                        <td>${row.name}</td>
                        <td>${row.brand}</td>
                        <td>${row.user}</td>
                        <td>`;
                    if (row.can_edit) {
                        rows += `<button data-toggle='modal' data-target='#edit_data' onclick='return edit(${row.id})' class='btn btn-info btn-xs m-1'><i class='fas fa-pencil-alt'></i></button>`;
                        rows += `<button onclick='return del(${row.id})' class='btn btn-danger btn-xs m-1'><i class='fa fa-trash' aria-hidden='true'></i></button>`;
                    } else {
                        rows += `<button class='btn btn-info btn-xs m-1' disabled><i class='fas fa-pencil-alt'></i></button>`;
                        rows += `<button class='btn btn-danger btn-xs m-1' disabled><i class='fa fa-trash' aria-hidden='true'></i></button>`;
                    }
                    rows += `</td></tr>`;
                });
            } else {
                rows = `<tr><td colspan="5" class="text-center">No models found</td></tr>`;
            }
            $('#model-tbody').html(rows);
            renderPagination(res.total, page);
        });
    }

    function renderPagination(total, page) {
        let totalPages = Math.ceil(total / perPage);
        let html = '<ul class="pagination">';
        if (page > 1) {
            html += `<li class="page-item"><a class="page-link" href="#" data-page="1">First</a></li>`;
            html += `<li class="page-item"><a class="page-link" href="#" data-page="${page-1}">&laquo;</a></li>`;
        }
        for (let i = 1; i <= totalPages; i++) {
            html += `<li class="page-item${i === page ? ' active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
        }
        if (page < totalPages) {
            html += `<li class="page-item"><a class="page-link" href="#" data-page="${page+1}">&raquo;</a></li>`;
            html += `<li class="page-item"><a class="page-link" href="#" data-page="${totalPages}">Last</a></li>`;
        }
        html += '</ul>';
        $('#pagination-links').html(html);
    }

    // Pagination click
    $('#pagination-links').on('click', 'a.page-link', function(e) {
        e.preventDefault();
        let page = parseInt($(this).data('page'));
        if (!isNaN(page)) {
            currentPage = page;
            fetchData(currentPage);
        }
    });

    // Search input
    $('.search-col').on('input', function() {
        let col = $(this).data('col');
        search[col] = $(this).val();
        currentPage = 1;
        fetchData(currentPage);
    });

    // AJAX form submit for add/edit
    $('#submit_data').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                // Optionally show a message here
                currentPage = 1; // Always show latest
                fetchData(currentPage);
                $('#edit_data').modal('hide');
                form[0].reset();
            }
        });
    });

    // AJAX delete
    window.del = function(id) {
        if (confirm('Are you sure you want to delete this record?')) {
            $.post('<?= base_url('part/delete_model') ?>', { id: id }, function(response) {
                // Optionally show a message here
                fetchData(currentPage);
            });
        }
        return false;
    };

    // Initial load
    fetchData(currentPage);
});
</script>