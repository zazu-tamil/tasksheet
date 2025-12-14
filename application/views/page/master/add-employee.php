<?php include_once(VIEWPATH . '/inc/header.php'); ?>
<section class="content-header">
  <h1><?php echo $title; ?></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cubes"></i> Master</a></li> 
    <li class="active"><?php echo $title; ?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content"> 
  <form method="post" action="" id="frm_add_emp" enctype="multipart/form-data" class="was-validated">
    <input type="hidden" name="mode" value="Add" />
    <div class="box box-success">
      <div class="box-header with-border">
        <a href="<?php echo site_url('employee-list') ?>" class="btn btn-warning pull-right">Back to Employee List</a>
      </div>
      <div class="box-body table-responsive">  
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs" id="emp-tab">
            <li class="active"><a href="#tab1" data-toggle="tab">Basic Details</a></li>
            <li><a href="#tab2" data-toggle="tab">Contact Details</a></li>
            <li><a href="#tab3" data-toggle="tab">Family Details</a></li>
            <li><a href="#tab4" data-toggle="tab">Social Identity</a></li>
            <li><a href="#tab5" data-toggle="tab">Qualification</a></li>
            <li><a href="#tab8" data-toggle="tab">Bank [ Personal ]</a></li>
            <li><a href="#tab12" data-toggle="tab">Bank [ Salary ]</a></li>
            <li><a href="#tab7" data-toggle="tab">Medical Issue</a></li>
            <?php if($this->session->userdata(SESS_HD . 'user_type') == 'Admin') { ?>  
              <li><a href="#tab9" data-toggle="tab">Leave Policy</a></li> 
              <li><a href="#tab10" data-toggle="tab">Salary Data</a></li> 
              <li><a href="#tab6" data-toggle="tab">Roles & Responsibility</a></li> 
            <?php } ?>  
          </ul>

          <div class="tab-content">
            <!-- Tab 1: Basic Details -->
            <div class="tab-pane active" id="tab1"> 
              <div class="box box-solid box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Employee Basic Information</h3>
                </div> 
                <div class="box-body"> 
                  <div class="row"> 
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Employee Name <span class="text-red">*</span></label>
                        <input class="form-control" type="text" name="employee_name" id="employee_name" value="" required>
                      </div> 
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Gender</label>
                        <div class="radio">
                          <label><input type="radio" name="gender" value="Male" checked> Male </label> 
                          &nbsp;&nbsp;&nbsp;&nbsp;
                          <label><input type="radio" name="gender" value="Female"> Female</label>
                        </div> 
                      </div> 
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Date Of Birth <span class="text-red">*</span></label>
                        <input class="form-control" type="date" name="dob" id="dob" value="" required>
                      </div> 
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Emp Category</label>
                        <?php echo form_dropdown('employee_category', array('' => 'Select') + $emp_category_opt, set_value('employee_category'), 'id="employee_category" class="form-control"');?>
                      </div> 
                    </div>
                    <!-- <div class="col-md-4">
                      <div class="form-group">
                        <label>Department</label>
                        <?php echo form_dropdown('department_id', array('' => 'Select') + $department_opt, set_value('department_id'), 'id="department_id" class="form-control" required');?>
                      </div> 
                    </div> -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Designation <span class="text-red">*</span></label>
                        <?php echo form_dropdown('designation_id', array('' => 'Select'), set_value('designation_id'), 'id="designation_id" class="form-control" required');?>
                      </div> 
                    </div>

                    <div class="col-md-3 text-center">
                      <div class="form-group"> 
                        <label for="department_head">Head of Department</label><br>
                        <input type="checkbox" name="department_head" id="department_head" value="1">
                      </div>
                    </div>
                    <div class="col-md-3 text-center">
                      <div class="form-group"> 
                        <label for="emp_category_head">Head of Emp Category</label><br>
                        <input type="checkbox" name="emp_category_head" id="emp_category_head" value="1">
                      </div>
                    </div>
                    <div class="col-md-3 text-center">
                      <div class="form-group"> 
                        <label for="mgt_head">Top Management Head</label><br>
                        <input type="checkbox" name="mgt_head" id="mgt_head" value="1">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Date Of Joining <span class="text-red">*</span></label>
                        <input class="form-control" type="date" name="hire_date" id="hire_date" value="" required>
                      </div> 
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Photo</label>
                        <input class="form-control" type="file" name="photo_img" id="photo_img">
                      </div> 
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Marital Status <span class="text-red">*</span></label>
                        <?php echo form_dropdown('marital_status', array('' => 'Select') + $marital_status_opt, set_value('marital_status'), 'id="marital_status" class="form-control" required');?>
                      </div> 
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Blood Group</label>
                        <?php echo form_dropdown('blood_group', array('' => 'Select') + $blood_group_opt, set_value('blood_group'), 'id="blood_group" class="form-control"');?>
                      </div> 
                    </div>
                  </div> 
                </div>      
              </div>      
            </div>

            <!-- Tab 2: Contact Details -->
            <div class="tab-pane" id="tab2">
              <div class="box box-solid box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Employee Contact Information</h3>
                </div> 
                <div class="box-body">
                  <div class="row"> 
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Permanent Address</label>
                        <?php echo form_textarea('permanent_address', '', 'id="permanent_address" class="form-control"');?>
                      </div> 
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Temporary Address</label>
                        <?php echo form_textarea('temporary_address', '', 'id="temporary_address" class="form-control"');?>
                      </div> 
                    </div> 
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Mobile <span class="text-red">*</span></label>
                        <input class="form-control" type="text" name="mobile" id="mobile" value="" required>
                      </div> 
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Alternate Mobile</label>
                        <input class="form-control" type="text" name="alt_mobile" id="alt_mobile" value="">
                      </div> 
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" id="email" value="">
                      </div> 
                    </div>
                  </div> 
                </div>      
              </div>     
            </div>

            <!-- Dynamic Tabs (Family, Social, Qualification, Medical, Bank Personal/Salary) -->
            <?php 
            $dynamic_categories = [
              'tab3' => 'Family Details',
              'tab4' => 'Social Identity', 
              'tab5' => 'Education Details',
              'tab7' => 'Medical Issue Details',
              'tab8' => 'Bank - Personal',
              'tab12' => 'Bank - Salary'
            ];

            foreach ($dynamic_categories as $tab_id => $category): ?>
              <div class="tab-pane" id="<?php echo $tab_id; ?>">
                <div class="box box-solid box-info">
                  <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $category; ?></h3>
                  </div> 
                  <div class="box-body">
                    <div class="row">
                      <?php if (isset($dyn_fld_opt[$category])): ?>
                        <?php foreach ($dyn_fld_opt[$category] as $info): ?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php if (in_array($info['dyn_fld_opt_type'], ['text', 'date'])): ?>
                                <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                <input type="hidden" name="dyn_fld_opt_id[]" value="<?php echo $info['dyn_fld_opt_id']; ?>">
                                <input type="<?php echo $info['dyn_fld_opt_type']; ?>" name="dyn_fld_opt_val_id[<?php echo $info['dyn_fld_opt_id']; ?>]" class="form-control">
                              <?php endif; ?>

                              <?php if ($info['dyn_fld_opt_type'] == 'checkbox' && isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']])): ?>
                                <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                <input type="hidden" name="dyn_fld_opt_id[]" value="<?php echo $info['dyn_fld_opt_id']; ?>">
                                <?php foreach ($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value): ?>
                                  <div class="checkbox">
                                    <label>
                                      <?php echo form_checkbox("dyn_fld_opt_val_id[{$info['dyn_fld_opt_id']}][{$key}]", $key, FALSE); ?>
                                      <?php echo $value; ?>
                                    </label>
                                  </div>
                                <?php endforeach; ?>
                              <?php endif; ?>

                              <?php if ($info['dyn_fld_opt_type'] == 'radio' && isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']])): ?>
                                <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                <input type="hidden" name="dyn_fld_opt_id[]" value="<?php echo $info['dyn_fld_opt_id']; ?>">
                                <?php foreach ($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value): ?>
                                  <div class="radio">
                                    <label>
                                      <?php echo form_radio("dyn_fld_opt_val_id[{$info['dyn_fld_opt_id']}]", $key, FALSE); ?>
                                      <?php echo $value; ?>
                                    </label>
                                  </div>
                                <?php endforeach; ?>
                              <?php endif; ?>

                              <?php if ($info['dyn_fld_opt_type'] == 'textarea'): ?>
                                <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                <input type="hidden" name="dyn_fld_opt_id[]" value="<?php echo $info['dyn_fld_opt_id']; ?>">
                                <?php echo form_textarea("dyn_fld_opt_val_id[{$info['dyn_fld_opt_id']}]", '', 'class="form-control"'); ?>
                              <?php endif; ?>

                              <?php if ($info['dyn_fld_opt_type'] == 'Dropdown' && isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']])): ?>
                                <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                <input type="hidden" name="dyn_fld_opt_id[]" value="<?php echo $info['dyn_fld_opt_id']; ?>">
                                <?php echo form_dropdown("dyn_fld_opt_val_id[{$info['dyn_fld_opt_id']}]", array('' => 'Select') + $dyn_fld_val_opt[$info['dyn_fld_opt_id']], '', 'class="form-control"'); ?>
                              <?php endif; ?>
                            </div>
                          </div>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>

            <!-- Admin Only Tabs -->
            <?php if($this->session->userdata(SESS_HD . 'user_type') == 'Admin'): ?>
              <!-- Roles & Responsibility -->
              <div class="tab-pane" id="tab6">
                <div class="box box-solid box-info">
                  <div class="box-header with-border">
                    <h3 class="box-title">Roles & Responsibility</h3>
                  </div> 
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Roles</label>
                          <?php echo form_textarea('roles', '', 'id="roles" class="form-control"');?>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Responsibility</label>
                          <?php echo form_textarea('responsibility', '', 'id="responsibility" class="form-control"');?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Leave Policy -->
              <div class="tab-pane" id="tab9">
                <div class="box box-solid box-default">
                  <div class="box-header with-border">
                    <h3 class="box-title">Leave Policy Information</h3>
                  </div>
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-2"><div class="form-group"><label>Casual Leave</label><input class="form-control" type="number" step="any" name="casual_leave" value="0"></div></div>
                      <div class="col-md-2"><div class="form-group"><label>Sick Leave</label><input class="form-control" type="number" step="any" name="medical_leave" value="0"></div></div>
                      <div class="col-md-4"><div class="form-group"><label>Entry Date</label><input class="form-control" type="date" name="ason_date_leave_entry"></div></div>
                      <div class="col-md-2"><div class="form-group"><label>In-Time</label><input class="form-control" type="time" name="in_time"></div></div>
                      <div class="col-md-2"><div class="form-group"><label>Out-Time</label><input class="form-control" type="time" name="out_time"></div></div>
                      <div class="col-md-2"><div class="form-group"><label>Permission [Hour]</label><input class="form-control" type="number" step="any" name="permission" value="0"></div></div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Salary Data -->
              <div class="tab-pane" id="tab10">
                <div class="box box-solid box-default">
                  <div class="box-header with-border">
                    <h3 class="box-title">Salary Information</h3>
                  </div>
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-3"><div class="form-group"><label>Fixed Salary</label><input class="form-control" type="number" step="any" name="fixed_salary" value="0"></div></div>
                      <div class="col-md-3 text-center"><div class="form-group"><label for="is_esi_pf_req">ESI & PF Required</label><br><input type="checkbox" name="is_esi_pf_req" value="1"></div></div>
                      <div class="col-md-3"><div class="form-group"><label>ESI No</label><input class="form-control" type="text" name="esi_no"></div></div>
                      <div class="col-md-3"><div class="form-group"><label>UAN No [ PF ]</label><input class="form-control" type="text" name="uan_no"></div></div>
                    </div>
                    <div class="row">
                      <div class="col-md-3"><div class="form-group"><label>Salary Default A/c <span class="text-red">*</span></label><?php echo form_dropdown('emp_bank_def_ac', array('' => 'Select Bank A/c') + $emp_bank_def_ac_opt, '', 'id="emp_bank_def_ac" class="form-control" required');?></div></div>
                      <div class="col-md-3 text-center"><div class="form-group"><label for="enable_loan">Enable Loan Request</label><br><input type="checkbox" name="enable_loan" value="1"></div></div>
                      <div class="col-md-3 text-center"><div class="form-group"><label for="enable_advance">Enable Salary Advance</label><br><input type="checkbox" name="enable_advance" value="1"></div></div>
                      <div class="col-md-3 text-center"><div class="form-group"><label for="att_mandatory">Attendance Mandatory</label><br><input type="checkbox" name="att_mandatory" value="1" checked></div></div>
                    </div>
                    <div class="row">
                      <div class="col-md-3"><div class="form-group"><label>Employee Type</label><?php echo form_dropdown('emp_type', array('' => 'Select') + $emp_type_opt, '', 'id="emp_type" class="form-control"');?></div></div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>

          </div> <!-- /.tab-content -->
        </div> <!-- /.nav-tabs-custom -->

        <span class="text-red">* Required Field</span>
      </div> 

      <div class="box-footer text-right">
        <div class="pull-left">
          <a href="<?php echo site_url('employee-list') ?>" class="btn btn-warning">Back to Employee List</a>
        </div>
        <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
      </div> 
    </div> 
  </form>  
</section>

<?php include_once(VIEWPATH . 'inc/footer.php'); ?>

