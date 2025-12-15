<script>
jQuery(function ($) {
    // Edit - Fetch data
    $(document).on("click", ".edit_record", function () {
        let id = $(this).val();

        $.ajax({
            url: "<?= site_url('get-data') ?>",
            type: "POST",
            data: { tbl: "tsk_project_info", id: id },
            dataType: "json",
            success: function (d) {
                $("#project_id").val(d.project_id);
                $("#client_id_edit").val(d.client_id);
                $("#project_code").val(d.project_code);
                $("#project_name").val(d.project_name);
                $("#project_description").val(d.project_description);
                $("#start_date").val(d.start_date);
                $("#end_date").val(d.end_date);
                $("#project_status_edit").val(d.project_status);
                $("input[name='status'][value='" + d.status + "']").prop('checked', true);

                // Existing documents
                if (d.document_path && d.document_path.trim() !== '') {
                    let docs = d.document_path.split(',');
                    let html = '';
                    docs.forEach(function(path) {
                        let filename = path.split('/').pop();
                        html += '<a href="<?= base_url() ?>' + path + '" target="_blank" class="btn btn-success btn-xs mb-1">' +
                                '<i class="fa fa-file"></i> ' + filename + '</a><br>';
                    });
                    $('#existing_doc_list').html(html);
                    $('#existing_docs').show();
                } else {
                    $('#existing_docs').hide();
                }

                $("#edit_modal").modal("show");
            }
        });
    });

    // Delete
    $(document).on("click", ".del_record", function () {
        let id = $(this).val();
        if (confirm("Are you sure you want to delete this project?")) {
            $.ajax({
                url: "<?= site_url('delete-record') ?>",
                type: "POST",
                data: { tbl: "tsk_project_info", id: id },
                success: function (msg) {
                    alert(msg);
                    location.reload();
                }
            });
        }
    });
});
</script>