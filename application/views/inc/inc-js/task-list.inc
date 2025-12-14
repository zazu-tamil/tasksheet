<script>
jQuery(function($) {
 

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

            $.post('<?= site_url("get-task-assignments") ?>', { task_id: task_id }, function(emps) {
                var selected = emps.map(function(e) { return e.assigned_to; });
                $('#assigned_to').val(selected);
            }, 'json');

            $('#modal_title').text('Edit Task');
            $('#form_mode').val('Edit');
            $('#submit_btn').text('Update Task');
            $('#task_modal').modal('show');
        }, 'json');
    });

    // Delete
    $(document).on('click', '.del_record', function() {
        if (confirm('Are you sure you want to delete this task?')) {
            $.post('<?= site_url("delete-record") ?>', { tbl: 'tsk_task_info', id: $(this).val() }, function(msg) {
                alert(msg);
                location.reload();
            });
        }
    });
});
</script>