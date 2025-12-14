<?php include_once(VIEWPATH . '/inc/header.php'); ?>
<section class="content-header">
    <h1>Client List</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cubes"></i> Master</a></li>
        <li class="active">Client List</li>
    </ol>
</section>

<section class="content">
    <div class="box box-info">
        <div class="box-header with-border">
            <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#add_modal">
                <span class="fa fa-plus-circle"></span> Add New Client
            </button>
        </div>

        <div class="box-body table-responsive">
            <table class="table table-hover table-bordered table-striped" id="client_list">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Client Name</th>
                        <th>Contact Person</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th colspan="2" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sno = $sno + 1;
                    foreach ($record_list as $j => $ls) { ?>
                        <tr>
                            <td class="text-center"><?php echo $sno + $j; ?></td>
                            <td><?php echo htmlspecialchars($ls['client_name']); ?></td>
                            <td><?php echo htmlspecialchars($ls['contact_person']); ?></td>
                            <td>
                                <a href="tel:<?php echo $ls['mobile']; ?>" rel="noopener noreferrer">
                                    <?php echo htmlspecialchars($ls['mobile']); ?>
                                </a>
                            </td>
                            <td>
                                <a href="mailto:<?php echo $ls['email']; ?>">
                                    <?php echo htmlspecialchars($ls['email']); ?>
                                </a>
                            </td>
                            <td><?php echo nl2br(htmlspecialchars($ls['address'])); ?></td>
                            <td><?php echo $ls['status']; ?></td>
                            <td>
                                <button data-toggle="modal" data-target="#edit_modal"
                                    value="<?php echo $ls['client_id']; ?>" class="edit_record btn btn-primary btn-xs"
                                    title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                            <td>
                                <?php if ($this->session->userdata(SESS_HD . 'level') == 'Admin') { ?>
                                    <button value="<?php echo $ls['client_id']; ?>" class="del_record btn btn-danger btn-xs"
                                        title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- ADD MODAL -->
            <div class="modal fade" id="add_modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="post" action="" id="frmadd">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title">Add New Client</h3>
                                <input type="hidden" name="mode" value="Add" />
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Client Name <span class="text-danger">*</span></label>
                                        <input type="text" name="client_name" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Contact Person</label>
                                        <input type="text" name="contact_person" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Mobile</label>
                                        <input type="text" name="mobile" class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Status</label><br>
                                        <label><input type="radio" name="status" value="Active" checked> Active</label>
                                        <label class="ml-3"><input type="radio" name="status" value="InActive">
                                            InActive</label>
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

            <!-- EDIT MODAL -->
            <div class="modal fade" id="edit_modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="post" action="" id="frmedit">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title">Edit Client</h3>
                                <input type="hidden" name="mode" value="Edit" />
                                <input type="hidden" name="client_id" id="edit_client_id" />
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Client Name <span class="text-danger">*</span></label>
                                        <input type="text" name="client_name" id="edit_client_name" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Contact Person</label>
                                        <input type="text" name="contact_person" id="edit_contact_person"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Mobile</label>
                                        <input type="text" name="mobile" id="edit_mobile" class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" id="edit_email" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>Address</label>
                                        <textarea name="address" id="edit_address" class="form-control"
                                            rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Status</label><br>
                                        <label><input type="radio" name="status" value="Active"> Active</label>
                                        <label class="ml-3"><input type="radio" name="status" value="InActive">
                                            InActive</label>
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
            <div class="col-sm-6">
                <label>Total Records: <?php echo $total_records; ?></label>
            </div>
            <div class="col-sm-6 text-right">
                <?php echo $pagination; ?>
            </div>
        </div>
    </div>
</section>

<?php include_once(VIEWPATH . 'inc/footer.php'); ?>