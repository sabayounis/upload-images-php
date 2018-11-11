<?php
	
	class Category_model extends CI_Model{
		public function __construct(){
			
			$this->load->database();
			
		}
		//get categories list
		public function get_categories(){
			$this->db->order_by('name');
			$query = $this->db->get('categories');
			return $query->result_array();
		}
		//create category
		public function create_category($id){
			$data= array(
			
			'name' => $this->input->post('name')
			
			);
			//insert in categories
			return $this->db->insert('categories',$data);
			
		}
		//get single category
		public function get_category($id){
			$query= $this->db->get_where('categories',array('id'=>$id));
			return $query->row();
		}
		
		
		
	}
	
?>