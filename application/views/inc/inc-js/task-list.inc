<!-- Modern Select2 from CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
/* Your requested blue tags with black border for multiple select */
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #0080FF !important;
    border: 1px solid #000 !important;
    border-radius: 4px !important;
    color: #fff !important;
    padding: 2px 8px !important;
    margin: 4px 4px 4px 0 !important;
    font-size: 13px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #000 !important;
    font-weight: bold !important;
    margin-right: 6px !important;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
    color: #fff !important;
}

/* Avatar initials inside tags */
.avatar-initials {
    display: inline-block;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background-color: #0066cc;
    color: white;
    text-align: center;
    line-height: 26px;
    font-size: 12px;
    font-weight: bold;
    margin-right: 8px;
    flex-shrink: 0;
}
</style>

<script>
jQuery(function($) {
    // Format with avatar initials
    function formatEmployee(state) {
        if (!state.element) return state.text;
        var initials = $(state.element).data('initials') || '?';
        return $('<span><span class="avatar-initials">' + initials + '</span>' + state.text + '</span>');
    }

    // Initialize regular Select2 for single selects
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%',
        placeholder: 'Select an option',
        allowClear: true
    });

    // Special initialization for assigned_to (multiple + custom tags + avatars)
    $('#assigned_to').select2({
        theme: 'bootstrap4',
        placeholder: 'Search and assign employees...',
        allowClear: true,
        width: '100%',
        templateResult: formatEmployee,
        templateSelection: formatEmployee,
        escapeMarkup: function(markup) { return markup; }
    });

    // Add New Task
    $('#add_new_task').on('click', function() {
        $('#task_form')[0].reset();
        $('.select2').val(null).trigger('change');
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
            $('#client_id').val(task.client_id).trigger('change');
            $('#project_id').val(task.project_id).trigger('change');
            $('#task_title').val(task.task_title);
            $('#task_description').val(task.task_description);
            $('#priority').val(task.priority).trigger('change');
            $('#task_status').val(task.task_status).trigger('change');
            $('#start_date').val(task.start_date);
            $('#due_date').val(task.due_date);

            // Load assigned employees
            $.post('<?= site_url("get-data") ?>', { tbl: 'tsk_assign_info', id: task_id }, function(assigned_ids) {
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