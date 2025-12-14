<?php include_once(VIEWPATH . '/inc/header.php'); ?>

<section class="content-header">
    <h1>Task List</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-tasks"></i> Master</a></li>
        <li class="active">Task List</li>
    </ol>
</section>

<section class="content">
    <div class="box box-info">
        <div class="box-header with-border">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_modal">
                <i class="fa fa-plus-circle"></i> Add New Task
            </button>
        </div>

        <div class="box-body table-responsive">
            <table class="table table-bordered table-hover table-striped" id="task_table">
                <thead>
                    <tr>
                        <th class="text-center">S.No</th>
                        <th>Task Title</th>
                        <th>Client</th>
                        <th>Project</th>
                        <th>Priority</th>
                        <th>Task Status</th>
                        <th>Start Date</th>
                        <th>Due Date</th>
                        <th class="text-center" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($record_list as $j => $row): ?>
                        <tr>
                            <td class="text-center"><?= $sno + $j + 1 ?></td>
                            <td><?= htmlspecialchars($row['task_title']) ?></td>
                            <td><?= htmlspecialchars($row['client_name'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($row['project_name'] ?? '-') ?></td>
                            <?php
                            $priority = trim($row['priority'] ?? '');

                            $priority_class = [
                                'Low' => 'success',
                                'Medium' => 'warning',
                                'High' => 'danger',
                                'Critical' => 'danger',
                            ];
                            ?>

                            <td>
                                <?php if ($priority !== '') { ?>
                                    <span class="label label-<?= $priority_class[$priority] ?? 'default' ?>">
                                        <?= htmlspecialchars($priority) ?>
                                    </span>
                                <?php } else { ?>
                                    -
                                <?php } ?>
                            </td>
                            <?php
                            $status = trim($row['task_status'] ?? '');

                            $status_class = [
                                'Pending' => 'warning',
                                'In Progress' => 'info',
                                'Completed' => 'success',
                                'On Hold' => 'danger',
                            ];
                            ?>

                            <td>
                                <?php if ($status !== '') { ?>
                                    <span class="label label-<?= $status_class[$status] ?? 'default' ?>">
                                        <?= htmlspecialchars($status) ?>
                                    </span>
                                <?php } else { ?>
                                    -
                                <?php } ?>
                            </td>


                            <td><?= $row['start_date'] ? date('d-m-Y', strtotime($row['start_date'])) : '-' ?></td>
                            <td><?= $row['due_date'] ? date('d-m-Y', strtotime($row['due_date'])) : '-' ?></td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-primary edit_record" value="<?= $row['task_id'] ?>"
                                    title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-danger del_record" value="<?= $row['task_id'] ?>"
                                    title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="box-footer clearfix">
            <div class="pull-left">
                <label>Total Records: <?= $total_records ?></label>
            </div>
            <div class="pull-right">
                <?= $pagination ?>
            </div>
        </div>
    </div>
</section>

<!-- Add Modal -->
<div class="modal fade" id="add_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="<?= site_url('task-list') ?>" id="frm_add">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><strong>Add New Task</strong></h4>
                    <input type="hidden" name="mode" value="Add">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Client <span class="text-red">*</span></label>
                                <?= form_dropdown('client_id', $client_opt, set_value('client_id'), 'class="form-control" id="client_id" required') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Project <span class="text-red">*</span></label>
                                <?= form_dropdown('project_id', $project_opt, set_value('project_id'), 'class="form-control" id="project_id" required') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Task Title <span class="text-red">*</span></label>
                                <input type="text" name="task_title" id="task_title" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Task Description</label>
                                <textarea name="task_description" id="task_description" class="form-control"
                                    rows="4"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Priority</label>
                                <?= form_dropdown('priority', $priority_opt, set_value('priority', 'Medium'), 'class="form-control" id="priority"') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Task Status</label>
                                <?= form_dropdown('task_status', $status_opt, set_value('task_status', 'Pending'), 'class="form-control" id="task_status"') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Due Date</label>
                                <input type="date" name="due_date" id="due_date" class="form-control">
                            </div>
                        </div>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="edit_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="<?= site_url('task-list') ?>" id="frm_edit">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><strong>Edit Task</strong></h4>
                    <input type="hidden" name="mode" value="Edit">
                    <input type="hidden" name="task_id" id="task_id">
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Client <span class="text-red">*</span></label>
                                    <?= form_dropdown('client_id', $client_opt, set_value('client_id'), 'class="form-control" id="client_id" required') ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Project <span class="text-red">*</span></label>
                                    <?= form_dropdown('project_id', $project_opt, set_value('project_id'), 'class="form-control" id="project_id" required') ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Task Title <span class="text-red">*</span></label>
                                    <input type="text" name="task_title" id="task_title" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Task Description</label>
                                    <textarea name="task_description" id="task_description" class="form-control"
                                        rows="4"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Priority</label>
                                    <?= form_dropdown('priority', $priority_opt, set_value('priority', 'Medium'), 'class="form-control" id="priority"') ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Task Status</label>
                                    <?= form_dropdown('task_status', $status_opt, set_value('task_status', 'Pending'), 'class="form-control" id="task_status"') ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Due Date</label>
                                    <input type="date" name="due_date" id="due_date" class="form-control">
                                </div>
                            </div>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Update Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once(VIEWPATH . '/inc/footer.php'); ?>