<?php include_once(VIEWPATH . '/inc/header.php'); ?>
<section class="content-header">
    <h1>Task Management</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-tasks"></i> Task</a></li>
        <li class="active">Task List</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#task_modal">
                <i class="fa fa-plus-circle"></i> Create New Task
            </button>
        </div>

        <div class="box-body table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th width="50">S.No</th>
                        <th>Task Title</th>
                        <th>Client / Project</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Assigned To</th>
                        <th width="100">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sno = $this->uri->segment(2, 0) + 1; ?>
                    <?php foreach ($record_list as $row): ?>
                    <tr>
                        <td><?= $sno++ ?></td>
                        <td>
                            <strong><?= htmlspecialchars($row['task_title']) ?></strong>
                            <?php if ($row['task_description']): ?>
                                <br><small class="text-muted">
                                    <?= character_limiter(strip_tags($row['task_description']), 80) ?>
                                </small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong><?= htmlspecialchars($row['client_name'] ?? 'N/A') ?></strong><br>
                            <small><?= htmlspecialchars($row['project_name'] ?? 'N/A') ?></small>
                        </td>
                        <td>
                            <?php $pclass = $row['priority'] == 'High' ? 'danger' : ($row['priority'] == 'Medium' ? 'warning' : 'info'); ?>
                            <span class="label label-<?= $pclass ?>"><?= $row['priority'] ?></span>
                        </td>
                        <td>
                            <?php $sclass = $row['task_status'] == 'Completed' ? 'success' : ($row['task_status'] == 'In Progress' ? 'primary' : 'default'); ?>
                            <span class="label label-<?= $sclass ?>"><?= $row['task_status'] ?></span>
                        </td>
                        <td>
                            <?php if ($row['due_date']): ?>
                                <?php
                                $overdue = strtotime($row['due_date']) < time() && $row['task_status'] != 'Completed';
                                ?>
                                <span class="<?= $overdue ? 'text-red' : '' ?>">
                                    <?= date('d M Y', strtotime($row['due_date'])) ?>
                                    <?= $overdue ? ' <i class="fa fa-exclamation-triangle"></i>' : '' ?>
                                </span>
                            <?php else: ?>
                                <em>No due date</em>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= $row['assigned_employees'] ? htmlspecialchars($row['assigned_employees']) : '<em class="text-muted">Not Assigned</em>' ?>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-xs btn-primary edit_record" value="<?= $row['task_id'] ?>">
                                <i class="fa fa-edit"></i>
                            </button>
                            <?php if ($this->session->userdata(SESS_HD . 'level') == 'Admin'): ?>
                            <button class="btn btn-xs btn-danger del_record" value="<?= $row['task_id'] ?>">
                                <i class="fa fa-trash"></i>
                            </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="box-footer clearfix">
            <div class="pull-left"><strong>Total Tasks: <?= $total_records ?></strong></div>
            <div class="pull-right"><?= $pagination ?></div>
        </div>
    </div>
</section>

<!-- Task Modal -->
<div class="modal fade" id="task_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" id="task_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="modal_title">Create New Task</h4>
                    <input type="hidden" name="mode" id="form_mode" value="Add">
                    <input type="hidden" name="task_id" id="task_id">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Client <span class="text-danger">*</span></label>
                            <?= form_dropdown('client_id', $client_opt, '', 'class="form-control" id="client_id" required') ?>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Project <span class="text-danger">*</span></label>
                            <?= form_dropdown('project_id', $project_opt, '', 'class="form-control" id="project_id" required') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Task Title <span class="text-danger">*</span></label>
                        <input type="text" name="task_title" id="task_title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="task_description" id="task_description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Priority</label>
                            <select name="priority" id="priority" class="form-control">
                                <option value="Low">Low</option>
                                <option value="Medium" selected>Medium</option>
                                <option value="High">High</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Status</label>
                            <select name="task_status" id="task_status" class="form-control">
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Due Date</label>
                            <input type="date" name="due_date" id="due_date" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Assign To Employees <small>(Hold Ctrl/Cmd to select multiple)</small></label>
                        <select name="assigned_to[]" id="assigned_to" multiple class="form-control" style="height:150px;">
                            <?php foreach ($employees as $emp): ?>
                                <option value="<?= $emp['employee_id'] ?>"><?= htmlspecialchars($emp['employee_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submit_btn">Save Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once(VIEWPATH . 'inc/footer.php'); ?>

