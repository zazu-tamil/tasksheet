<script>
  jQuery(function ($) {
    // Edit Record - Fetch Data
    $(document).on("click", ".edit_record", function () {
      let id = $(this).val();

      $.ajax({
        url: "<?= site_url('get-data') ?>",
        type: "POST",
        data: { tbl: "tsk_project_info", id: id },
        dataType: "json",
        success: function (d) {
          $("#edit_modal #project_id").val(d.project_id);
          $("#edit_modal #client_id_edit").val(d.client_id);
          $("#edit_modal #project_code").val(d.project_code);
          $("#edit_modal #project_name").val(d.project_name);
          $("#edit_modal #project_description").val(d.project_description);
          $("#edit_modal #start_date").val(d.start_date);
          $("#edit_modal #end_date").val(d.end_date);
          $("#edit_modal #project_status_edit").val(d.project_status);
          $("#edit_modal input:radio[value='" + d.status + "']").prop(
            "checked",
            true
          );

          $("#edit_modal").modal("show");
        },
      });
    });

    // Delete Record
    $(document).on("click", ".del_record", function () {
      let id = $(this).val();
      //alert(id);
      if (confirm("Are you sure you want to delete this project?")) {
        $.ajax({
          url: "<?= site_url('delete-record') ?>",
          type: "POST",
          data: { tbl: "tsk_project_info", id: id },
          success: function (msg) {
            alert(msg);
            location.reload();
          },
        });
      }
    });
  });
</script>
