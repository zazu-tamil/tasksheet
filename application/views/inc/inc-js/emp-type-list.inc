<script>
jQuery(function ($) {
    // Edit record AJAX load
    $(document).on("click", ".edit_record", function () {
        let id = $(this).val();

        $.ajax({
            url: "<?php echo site_url('get-data'); ?>",
            type: "POST",
            data: { tbl: "tsk_emp_type_info", id: id },
            dataType: "json",
            success: function (d) {
                $("#emp_type_id").val(d.emp_type_id);
                $("#emp_type_name").val(d.emp_type_name);

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
        if (confirm("Are you sure you want to delete this employee type?")) {
            $.ajax({
                url: "<?php echo site_url('delete-record'); ?>",
                type: "POST",
                data: { tbl: "tsk_emp_type_info", id: id },
                success: function (response) {
                    alert(response);
                    location.reload();
                }
            });
        }
    });
});
</script>