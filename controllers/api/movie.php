<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Movie extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

 //Menampilkan data Movie

 
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $film = $this->db->get('movie')->result();
        } else {
            $this->db->where('id', $id);
            $film = $this->db->get('movie')->result();
        }
        $this->response($film, 200);
    }
	
	
	
//Mengirim atau menambah data Movie

	function index_post() {
        $data = array(
                    'id'         		=> $this->input->post('id'),
                    'title'         	=> $this->input->post('title'),
                    'description'       => $this->input->post('description'),
                    'rating'          	=> $this->input->post('rating'),
                    'image'          	=> $this->input->post('image'),
                    'created_at'        => $this->input->post('created_at'),
                    'updated_at'    	=> $this->post('updated_at'));
        
		$insert = $this->db->insert('movie', $data);
		
		#echo '<pre>'; print_r($insert); die;
		
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
	
	//Memperbarui data movie yang telah ada
	
	function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id'           			=> $this->put('id'),
                    'title'         		=> $this->put('title'),
                    'description'         	=> $this->put('description'),
                    'rating'         		=> $this->put('rating'),
                    'image'          		=> $this->put('image'),
                    'created_at'          	=> $this->put('created_at'),
                    'updated_at'    		=> $this->put('updated_at'));
        $this->db->where('id', $id);
        
		
		$update = $this->db->update('movie', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
	
	//Menghapus salah satu data movie
	
	
	function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('movie');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }


}
?>