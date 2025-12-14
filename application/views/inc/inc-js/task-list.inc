<script>
  jQuery(function ($) {
    // Edit Task
    $(document).on("click", ".edit_record", function () {
      let id = $(this).val();

      $.ajax({
        url: "<?= site_url('get-data') ?>", // You need a generic get-data method or create one
        type: "POST",
        data: { tbl: "tsk_task_info", id: id },
        dataType: "json",
        success: function (d) {
          $("#edit_modal #task_id").val(d.task_id);
          $("#edit_modal #client_id").val(d.client_id);
          $("#edit_modal #project_id").val(d.project_id);
          $("#edit_modal #task_title").val(d.task_title);
          $("#edit_modal #task_description").val(d.task_description);
          $("#edit_modal #priority").val(d.priority);
          $("#edit_modal #task_status").val(d.task_status);
          $("#edit_modal #start_date").val(d.start_date);
          $("#edit_modal #due_date").val(d.due_date);

          $("#edit_modal").modal("show");
        },
      });
    });

    // Delete Task
    $(document).on("click", ".del_record", function () {
      let id = $(this).val();
      if (confirm("Are you sure you want to delete this task?")) {
        $.ajax({
          url: "<?= site_url('delete-record') ?>",
          type: "POST",
          data: { tbl: "tsk_task_info", id: id },
          success: function (msg) {
            alert(msg);
            location.reload();
          },
        });
      }
    });
  });
</script>
