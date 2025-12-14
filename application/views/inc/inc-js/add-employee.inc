<script>
jQuery(function($) {  
     $('#employee_category').change(function() {  
        $("#designation_id > option").remove();      
          $.ajax({
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'get-designation', id: $(this).val() },
                success: function(d) {   
                    var opt1 = $('<option />'); 
                    opt1.val('');
                    opt1.text('Select');
                    $('#designation_id').append(opt1); 
                    
    				$.each(d,function(key,info) 
	                {
	                    var opt1 = $('<option />'); 
	                    opt1.val(info.designation_id);
	                    opt1.text(info.designation_name);
	                    $('#designation_id').append(opt1); 
	                });
                }
         });  
     });
     
     $('#designation_id').change(function() {       
          $.ajax({
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'designation_info', id: $(this).val() },
                success: function(d) {
                    $('#roles').val(d.roles);
                    $('#responsibility').val(d.responsibility);
                }
         });  
     });        
});
</script>