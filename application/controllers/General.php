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


    }

}