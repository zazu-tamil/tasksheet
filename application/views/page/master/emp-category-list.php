<?php include_once(VIEWPATH . '/inc/header.php'); ?>
<section class="content-header">
    <h1>Employee Category List</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cubes"></i> Master</a></li>
        <li class="active">Employee Category List</li>
    </ol>
</section>

<section class="content">
    <div class="box box-info">
        <div class="box-header with-border">
            <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#add_modal">
                <span class="fa fa-plus-circle"></span> Add New Category
            </button>
        </div>

        <div class="box-body table-responsive">
            <table class="table table-hover table-bordered table-striped" id="emp_category_list">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Category Name</th>
                        <th>Category Code</th>
                        <th>Status</th>
                        <th colspan="2" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($record_list as $j => $ls) { ?>
                        <tr>
                            <td class="text-center"><?php echo ($j + 1); ?></td>
                            <td><?php echo htmlspecialchars($ls['emp_category_name']); ?></td>
                            <td><?php echo htmlspecialchars($ls['emp_category_code']); ?></td>
                            <td><?php echo $ls['status']; ?></td>
                            <td>
                                <button data-toggle="modal" data-target="#edit_modal"
                                    value="<?php echo $ls['emp_category_id']; ?>" class="edit_record btn btn-primary btn-xs"
                                    title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                            <td>
                                <?php if ($this->session->userdata(SESS_HD . 'level') == 'Admin') { ?>
                                    <button value="<?php echo $ls['emp_category_id']; ?>" class="del_record btn btn-danger btn-xs"
                                        title="Delete">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- ADD MODAL -->
            <div class="modal fade" id="add_modal" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="" id="frmadd">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title">Add Employee Category</h3>
                                <input type="hidden" name="mode" value="Add" />
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label>Category Name</label>
                                        <input class="form-control" type="text" name="emp_category_name" placeholder="Category Name" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Category Code</label>
                                        <input class="form-control" type="text" name="emp_category_code" placeholder="e.g. EX" maxlength="2" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Status</label><br>
                                        <label><input type="radio" name="status" value="Active" checked> Active</label>
                                        <label class="ml-3"><input type="radio" name="status" value="InActive"> InActive</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" value="Save" class="btn btn-primary" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- EDIT MODAL -->
            <div class="modal fade" id="edit_modal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" action="" id="frmedit">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title">Edit Employee Category</h3>
                                <input type="hidden" name="mode" value="Edit" />
                                <input type="hidden" name="emp_category_id" id="emp_category_id" />
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label>Category Name</label>
                                        <input class="form-control" type="text" name="emp_category_name" id="emp_category_name" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Category Code</label>
                                        <input class="form-control" type="text" name="emp_category_code" id="emp_category_code" maxlength="2" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Status</label><br>
                                        <label><input type="radio" name="status" value="Active"> Active</label>
                                        <label class="ml-3"><input type="radio" name="status" value="InActive"> InActive</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" value="Update" class="btn btn-primary" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-footer">
            <div class="form-group col-sm-6">
                <label>Total Records : <?php echo $total_records; ?></label>
            </div>
            <div class="form-group col-sm-6">
                <?php echo $pagination; ?>
            </div>
        </div>
    </div>
</section>

<?php include_once(VIEWPATH . 'inc/footer.php'); ?>

