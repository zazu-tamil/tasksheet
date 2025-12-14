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

        // Add New Project
        if ($this->input->post('mode') == 'Add') {
            $ins = array(
                'client_id' => $this->input->post('client_id'),
                'project_code' => $this->input->post('project_code'),
                'project_name' => $this->input->post('project_name'),
                'project_description' => $this->input->post('project_description'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'project_status' => $this->input->post('project_status'),
                'status' => $this->input->post('Status'),
                'created_by' => $this->session->userdata(SESS_HD . 'user_id'),
                'created_date' => date('Y-m-d H:i:s')
            );

            $this->db->insert('tsk_project_info', $ins);
            redirect('project-list');
        }

        // Edit Project
        if ($this->input->post('mode') == 'Edit') {
            $upd = array(
                'client_id' => $this->input->post('client_id'),
                'project_code' => $this->input->post('project_code'),
                'project_name' => $this->input->post('project_name'),
                'project_description' => $this->input->post('project_description'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'project_status' => $this->input->post('project_status'),
                'status' => $this->input->post('status'),
                'updated_by' => $this->session->userdata(SESS_HD . 'user_id'),
                'updated_date' => date('Y-m-d H:i:s')
            );

            $this->db->where('project_id', $this->input->post('project_id'));
            $this->db->update('tsk_project_info', $upd);
            redirect('project-list');
        }

        $this->load->library('pagination');

        $this->db->where('status !=', 'Delete');
        $this->db->from('tsk_project_info');
        $data['total_records'] = $cnt = $this->db->count_all_results();

        $data['sno'] = $this->uri->segment(2, 0);

        $config['base_url'] = site_url('project-list');
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

        $data['client_opt'] = array();

        $sql = "
            SELECT 
                client_id , 
                client_name 
            FROM tsk_clients_info
            WHERE status = 'Active'
            ORDER BY client_name ASC
        ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data['client_opt'][$row['client_id']] = $row['client_name'];
        }

        $data['project_status_opt'] = array(
            'Pending' => 'Pending', 'In Progress' => 'In Progress', 'Completed' => 'Completed'
        );


        $sql = "
            SELECT a.* 
            , b.client_name
            FROM tsk_project_info a
            LEFT JOIN tsk_clients_info b ON a.client_id = b.client_id
            WHERE a.status != 'Delete'
            ORDER BY a.status ASC, a.project_name ASC 
            LIMIT " . $this->uri->segment(2, 0) . ", " . $config['per_page'];

        $query = $this->db->query($sql);
        $data['record_list'] = $query->result_array();

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('page/master/project-list', $data);
    }
}