<?php include_once(VIEWPATH . '/inc/header.php'); ?>
<section class="content-header">
    <h1>Project List</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cubes"></i> Master</a></li>
        <li class="active">Project List</li>
    </ol>
</section>

<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#add_modal">
                <span class="fa fa-plus-circle"></span> Add New Project
            </button>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-hover table-bordered table-striped" id="project_list">
                <thead>
                    <tr>
                        <th class="text-center">S.No</th>
                        <th>Project Code</th>
                        <th>Project Name</th>
                        <th>Client Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Project Status</th>
                        <th>Status</th>
                        <th class="text-center" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($record_list as $j => $row): ?>
                        <tr>
                            <td class="text-center"><?= $sno + $j + 1 ?></td>
                            <td><?= htmlspecialchars($row['project_code']) ?></td>
                            <td><?= htmlspecialchars($row['project_name']) ?></td>
                            <td><?= htmlspecialchars($row['client_name']) ?></td>
                            <td><?= date('d-m-Y', strtotime($row['start_date'])) ?></td>
                            <td><?= $row['end_date'] ? date('d-m-Y', strtotime($row['end_date'])) : '-' ?></td>
                            <td><?= htmlspecialchars($row['project_status']) ?></td>
                            <td><?= htmlspecialchars($row['status']) ?></td>
                            <td class="text-center">
                                <button data-toggle="modal" data-target="#edit_modal" value="<?= $row['project_id'] ?>"
                                    class="edit_record btn btn-primary btn-xs" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <button value="<?= $row['project_id'] ?>" class="del_record btn btn-danger btn-xs"
                                    title="Delete">
                                    <i class="fa fa-remove"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Add Modal -->
            <div class="modal fade" id="add_modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="post" action="<?= site_url('project-list') ?>" id="frmadd">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><strong>Add New Project</strong></h4>
                                <input type="hidden" name="mode" value="Add" />
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Client Name</label>
                                            <?php echo form_dropdown(
                                                'client_id',
                                                array('' => 'Select Client') + $client_opt,
                                                set_value('client_id'),
                                                'id="client_id" class="form-control"'
                                            ); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Project Code</label>
                                        <input type="text" name="project_code" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>Project Name</label>
                                        <input type="text" name="project_name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>Project Description</label>
                                        <textarea name="project_description" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Start Date</label>
                                        <input type="date" name="start_date" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>End Date</label>
                                        <input type="date" name="end_date" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="project_status">Project Status</label>
                                        <?php echo form_dropdown(
                                            'project_status',
                                            array('' => 'Select Project Status') + $project_status_opt,
                                            set_value('project_status'),
                                            'id="project_status" class="form-control"'
                                        ); ?>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Status</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" value="Active" checked="true" />
                                                    Active
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" value="InActive" /> InActive
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="edit_modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="post" action="<?= site_url('project-list') ?>" id="frmedit">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><strong>Edit Project</strong></h4>
                                <input type="hidden" name="mode" value="Edit" />
                                <input type="hidden" name="project_id" id="project_id" />
                            </div>
                            <div class="modal-body">
                                <!-- Same fields as Add modal, will be filled by JS -->
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="client_id">Select Client</label>
                                        <?php echo form_dropdown(
                                            'client_id',
                                            array('' => 'Select Client') + $client_opt,
                                            set_value('client_id'),
                                            'id="client_id_edit" class="form-control"'
                                        ); ?>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Project Code</label>
                                        <input type="text" name="project_code" id="project_code" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>Project Name</label>
                                        <input type="text" name="project_name" id="project_name" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>Project Description</label>
                                        <textarea name="project_description" id="project_description"
                                            class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>End Date</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="project_status">Project Status</label>
                                        <?php echo form_dropdown(
                                            'project_status',
                                            array('' => 'Select Project Status') + $project_status_opt,
                                            set_value('project_status'),
                                            'id="project_status_edit" class="form-control"'
                                        ); ?>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Status</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" value="Active" checked="true" />
                                                    Active
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" value="InActive" /> InActive
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="box-footer">
            <div class="form-group col-sm-6">
                <label>Total Records: <?= $total_records ?></label>
            </div>
            <div class="form-group col-sm-6 text-right">
                <?= $pagination ?>
            </div>
        </div>
    </div>
</section>

<?php include_once(VIEWPATH . 'inc/footer.php'); ?>