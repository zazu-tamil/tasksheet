<!-- Select2 CSS & JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<style>
.select2-container .select2-selection--multiple {
    min-height: 44px !important;
    border: 1px solid #d2d6de !important;
    border-radius: 4px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #3c8dbc !important;
    border: none !important;
    color: white !important;
    padding: 2px 10px;
    margin: 4px 4px 4px 0;
    border-radius: 20px;
    font-size: 13px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: white !important;
    margin-right: 8px;
    font-weight: bold;
}
.avatar-initials {
    display: inline-block;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #3c8dbc;
    color: white;
    text-align: center;
    line-height: 24px;
    font-size: 11px;
    font-weight: bold;
    margin-right: 8px;
    vertical-align: middle;
}
</style>

<script>
jQuery(function($) {
    // Initialize Select2 with custom avatar template
    $('#assigned_to').select2({
        theme: "bootstrap",
        placeholder: "Search and select employees to assign...",
        allowClear: true,
        width: '100%',
        templateResult: function(data) {
            if (!data.element) return data.text;
            var initials = $(data.element).data('initials') || '?';
            return $('<span><span class="avatar-initials">' + initials + '</span>' + data.text + '</span>');
        },
        templateSelection: function(data) {
            if (!data.element) return data.text;
            var initials = $(data.element).data('initials') || '?';
            return $('<span><span class="avatar-initials">' + initials + '</span>' + data.text + '</span>');
        },
        escapeMarkup: function(markup) { return markup; }
    });

    // Add New Task
    $('#add_new_task').on('click', function() {
        $('#task_form')[0].reset();
        $('#assigned_to').val(null).trigger('change');
        $('#modal_title').text('Create New Task');
        $('#form_mode').val('Add');
        $('#submit_btn').text('Save Task');
        $('#task_id').val('');
        $('#task_modal').modal('show');
    });

    // Edit Task
    $(document).on('click', '.edit_record', function() {
        var task_id = $(this).val();

        $.post('<?= site_url("get-data") ?>', { tbl: 'tsk_task_info', id: task_id }, function(task) {
            $('#task_id').val(task.task_id);
            $('#client_id').val(task.client_id);
            $('#project_id').val(task.project_id);
            $('#task_title').val(task.task_title);
            $('#task_description').val(task.task_description);
            $('#priority').val(task.priority);
            $('#task_status').val(task.task_status);
            $('#start_date').val(task.start_date);
            $('#due_date').val(task.due_date);

            // Load assigned employees
            $.post('<?= site_url("get-data") ?>', { tbl: 'tsk_assign_info', id: task_id }, function(assigned_ids) {
                // assigned_ids should be an array like [1, 5, 8]
                $('#assigned_to').val(assigned_ids).trigger('change');
            }, 'json').fail(function() {
                $('#assigned_to').val(null).trigger('change');
            });

            $('#modal_title').text('Edit Task');
            $('#form_mode').val('Edit');
            $('#submit_btn').text('Update Task');
            $('#task_modal').modal('show');
        }, 'json');
    });

    // Delete Task
    $(document).on('click', '.del_record', function() {
        if (confirm('Are you sure you want to delete this task? This action cannot be undone.')) {
            $.post('<?= site_url("delete-record") ?>', { tbl: 'tsk_task_info', id: $(this).val() }, function(msg) {
                alert(msg);
                location.reload();
            });
        }
    });
});
</script>