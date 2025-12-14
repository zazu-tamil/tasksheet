<script>
jQuery(function($) {
    // Edit Record - Load data via AJAX
    $(document).on("click", ".edit_record", function() {
        let id = $(this).val();

        $.ajax({
            url: "<?php echo site_url('get-data'); ?>",
            type: "POST",
            data: { tbl: "tsk_clients_info", id: id },
            dataType: "json",
            success: function(d) {
                $("#edit_client_id").val(d.client_id);
                $("#edit_client_name").val(d.client_name);
                $("#edit_contact_person").val(d.contact_person);
                $("#edit_mobile").val(d.mobile);
                $("#edit_email").val(d.email);
                $("#edit_address").val(d.address);
                $(`#edit_modal input[name="status"][value="${d.status}"]`).prop("checked", true);
                $("#edit_modal").modal("show");
            },
            error: function() {
                alert("Error loading data");
            }
        });
    });

    // Delete Record
    $(document).on("click", ".del_record", function() {
        let id = $(this).val();
        if (confirm("Are you sure you want to delete this client?")) {
            $.ajax({
                url: "<?php echo site_url('delete-record'); ?>",
                type: "POST",
                data: { tbl: "tsk_clients_info", id: id },
                success: function(resp) {
                    alert(resp);
                    location.reload();
                }
            });
        }
    });
});
</script>