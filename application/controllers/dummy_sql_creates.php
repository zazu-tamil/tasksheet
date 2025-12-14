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





