<?php
defined('BASEPATH') or exit('No direct script access allowed');

class General extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        //$this->load->view('page/dashboard');
    }


    public function get_data()
    {
        //if(!$this->session->userdata('zazu_logged_in'))  redirect();

        date_default_timezone_set("Asia/Calcutta");


        $table = $this->input->post('tbl');
        $rec_id = $this->input->post('id');


  if ($table == 'tsk_assign_info') {

    $query = $this->db->query(" 
        SELECT 
            a.assigned_to 
        FROM tsk_assign_info AS a  
        WHERE a.task_id = '" . $rec_id . "'
        AND a.status = 'Active'
    ");

    $rec_list = array();

    foreach ($query->result_array() as $row) {
        $rec_list[] = $row['assigned_to'];   // multiple employee IDs
    }

    echo json_encode($rec_list);
    exit;
}


        if ($table == 'sas_blood_group_info') {
            $query = $this->db->query(" 
                select 
                a.* 
                from sas_blood_group_info as a  
                where a.blood_group_id = '" . $rec_id . "'
            ");

            $rec_list = array();

            foreach ($query->result_array() as $row) {
                $rec_list = $row;
            }

        }


        if ($table == 'tsk_emp_type_info') {
            $query = $this->db->query(" 
                select 
                a.* 
                from tsk_emp_type_info as a  
                where a.emp_type_id = '" . $rec_id . "'
            ");

            $rec_list = array();

            foreach ($query->result_array() as $row) {
                $rec_list = $row;
            }

        }


        if ($table == 'tsk_emp_category_info') {
            $query = $this->db->query(" 
                select 
                a.* 
                from tsk_emp_category_info as a  
                where a.emp_category_id = '" . $rec_id . "'
            ");

            $rec_list = array();

            foreach ($query->result_array() as $row) {
                $rec_list = $row;
            }

        }

        if ($table == 'get-designation') {
            $query = $this->db->query(" 
                    select 
                    a.*
                    from tsk_designation_info as a
                    where a.employee_category = '" . $rec_id . "'  
                    and a.status = 'Active'
                    order by a.designation_name asc
                    ");

            $rec_list = array();

            foreach ($query->result_array() as $row) {
                $rec_list[] = $row;
            }
        }

        if ($table == 'designation_info') {
            $query = $this->db->query(" 
                select 
                a.*
                from tsk_designation_info as a
                where a.designation_id = '" . $rec_id . "'  
                order by a.designation_id asc
                ");

            $rec_list = array();

            foreach ($query->result_array() as $row) {
                $rec_list = $row;
            }
        }


        if ($table == 'tsk_clients_info') {
            $query = $this->db->query(" 
                select 
                a.* 
                from tsk_clients_info as a  
                where a.client_id = '" . $rec_id . "'
            ");

            $rec_list = array();

            foreach ($query->result_array() as $row) {
                $rec_list = $row;
            }

        }

        if ($table == 'user_login_info') {
            $query = $this->db->query(" 
                select 
                a.* 
                from user_login_info as a  
                where a.user_id = '" . $rec_id . "'
            ");

            $rec_list = array();

            foreach ($query->result_array() as $row) {
                $rec_list = $row;
            }

        }

        if ($table == 'tsk_project_info') {
            $query = $this->db->query(" 
                select 
                a.* 
                from tsk_project_info as a  
                where a.project_id = '" . $rec_id . "'
            ");

            $rec_list = array();

            foreach ($query->result_array() as $row) {
                $rec_list = $row;
            }

        }
        if ($table == 'tsk_task_info') {
            $query = $this->db->query(" 
                select 
                a.* 
                from tsk_task_info as a  
                where a.task_id = '" . $rec_id . "'
            ");

            $rec_list = array();

            foreach ($query->result_array() as $row) {
                $rec_list = $row;
            }

        }




        $this->db->close();

        header('Content-Type: application/x-json; charset=utf-8');

        echo (json_encode($rec_list));
    }

    public function delete_record()
    {

        if (!$this->session->userdata(SESS_HD . 'logged_in'))
            redirect();

        date_default_timezone_set("Asia/Calcutta");


        $table = $this->input->post('tbl');
        $rec_id = $this->input->post('id');


        if ($table == 'sas_blood_group_info') {
            $this->db->where('blood_group_id', $rec_id);
            $this->db->update('sas_blood_group_info', array('status' => 'Delete'));
            echo "Blood Group Deleted Successfully";
        }

        if ($table == 'tsk_emp_type_info') {
            $this->db->where('emp_type_id', $rec_id);
            $this->db->update('tsk_emp_type_info', array('status' => 'Delete'));
            echo "Employee Type Deleted Successfully";
        }

        if ($table == 'tsk_emp_category_info') {
            $this->db->where('emp_category_id', $rec_id);
            $this->db->update('tsk_emp_category_info', array('status' => 'Delete'));
            echo "Category Deleted Successfully";
        }


        if ($table == 'user_login_info') {
            $this->db->where('user_id', $rec_id);
            $this->db->update('user_login_info', array('status' => 'Delete'));
            echo "Record Deleted Successfully";
        }

        if ($table == 'tsk_clients_info') {
            $this->db->where('client_id', $rec_id);
            $this->db->update('tsk_clients_info', array('status' => 'Delete'));
            echo "Client Deleted Successfully";
        }
        if ($table == 'tsk_project_info') {
            $this->db->where('project_id', $rec_id);
            $this->db->update('tsk_project_info', array('status' => 'Delete'));
            echo "Project Deleted Successfully";
        }
        if ($table == 'tsk_task_info') {
            $this->db->where('task_id', $rec_id);
            $this->db->update('tsk_task_info', array('status' => 'Delete'));
            echo "Task Deleted Successfully";
        }

    }

}