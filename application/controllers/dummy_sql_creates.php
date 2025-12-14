CREATE TABLE `user_login_info` (
  `user_id` int(11) NOT NULL,
  `staff_name` varchar(100) DEFAULT NULL,
  `user_name` varchar(50) NOT NULL DEFAULT '',
  `user_pwd` varchar(25) NOT NULL DEFAULT '',
  `level` varchar(50) DEFAULT NULL,
  `ref_id` int(11) DEFAULT 0,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_login_info`
--

INSERT INTO `user_login_info` (`user_id`, `staff_name`, `user_name`, `user_pwd`, `level`, `ref_id`, `status`) VALUES
(1, 'Tamil', 'admin', 'admin123', 'Admin', 2, 'Active'),
(2, 'admin', 'tamil', 'sts123', 'Admin', 2, 'Active'),
(3, 'Staff User', 'staff', 'staff123', 'Staff', 0, 'Active');


---------------client-table ---------------------
CREATE TABLE tsk_clients_info (
    client_id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(150) NOT NULL,
    contact_person VARCHAR(100),
    email VARCHAR(100),
    mobile VARCHAR(15),
    address TEXT,
    status VARCHAR(50) DEFAULT 'Active',
    created_by INT NOT NULL,
    created_date DATETIME NOT NULL,
    updated_by INT DEFAULT NULL,
    updated_date DATETIME DEFAULT NULL
);
 


CREATE TABLE tsk_project_info (
    project_id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    project_code VARCHAR(50),
    project_name VARCHAR(150) NOT NULL,
    project_description TEXT,
    start_date DATE,
    end_date DATE,
    project_status VARCHAR(50) DEFAULT 'Active',
    status VARCHAR(50) DEFAULT 'Active',
    created_by INT NOT NULL,
    created_date DATETIME NOT NULL,
    updated_by INT DEFAULT NULL,
    updated_date DATETIME DEFAULT NULL
);




CREATE TABLE tsk_task_info (
    task_id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    project_id INT NOT NULL,
    task_title VARCHAR(200) NOT NULL,
    task_description TEXT,
    priority VARCHAR(50) DEFAULT 'Medium',
    task_status VARCHAR(50) DEFAULT 'Pending',
    start_date DATE,
    due_date DATE,
    created_by INT NOT NULL,
    created_date DATETIME NOT NULL,
    updated_by INT DEFAULT NULL,
    updated_date DATETIME DEFAULT NULL
);

CREATE TABLE tsk_assign_info (
    assign_id INT AUTO_INCREMENT PRIMARY KEY,
    task_id INT NOT NULL,           -- Task reference
    assigning_id INT NOT NULL,      -- Who assigned the task
    assigned_to INT NOT NULL,       -- Employee assigned
    status VARCHAR(50) DEFAULT 'Active',   -- Assignment status
    assigned_date DATETIME NOT NULL
);



CREATE TABLE `tsk_employee_info` (
  `employee_id` INT(11) NOT NULL AUTO_INCREMENT,
  `employee_code` INT(3) UNSIGNED ZEROFILL DEFAULT NULL,
  `ref_code` INT(3) UNSIGNED ZEROFILL DEFAULT NULL,
  `prefix_code` VARCHAR(50) DEFAULT NULL,
  `emp_code` VARCHAR(50) DEFAULT NULL,
  `employee_name` VARCHAR(200) DEFAULT NULL,
  `dob` DATE DEFAULT NULL,
  `gender` VARCHAR(50) DEFAULT NULL,
  `employee_category` VARCHAR(100) DEFAULT NULL,
  `department_id` INT(11) DEFAULT NULL,
  `department_head` CHAR(1) DEFAULT '0',
  `emp_category_head` CHAR(1) DEFAULT '0',
  `mgt_head` CHAR(1) DEFAULT '0',
  `designation_id` INT(11) DEFAULT NULL,
  `hire_date` DATE DEFAULT NULL,
  `mobile` VARCHAR(50) DEFAULT NULL,
  `alt_mobile` VARCHAR(50) DEFAULT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `blood_group` VARCHAR(100) DEFAULT NULL,
  `marital_status` VARCHAR(100) DEFAULT NULL,
  `permanent_address` TEXT DEFAULT NULL,
  `temporary_address` TEXT DEFAULT NULL,
  `land_mark` VARCHAR(200) DEFAULT NULL,
  `roles` BLOB DEFAULT NULL,
  `responsibility` BLOB DEFAULT NULL,
  `casual_leave` VARCHAR(50) DEFAULT NULL,
  `medical_leave` VARCHAR(50) DEFAULT NULL,
  `ason_date_leave_entry` DATE DEFAULT NULL,
  `permission` VARCHAR(50) DEFAULT NULL,
  `in_time` TIME DEFAULT NULL,
  `out_time` TIME DEFAULT NULL,
  `fixed_salary` FLOAT(12,2) DEFAULT NULL,
  `is_esi_pf_req` CHAR(1) DEFAULT '0',
  `enable_loan` CHAR(1) DEFAULT '0',
  `enable_advance` CHAR(1) DEFAULT '0',
  `esi_no` VARCHAR(50) DEFAULT NULL,
  `pf_salary_max_limit` FLOAT(12,2) DEFAULT NULL,
  `uan_no` VARCHAR(50) DEFAULT NULL,
  `emp_bank_def_ac` VARCHAR(100) DEFAULT NULL,
  `emp_type` VARCHAR(100) DEFAULT NULL,
  `att_mandatory` CHAR(1) DEFAULT '1',
  `increment_amt` FLOAT(12,2) DEFAULT NULL,
  `basic_pay` FLOAT(12,2) DEFAULT NULL,
  `da` FLOAT(12,2) DEFAULT NULL,
  `hra` FLOAT(12,2) DEFAULT NULL,
  `ta` FLOAT(12,2) DEFAULT NULL,
  `esi` FLOAT(12,2) DEFAULT NULL,
  `tds_it` FLOAT(12,2) DEFAULT NULL,
  `photo_img` VARCHAR(100) DEFAULT NULL,
  `status` VARCHAR(50) DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  `created_date` DATETIME DEFAULT NULL,
  `updated_by` INT(11) DEFAULT NULL,
  `updated_date` DATETIME DEFAULT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




