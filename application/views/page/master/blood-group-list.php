<?php include_once(VIEWPATH . '/inc/header.php'); ?>
<section class="content-header">
    <h1>Blood Group List</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cubes"></i> Master</a></li>
        <li class="active">Blood Group List</li>
    </ol>
</section>

<section class="content">
    <div class="box box-info">
        <div class="box-header with-border">
            <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#add_modal">
                <span class="fa fa-plus-circle"></span> Add New Blood Group
            </button>
        </div>

        <div class="box-body table-responsive">
            <table class="table table-hover table-bordered table-striped" id="blood_group_list">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Blood Group</th>
                        <th>Status</th>
                        <th colspan="2" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($record_list as $j => $ls) { ?>
                        <tr>
                            <td class="text-center"><?php echo ($j + 1); ?></td>
                            <td><?php echo htmlspecialchars($ls['blood_group_name']); ?></td>
                            <td><?php echo $ls['status']; ?></td>
                            <td>
                                <button data-toggle="modal" data-target="#edit_modal"
                                    value="<?php echo $ls['blood_group_id']; ?>" class="edit_record btn btn-primary btn-xs"
                                    title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                            <td>
                                <?php if ($this->session->userdata(SESS_HD . 'level') == 'Admin') { ?>
                                    <button value="<?php echo $ls['blood_group_id']; ?>" class="del_record btn btn-danger btn-xs"
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
                                <h3 class="modal-title">Add Blood Group</h3>
                                <input type="hidden" name="mode" value="Add" />
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Blood Group Name</label>
                                        <input class="form-control" type="text" name="blood_group_name" placeholder="e.g. A+, O-, AB+" required>
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
                                <h3 class="modal-title">Edit Blood Group</h3>
                                <input type="hidden" name="mode" value="Edit" />
                                <input type="hidden" name="blood_group_id" id="blood_group_id" />
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Blood Group Name</label>
                                        <input class="form-control" type="text" name="blood_group_name" id="blood_group_name" required>
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

<script>
jQuery(function ($) {
    // Edit record AJAX load
    $(document).on("click", ".edit_record", function () {
        let id = $(this).val();

        $.ajax({
            url: "<?php echo site_url('get-data'); ?>",
            type: "POST",
            data: { tbl: "sas_blood_group_info", id: id },
            dataType: "json",
            success: function (d) {
                $("#blood_group_id").val(d.blood_group_id);
                $("#blood_group_name").val(d.blood_group_name);

                // Handle status radio
                $(`#edit_modal input[name="status"][value="${d.status}"]`).prop("checked", true);

                $("#edit_modal").modal("show");
            },
            error: function () {
                alert("Error fetching data");
            }
        });
    });

    // Delete record
    $(document).on("click", ".del_record", function () {
        let id = $(this).val();
        if (confirm("Are you sure you want to delete this blood group?")) {
            $.ajax({
                url: "<?php echo site_url('delete-record'); ?>",
                type: "POST",
                data: { tbl: "sas_blood_group_info", id: id },
                success: function (response) {
                    alert(response);
                    location.reload();
                }
            });
        }
    });
});
</script>