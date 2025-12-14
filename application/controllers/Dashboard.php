<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function index()
    {
        if (!$this->session->userdata(SESS_HD . 'logged_in'))
            redirect();

        date_default_timezone_set("Asia/Calcutta");
        $data = array();
        $data['js'] = 'dash.inc';

        // Total Tasks
        $data['total_tasks'] = $this->db->count_all('tsk_task_info');

        // Today's Tasks
        $this->db->where('DATE(due_date)', date('Y-m-d'));
        $data['today_tasks'] = $this->db->count_all_results('tsk_task_info');

        // Pending Tasks
        $this->db->where('task_status !=', 'Completed');
        $data['pending_tasks'] = $this->db->count_all_results('tsk_task_info');

        // Completed Tasks
        $this->db->where('task_status', 'Completed');
        $data['completed_tasks'] = $this->db->count_all_results('tsk_task_info');

        // Clients
        $data['client_count'] = $this->db->count_all('tsk_clients_info');

        // Projects
        $data['project_count'] = $this->db->count_all('tsk_project_info');

        // Employees
        $data['employee_count'] = $this->db->count_all('tsk_employee_info');

        // Tasks due in 30 minutes - FIXED QUERY RESET
        $current_time = date('Y-m-d H:i:s');
        $thirty_min_later = date('Y-m-d H:i:s', strtotime('+30 minutes'));

        $this->db->from('tsk_task_info');
        $this->db->where('task_status !=', 'Completed');
        $this->db->where('due_date <=', $thirty_min_later);
        $this->db->where('due_date >=', $current_time);
        $data['due_30min'] = $this->db->count_all_results();

        // Get due tasks list - FIXED FIELD NAME
        $this->db->from('tsk_task_info');
        $this->db->select('task_title, due_date');
        $this->db->where('task_status !=', 'Completed');
        $this->db->where('due_date <=', $thirty_min_later);
        $this->db->where('due_date >=', $current_time);
        $this->db->order_by('due_date', 'ASC');
        $data['due_tasks'] = $this->db->get()->result_array();

        $this->load->view('page/dashboard', $data);
    }

    public function check_due_tasks()
    {
        $current_time = date('Y-m-d H:i:s');
        $thirty_min_later = date('Y-m-d H:i:s', strtotime('+30 minutes'));

        $this->db->from('tsk_task_info');
        $this->db->where('task_status !=', 'Completed');
        $this->db->where('due_date <=', $thirty_min_later);
        $this->db->where('due_date >=', $current_time);
        $due_count = $this->db->count_all_results();

        $this->db->from('tsk_task_info');
        $this->db->select('task_title, DATE_FORMAT(due_date, "%H:%i") as due_time');
        $this->db->where('task_status !=', 'Completed');
        $this->db->where('due_date <=', $thirty_min_later);
        $this->db->where('due_date >=', $current_time);
        $tasks = $this->db->get()->result_array();

        echo json_encode([
            'due_count' => $due_count,
            'tasks' => $tasks
        ]);
    }
}
?>
