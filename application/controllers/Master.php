<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{


    public function index()
    {
        $this->load->view('page/dashboard');
    }
    public function user_list()
    {

        if (!$this->session->userdata(SESS_HD . 'logged_in'))
            redirect();

        if (
            $this->session->userdata(SESS_HD . 'level') != 'Admin'
            && $this->session->userdata(SESS_HD . 'level') != 'Staff'
        ) {
            echo "<h3 style='color:red;'>Permission Denied</h3>";
            exit;
        }


        $data['js'] = 'user-list.inc';


        if ($this->input->post('mode') == 'Add') {
            $ins = array(
                'staff_name' => $this->input->post('staff_name'),
                'user_name' => $this->input->post('user_name'),
                'user_pwd' => $this->input->post('user_pwd'),
                'level' => 'Admin',
                'ref_id' => '0',
                'status' => $this->input->post('status')
            );

            $this->db->insert('user_login_info', $ins);
            redirect('user-list/');
        }

        if ($this->input->post('mode') == 'Edit') {
            $upd = array(
                'staff_name' => $this->input->post('staff_name'),
                'user_name' => $this->input->post('user_name'),
                'user_pwd' => $this->input->post('user_pwd'),
                'level' => 'Admin',
                'ref_id' => '0',
                'status' => $this->input->post('status')
            );

            $this->db->where('user_id', $this->input->post('user_id'));
            $this->db->update('user_login_info', $upd);

            redirect('user-list/');
        }


        $this->load->library('pagination');

        $this->db->where('status !=', 'Delete');
        $this->db->where('user_id !=', '1');
        $this->db->from('user_login_info');
        $data['total_records'] = $cnt = $this->db->count_all_results();


        $data['sno'] = $this->uri->segment(2, 0);

        $config['base_url'] = trim(site_url('user-list') . '/' . $this->uri->segment(2, 0));
        $config['total_rows'] = $cnt;
        $config['per_page'] = 50;
        $config['uri_segment'] = 2;
        //$config['num_links'] = 2; 
        $config['attributes'] = array('class' => 'page-link');
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] = "Prev";
        $config['next_link'] = "Next";
        $this->pagination->initialize($config);

        $sql = "
            SELECT *
            FROM user_login_info
            WHERE status != 'Delete'
            and user_id != '1'
            order by user_id desc 
            limit " . $this->uri->segment(2, 0) . "," . $config['per_page'] . "                
        ";

        $data['record_list'] = array();

        $query = $this->db->query($sql);

        foreach ($query->result_array() as $row) {
            $data['record_list'][] = $row;
        }



        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('page/master/user-list', $data);
    }


    public function client_list()
    {
        if (!$this->session->userdata(SESS_HD . 'logged_in')) {
            redirect();
        }

        if (
            $this->session->userdata(SESS_HD . 'level') != 'Admin'
            && $this->session->userdata(SESS_HD . 'level') != 'Staff'
        ) {
            echo "<h3 style='color:red;'>Permission Denied</h3>";
            exit;
        }

        $data['js'] = 'client-list.inc';

        /* ===================== ADD ===================== */
        if ($this->input->post('mode') == 'Add') {
            $ins = array(
                'client_name' => $this->input->post('client_name'),
                'contact_person' => $this->input->post('contact_person'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'address' => $this->input->post('address'),
                'status' => $this->input->post('status'),
                'created_by' => $this->session->userdata(SESS_HD . 'user_id'),
                'created_date' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('tsk_clients_info', $ins);
            redirect('client-list');
        }

        /* ===================== EDIT ===================== */
        if ($this->input->post('mode') == 'Edit') {
            $upd = array(
                'client_name' => $this->input->post('client_name'),
                'contact_person' => $this->input->post('contact_person'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'address' => $this->input->post('address'),
                'status' => $this->input->post('status'),
                'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),
                'updated_date' => date('Y-m-d H:i:s'),
            );
            $this->db->where('client_id', $this->input->post('client_id'));
            $this->db->update('tsk_clients_info', $upd);
            redirect('client-list');
        }

        $this->load->library('pagination');

        $this->db->where('status !=', 'Delete');
        $this->db->from('tsk_clients_info');
        $data['total_records'] = $cnt = $this->db->count_all_results();

        $data['sno'] = $this->uri->segment(2, 0);

        $config['base_url'] = site_url('client-list');
        $config['total_rows'] = $cnt;
        $config['per_page'] = 20;
        $config['uri_segment'] = 2;
        $config['attributes'] = array('class' => 'page-link');
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = "Prev";
        $config['next_link'] = "Next";
        $this->pagination->initialize($config);

        $sql = "
        SELECT c.* 
        FROM tsk_clients_info c 
        WHERE c.status != 'Delete'
        ORDER BY c.status ASC, c.client_name ASC 
        LIMIT " . $this->uri->segment(2, 0) . ", " . $config['per_page'];

        $query = $this->db->query($sql);
        $data['record_list'] = $query->result_array();

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('page/master/client-list', $data);
    }
    public function project_list()
{
    if (!$this->session->userdata(SESS_HD . 'logged_in'))
        redirect();

    if (
        $this->session->userdata(SESS_HD . 'level') != 'Admin' &&
        $this->session->userdata(SESS_HD . 'level') != 'Staff'
    ) {
        echo "<h3 style='color:red;'>Permission Denied</h3>";
        exit;
    }

    $data['js'] = 'project-list.inc';

    // Upload path for project documents
    $upload_path = FCPATH . 'uploads/project_documents/';
    if (!is_dir($upload_path)) {
        mkdir($upload_path, 0755, true);
    }

    // === ADD NEW PROJECT ===
    if ($this->input->post('mode') == 'Add') {
        $document_paths = '';

        // Handle multiple file upload
        if (!empty($_FILES['document_upload']['name'][0])) {
            $files = $_FILES['document_upload'];
            $file_count = count($files['name']);
            $uploaded_paths = [];

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg|png|gif|txt|xls|xlsx';
            $config['max_size']      = 10240; // 10MB per file
            $this->load->library('upload');

            for ($i = 0; $i < $file_count; $i++) {
                if ($files['error'][$i] === UPLOAD_ERR_OK) {
                    $_FILES['single_file']['name']     = $files['name'][$i];
                    $_FILES['single_file']['type']     = $files['type'][$i];
                    $_FILES['single_file']['tmp_name'] = $files['tmp_name'][$i];
                    $_FILES['single_file']['error']    = $files['error'][$i];
                    $_FILES['single_file']['size']     = $files['size'][$i];

                    $config['file_name'] = time() . '_' . rand(1000,9999) . '_' . preg_replace("/\s+/", "_", $files['name'][$i]);

                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('single_file')) {
                        $upload_data = $this->upload->data();
                        $uploaded_paths[] = 'uploads/project_documents/' . $upload_data['file_name'];
                    } else {
                        $this->session->set_flashdata('alert_error', $this->upload->display_errors());
                        redirect('project-list');
                    }
                }
            }

            if (!empty($uploaded_paths)) {
                $document_paths = implode(',', $uploaded_paths);
            }
        }

        $ins = array(
            'client_id'            => $this->input->post('client_id'),
            'project_code'         => $this->input->post('project_code'),
            'project_name'         => $this->input->post('project_name'),
            'project_description'  => $this->input->post('project_description'),
            'start_date'           => $this->input->post('start_date'),
            'end_date'             => $this->input->post('end_date'),
            'project_status'       => $this->input->post('project_status'),
            'document_path'        => $document_paths,
            'status'               => $this->input->post('status'),
            'created_by'           => $this->session->userdata(SESS_HD . 'user_id'),
            'created_date'         => date('Y-m-d H:i:s')
        );

        $this->db->insert('tsk_project_info', $ins);
        $this->session->set_flashdata('alert_success', 'Project added successfully.');
        redirect('project-list');
    }

    // === EDIT PROJECT ===
    if ($this->input->post('mode') == 'Edit') {
        $project_id = $this->input->post('project_id');

        // Fetch current document paths
        $current = $this->db->select('document_path')
                            ->get_where('tsk_project_info', ['project_id' => $project_id])
                            ->row_array();
        $existing_paths = !empty($current['document_path']) ? explode(',', $current['document_path']) : [];
        $document_paths = $current['document_path'];

        // Handle new uploads
        if (!empty($_FILES['document_upload']['name'][0])) {
            $files = $_FILES['document_upload'];
            $file_count = count($files['name']);
            $new_paths = [];

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg|png|gif|txt|xls|xlsx';
            $config['max_size']      = 10240;
            $this->load->library('upload');

            for ($i = 0; $i < $file_count; $i++) {
                if ($files['error'][$i] === UPLOAD_ERR_OK) {
                    $_FILES['single_file']['name']     = $files['name'][$i];
                    $_FILES['single_file']['type']     = $files['type'][$i];
                    $_FILES['single_file']['tmp_name'] = $files['tmp_name'][$i];
                    $_FILES['single_file']['error']    = $files['error'][$i];
                    $_FILES['single_file']['size']     = $files['size'][$i];

                    $config['file_name'] = time() . '_' . rand(1000,9999) . '_' . preg_replace("/\s+/", "_", $files['name'][$i]);

                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('single_file')) {
                        $upload_data = $this->upload->data();
                        $new_paths[] = 'uploads/project_documents/' . $upload_data['file_name'];
                    } else {
                        $this->session->set_flashdata('alert_error', $this->upload->display_errors());
                        redirect('project-list');
                    }
                }
            }

            if (!empty($new_paths)) {
                $all_paths = array_merge($existing_paths, $new_paths);
                $document_paths = implode(',', $all_paths);
            }
        }

        $upd = array(
            'client_id'            => $this->input->post('client_id'),
            'project_code'         => $this->input->post('project_code'),
            'project_name'         => $this->input->post('project_name'),
            'project_description'  => $this->input->post('project_description'),
            'start_date'           => $this->input->post('start_date'),
            'end_date'             => $this->input->post('end_date'),
            'project_status'       => $this->input->post('project_status'),
            'document_path'        => $document_paths,
            'status'               => $this->input->post('status'),
            'updated_by'           => $this->session->userdata(SESS_HD . 'user_id'),
            'updated_date'         => date('Y-m-d H:i:s')
        );

        $this->db->where('project_id', $project_id);
        $this->db->update('tsk_project_info', $upd);
        $this->session->set_flashdata('alert_success', 'Project updated successfully.');
        redirect('project-list');
    }

    // === LISTING & PAGINATION ===
    $this->load->library('pagination');

    $this->db->where('status !=', 'Delete');
    $data['total_records'] = $this->db->count_all_results('tsk_project_info');

    $data['sno'] = $this->uri->segment(2, 0);

    $config['base_url']   = site_url('project-list');
    $config['total_rows'] = $data['total_records'];
    $config['per_page']   = 20;
    $config['uri_segment']= 2;
    $config['attributes'] = array('class' => 'page-link');
    $config['full_tag_open']  = '<ul class="pagination pagination-sm no-margin pull-right">';
    $config['full_tag_close'] = '</ul>';
    $config['num_tag_open']   = '<li class="page-item">';
    $config['num_tag_close']  = '</li>';
    $config['cur_tag_open']   = '<li class="page-item active"><a href="#" class="page-link">';
    $config['cur_tag_close']  = '</a></li>';
    $config['prev_tag_open']  = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';
    $config['next_tag_open']  = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
    $config['prev_link'] = 'Prev';
    $config['next_link'] = 'Next';

    $this->pagination->initialize($config);

    // Client dropdown options
    $data['client_opt'] = array('' => 'Select Client');
    $clients = $this->db->select('client_id, client_name')
                        ->where('status', 'Active')
                        ->order_by('client_name')
                        ->get('tsk_clients_info')
                        ->result_array();
    foreach ($clients as $c) {
        $data['client_opt'][$c['client_id']] = $c['client_name'];
    }

    $data['project_status_opt'] = array(
        '' => 'Select Project Status',
        'Pending'     => 'Pending',
        'In Progress' => 'In Progress',
        'Completed'   => 'Completed'
    );

    // Fetch records
    $sql = "
        SELECT a.*, b.client_name
        FROM tsk_project_info a
        LEFT JOIN tsk_clients_info b ON a.client_id = b.client_id
        WHERE a.status != 'Delete'
        ORDER BY a.status ASC, a.project_name ASC
        LIMIT ?, ?
    ";
    $query = $this->db->query($sql, array($data['sno'], $config['per_page']));
    $data['record_list'] = $query->result_array();

    $data['pagination'] = $this->pagination->create_links();

    $this->load->view('page/master/project-list', $data);
}

    public function emp_category_list()
    {
        if (!$this->session->userdata(SESS_HD . 'logged_in')) {
            redirect();
        }

        if (
            $this->session->userdata(SESS_HD . 'level') != 'Admin'
            && $this->session->userdata(SESS_HD . 'level') != 'Staff'
        ) {
            echo "<h3 style='color:red;'>Permission Denied</h3>";
            exit;
        }

        $data['js'] = 'emp-category-list.inc';

        /* ===================== ADD ===================== */
        if ($this->input->post('mode') == 'Add') {
            $ins = array(
                'emp_category_name' => $this->input->post('emp_category_name'),
                'emp_category_code' => strtoupper($this->input->post('emp_category_code')),
                'status' => $this->input->post('status'),
            );
            $this->db->insert('tsk_emp_category_info', $ins);
            redirect('emp-category-list/');
        }

        /* ===================== EDIT ===================== */
        if ($this->input->post('mode') == 'Edit') {
            $upd = array(
                'emp_category_name' => $this->input->post('emp_category_name'),
                'emp_category_code' => strtoupper($this->input->post('emp_category_code')),
                'status' => $this->input->post('status'),
            );
            $this->db->where('emp_category_id', $this->input->post('emp_category_id'));
            $this->db->update('tsk_emp_category_info', $upd);

            redirect('emp-category-list/');
        }

        $this->load->library('pagination');

        $this->db->where('status != ', 'Delete');
        $this->db->from('tsk_emp_category_info');
        $data['total_records'] = $cnt = $this->db->count_all_results();

        $data['sno'] = $this->uri->segment(2, 0);

        $config['base_url'] = site_url('emp-category-list');
        $config['total_rows'] = $cnt;
        $config['per_page'] = 20;
        $config['uri_segment'] = 2;
        $config['attributes'] = array('class' => 'page-link');
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = "Prev";
        $config['next_link'] = "Next";
        $this->pagination->initialize($config);

        $sql = "
        SELECT * 
        FROM tsk_emp_category_info 
        WHERE status != 'Delete'
        ORDER BY emp_category_name ASC 
        LIMIT " . $this->uri->segment(2, 0) . "," . $config['per_page'] . "
    ";

        $query = $this->db->query($sql);
        $data['record_list'] = $query->result_array();

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('page/master/emp-category-list', $data);
    }

    public function emp_type_list()
    {
        if (!$this->session->userdata(SESS_HD . 'logged_in')) {
            redirect();
        }

        if (
            $this->session->userdata(SESS_HD . 'level') != 'Admin'
            && $this->session->userdata(SESS_HD . 'level') != 'Staff'
        ) {
            echo "<h3 style='color:red;'>Permission Denied</h3>";
            exit;
        }

        $data['js'] = 'emp-type-list.inc';

        /* ===================== ADD ===================== */
        if ($this->input->post('mode') == 'Add') {
            $ins = array(
                'emp_type_name' => $this->input->post('emp_type_name'),
                'status' => $this->input->post('status'),
            );
            $this->db->insert('tsk_emp_type_info', $ins);
            redirect('emp-type-list/');
        }

        /* ===================== EDIT ===================== */
        if ($this->input->post('mode') == 'Edit') {
            $upd = array(
                'emp_type_name' => $this->input->post('emp_type_name'),
                'status' => $this->input->post('status'),
            );
            $this->db->where('emp_type_id', $this->input->post('emp_type_id'));
            $this->db->update('tsk_emp_type_info', $upd);

            redirect('emp-type-list/');
        }

        $this->load->library('pagination');

        $this->db->where('status != ', 'Delete');
        $this->db->from('tsk_emp_type_info');
        $data['total_records'] = $cnt = $this->db->count_all_results();

        $data['sno'] = $this->uri->segment(2, 0);

        $config['base_url'] = site_url('emp-type-list');
        $config['total_rows'] = $cnt;
        $config['per_page'] = 20;
        $config['uri_segment'] = 2;
        $config['attributes'] = array('class' => 'page-link');
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = "Prev";
        $config['next_link'] = "Next";
        $this->pagination->initialize($config);

        $sql = "
        SELECT * 
        FROM tsk_emp_type_info 
        WHERE status != 'Delete'
        ORDER BY emp_type_name ASC 
        LIMIT " . $this->uri->segment(2, 0) . "," . $config['per_page'] . "
    ";

        $query = $this->db->query($sql);
        $data['record_list'] = $query->result_array();

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('page/master/emp-type-list', $data);
    }


    public function blood_group_list()
    {
        if (!$this->session->userdata(SESS_HD . 'logged_in')) {
            redirect();
        }

        if (
            $this->session->userdata(SESS_HD . 'level') != 'Admin'
            && $this->session->userdata(SESS_HD . 'level') != 'Staff'
        ) {
            echo "<h3 style='color:red;'>Permission Denied</h3>";
            exit;
        }

        $data['js'] = 'blood-group-list.inc';

        /* ===================== ADD ===================== */
        if ($this->input->post('mode') == 'Add') {
            $ins = array(
                'blood_group_name' => $this->input->post('blood_group_name'),
                'status' => $this->input->post('status'),
            );
            $this->db->insert('sas_blood_group_info', $ins);
            redirect('blood-group-list/');
        }

        /* ===================== EDIT ===================== */
        if ($this->input->post('mode') == 'Edit') {
            $upd = array(
                'blood_group_name' => $this->input->post('blood_group_name'),
                'status' => $this->input->post('status'),
            );
            $this->db->where('blood_group_id', $this->input->post('blood_group_id'));
            $this->db->update('sas_blood_group_info', $upd);

            redirect('blood-group-list/');
        }

        $this->load->library('pagination');

        $this->db->where('status != ', 'Delete');
        $this->db->from('sas_blood_group_info');
        $data['total_records'] = $cnt = $this->db->count_all_results();

        $data['sno'] = $this->uri->segment(2, 0);

        $config['base_url'] = site_url('blood-group-list');
        $config['total_rows'] = $cnt;
        $config['per_page'] = 20;
        $config['uri_segment'] = 2;
        $config['attributes'] = array('class' => 'page-link');
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = "Prev";
        $config['next_link'] = "Next";
        $this->pagination->initialize($config);

        $sql = "
        SELECT * 
        FROM sas_blood_group_info 
        WHERE status != 'Delete'
        ORDER BY blood_group_name ASC 
        LIMIT " . $this->uri->segment(2, 0) . "," . $config['per_page'] . "
    ";

        $query = $this->db->query($sql);
        $data['record_list'] = $query->result_array();

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('page/master/blood-group-list', $data);
    }


    public function add_employee()
    {
        if (!$this->session->userdata(SESS_HD . 'logged_in'))
            redirect();

        if ($this->session->userdata(SESS_HD . 'level') != 'Admin' && $this->session->userdata(SESS_HD . 'level') != 'Staff') {
            echo "<h3 style='color:red;'>Permission Denied</h3>";
            exit;
        }

        $data['js'] = 'add-employee.inc';
        $data['s_url'] = 'add-employee';
        $data['title'] = 'Create New Employee Info';


        if ($this->input->post('mode') == 'Add') {
            $emp_code = $this->input->post('employee_code');
            $config['upload_path'] = 'emp_photo/';
            $config['file_name'] = $emp_code . "_emp_" . date('YmdHis');
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);


            if ($this->upload->do_upload('photo_img')) {
                $file_array = $this->upload->data();
                $photo_img = 'emp_photo/' . $file_array['file_name'];
            } else {
                $photo_img = '';
            }

            $ins = array(
                'employee_name' => $this->input->post('employee_name'),
                'dob' => $this->input->post('dob'),
                'gender' => $this->input->post('gender'),
                'employee_category' => $this->input->post('employee_category'),
                'department_id' => $this->input->post('department_id'),
                'department_head' => $this->input->post('department_head'),
                'emp_category_head' => $this->input->post('emp_category_head'),
                'mgt_head' => $this->input->post('mgt_head'),
                'designation_id' => $this->input->post('designation_id'),
                'hire_date' => $this->input->post('hire_date'),
                'mobile' => $this->input->post('mobile'),
                'alt_mobile' => $this->input->post('alt_mobile'),
                'email' => $this->input->post('email'),
                'marital_status' => $this->input->post('marital_status'),
                'blood_group' => $this->input->post('blood_group'),
                'permanent_address' => $this->input->post('permanent_address'),
                'temporary_address' => $this->input->post('temporary_address'),
                'roles' => $this->input->post('roles'),
                'responsibility' => $this->input->post('responsibility'),
                'casual_leave' => $this->input->post('casual_leave'),
                'medical_leave' => $this->input->post('medical_leave'),
                'ason_date_leave_entry' => $this->input->post('ason_date_leave_entry'),
                'permission' => $this->input->post('permission'),
                'in_time' => $this->input->post('in_time'),
                'out_time' => $this->input->post('out_time'),
                'fixed_salary' => $this->input->post('fixed_salary'),
                'is_esi_pf_req' => $this->input->post('is_esi_pf_req'),
                'esi_no' => $this->input->post('esi_no'),
                'pf_salary_max_limit' => $this->input->post('pf_salary_max_limit'),
                'uan_no' => $this->input->post('uan_no'),
                'emp_bank_def_ac' => $this->input->post('emp_bank_def_ac'),
                'enable_loan' => $this->input->post('enable_loan'),
                'enable_advance' => $this->input->post('enable_advance'),
                'emp_type' => $this->input->post('emp_type'),
                'att_mandatory' => $this->input->post('att_mandatory'),
                'photo_img' => $photo_img,
                'status' => 'Active',
                'created_by' => $this->session->userdata(SESS_HD . 'user_id'),
                'created_date' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),
                'updated_date' => date('Y-m-d H:i:s')

            );
            $this->db->insert('tsk_employee_info', $ins);

            $employee_id = $this->db->insert_id();

            $dyn_fld_opt_id = $this->input->post('dyn_fld_opt_id');
            $dyn_fld_opt_val_id = $this->input->post('dyn_fld_opt_val_id');
            foreach ($dyn_fld_opt_id as $key => $opt_id) {
                if (is_array($dyn_fld_opt_val_id[$opt_id])) {
                    $fld_opt_val_id = implode(',', $dyn_fld_opt_val_id[$opt_id]);
                } else {
                    $fld_opt_val_id = $dyn_fld_opt_val_id[$opt_id];
                }

                if (!empty($fld_opt_val_id)) {
                    $ins = array(
                        'employee_id' => $employee_id,
                        'dyn_fld_opt_id' => $opt_id,
                        'dyn_fld_opt_values' => $fld_opt_val_id,
                        'status' => 'Active'
                    );

                    $this->db->insert('tsk_employee_fld_opt_info', $ins);
                }
            }

            $this->session->set_userdata('alert_success_msg', "Employee Information Successfully Added");

            redirect('employee-list');

        }


        $sql = "
            select 
            a.emp_category_name             
            from tsk_emp_category_info as a  
            where a.status = 'Active'  
            order by a.emp_category_name asc                 
    ";

        $query = $this->db->query($sql);

        $data['emp_category_opt'] = array();

        foreach ($query->result_array() as $row) {
            $data['emp_category_opt'][$row['emp_category_name']] = $row['emp_category_name'];
        }

        $sql = "
            select 
            a.emp_type_name             
            from tsk_emp_type_info as a  
            where a.status = 'Active'  
            order by a.emp_type_name asc                 
    ";

        $query = $this->db->query($sql);

        $data['emp_type_opt'] = array();

        foreach ($query->result_array() as $row) {
            $data['emp_type_opt'][$row['emp_type_name']] = $row['emp_type_name'];
        }

        $sql = "
            select 
            a.blood_group_name             
            from sas_blood_group_info as a  
            where a.status = 'Active'  
            order by a.blood_group_name asc                 
    ";

        $query = $this->db->query($sql);

        $data['blood_group_opt'] = array();

        foreach ($query->result_array() as $row) {
            $data['blood_group_opt'][$row['blood_group_name']] = $row['blood_group_name'];
        }



        // $sql = "
        //         select 
        //         a.department_id,             
        //         a.department_name             
        //         from tsk_department_info as a  
        //         where a.status = 'Active'  
        //         order by a.department_name asc                 
        // "; 

        // $query = $this->db->query($sql);

        // $data['department_opt'] = array();

        // foreach ($query->result_array() as $row)
        // {
        //     $data['department_opt'][$row['department_id']] = $row['department_name'];     
        // }  


        $data['marital_status_opt'] = array(
            'Married' => 'Married',
            'Single' => 'Single',
            'Widowed' => 'Widowed',
            'Separated' => 'Separated',
            'Divorced ' => 'Divorced',
        );

        $data['emp_bank_def_ac_opt'] = array(
            'Bank - Salary' => 'Bank - Salary',
            'Bank - Personal' => 'Bank - Personal'
        );


        // $sql = "
        //         select 
        //         a.* 
        //         from tsk_dyn_fld_opt_info as a   
        //         where a.status = 'Active' 
        //         order by a.dyn_fld_opt_category  , a.fld_s_order , a.dyn_fld_opt_name             
        //         "; 

        // $query = $this->db->query($sql);

        // $data['dyn_fld_opt'] = array();

        // foreach ($query->result_array() as $row)
        // {
        //     $data['dyn_fld_opt'][$row['dyn_fld_opt_category']][] = $row;     
        // }  

        // $sql = "
        //         select 
        //         a.* 
        //         from tsk_dyn_fld_opt_val_info as a   
        //         where a.status = 'Active' 
        //         order by a.dyn_fld_opt_id  , a.fld_val_s_order , a.dyn_fld_opt_val_name             
        //         "; 

        // $query = $this->db->query($sql);

        // $data['dyn_fld_val_opt'] = array();

        // foreach ($query->result_array() as $row)
        // {
        //     $data['dyn_fld_val_opt'][$row['dyn_fld_opt_id']][$row['dyn_fld_opt_val_id']] = $row['dyn_fld_opt_val_name'];     
        // } 




        $this->load->view('page/master/' . $data['s_url'], $data);
    }

  public function task_list($page = 0)
{
    if (!$this->session->userdata(SESS_HD . 'logged_in')) {
        redirect();
    }

    if ($this->session->userdata(SESS_HD . 'level') != 'Admin' && 
        $this->session->userdata(SESS_HD . 'level') != 'Staff') {
        echo "<h3 style='color:red;'>Permission Denied</h3>";
        exit;
    }

    $this->load->helper('text');
    $data['js'] = 'task-list.inc';

    /* ===================== ADD TASK ===================== */
    if ($this->input->post('mode') == 'Add') {
        $this->db->trans_start();

        $ins = array(
            'client_id'         => $this->input->post('client_id'),
            'project_id'        => $this->input->post('project_id'),
            'task_title'        => $this->input->post('task_title'),
            'task_description'  => $this->input->post('task_description'),
            'priority'          => $this->input->post('priority'),
            'task_status'       => $this->input->post('task_status'),
            'start_date'        => $this->input->post('start_date') ?: null,
            'due_date'          => $this->input->post('due_date') ?: null,
            'status'            => 'Active',
            'created_by'        => $this->session->userdata(SESS_HD . 'user_id'),
            'created_date'      => date('Y-m-d H:i:s'),
        );

        $this->db->insert('tsk_task_info', $ins);
        $task_id = $this->db->insert_id();

        $assigned_to = $this->input->post('assigned_to');
        if (is_array($assigned_to) && count($assigned_to) > 0) {
            foreach ($assigned_to as $employee_id) {
                $assign_ins = array(
                    'task_id'       => $task_id,
                    'assigning_id'  => $this->session->userdata(SESS_HD . 'user_id'),
                    'assigned_to'   => $employee_id,
                    'status'        => 'Active',
                    'created_by'    => $this->session->userdata(SESS_HD . 'user_id'),
                    'created_date'  => date('Y-m-d H:i:s'),
                );
                $this->db->insert('tsk_assign_info', $assign_ins);
            }
        }

        $this->db->trans_complete();
        redirect('task-list/');
    }

    /* ===================== EDIT TASK ===================== */
    if ($this->input->post('mode') == 'Edit') {
        $task_id = $this->input->post('task_id');

        $this->db->trans_start();

        $upd = array(
            'client_id'         => $this->input->post('client_id'),
            'project_id'        => $this->input->post('project_id'),
            'task_title'        => $this->input->post('task_title'),
            'task_description'  => $this->input->post('task_description'),
            'priority'          => $this->input->post('priority'),
            'task_status'       => $this->input->post('task_status'),
            'start_date'        => $this->input->post('start_date') ?: null,
            'due_date'          => $this->input->post('due_date') ?: null,
            'updated_by'        => $this->session->userdata(SESS_HD . 'user_id'),
            'updated_date'      => date('Y-m-d H:i:s'),
        );

        $this->db->where('task_id', $task_id);
        $this->db->update('tsk_task_info', $upd);

        // Remove old assignments
        $this->db->where('task_id', $task_id)->delete('tsk_assign_info');

        // Insert new assignments
        $assigned_to = $this->input->post('assigned_to');
        if (is_array($assigned_to) && count($assigned_to) > 0) {
            foreach ($assigned_to as $employee_id) {
                $assign_ins = array(
                    'task_id'       => $task_id,
                    'assigning_id'  => $this->session->userdata(SESS_HD . 'user_id'),
                    'assigned_to'   => $employee_id,
                    'status'        => 'Active',
                    'created_by'    => $this->session->userdata(SESS_HD . 'user_id'),
                    'created_date'  => date('Y-m-d H:i:s'),
                );
                $this->db->insert('tsk_assign_info', $assign_ins);
            }
        }

        $this->db->trans_complete();
        redirect('task-list/');
    }

    // Pagination
    $this->load->library('pagination');

    $this->db->where('t.status !=', 'Delete');
    $this->db->from('tsk_task_info t');
    $data['total_records'] = $cnt = $this->db->count_all_results();

    $config['base_url'] = site_url('task-list');
    $config['total_rows'] = $cnt;
    $config['per_page'] = 20;
    $config['uri_segment'] = 2;
    $config['attributes'] = array('class' => 'page-link');
    $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
    $config['full_tag_close'] = '</ul>';
    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
    $config['cur_tag_close'] = '</a></li>';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
    $config['prev_link'] = "Prev";
    $config['next_link'] = "Next";
    $this->pagination->initialize($config);

    // Dropdown options
    $data['client_opt'] = ['' => 'Select Client'];
    $clients = $this->db->where('status !=', 'Delete')->order_by('client_name')->get('tsk_clients_info')->result_array();
    foreach ($clients as $c) $data['client_opt'][$c['client_id']] = $c['client_name'];

    $data['project_opt'] = ['' => 'Select Project'];
    $projects = $this->db->where('status !=', 'Delete')->order_by('project_name')->get('tsk_project_info')->result_array();
    foreach ($projects as $p) $data['project_opt'][$p['project_id']] = $p['project_name'];

    $data['employees'] = $this->db->select('employee_id, employee_name')
                                  ->where('status', 'Active')
                                  ->order_by('employee_name')
                                  ->get('tsk_employee_info')
                                  ->result_array();

    // List query
    $sql = "
        SELECT 
            t.*,
            c.client_name,
            p.project_name,
            GROUP_CONCAT(e.employee_name ORDER BY e.employee_name SEPARATOR ', ') AS assigned_employees
        FROM tsk_task_info t
        LEFT JOIN tsk_clients_info c ON t.client_id = c.client_id
        LEFT JOIN tsk_project_info p ON t.project_id = p.project_id
        LEFT JOIN tsk_assign_info a ON t.task_id = a.task_id AND a.status = 'Active'
        LEFT JOIN tsk_employee_info e ON a.assigned_to = e.employee_id
        WHERE t.status != 'Delete'
        GROUP BY t.task_id
        ORDER BY t.due_date ASC, t.priority DESC, t.task_id DESC
        LIMIT " . (int)$this->uri->segment(2, 0) . ", " . $config['per_page'];

    $data['record_list'] = $this->db->query($sql)->result_array();
    $data['pagination'] = $this->pagination->create_links();

    $this->load->view('page/master/task-list', $data);
}






}