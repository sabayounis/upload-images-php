
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Posts extends CI_Controller{
		function index(){
			$data['title']='Latest Posts';
			
			$data['posts']=$this->post_model->get_posts();
			//print_r($data['posts']);
			$this->load->view('templates/header');
			$this->load->view('posts/index',$data);
			$this->load->view('templates/footer');
			
			
		}//get single post
		public function view($slug= NULL){
			$data['post'] = $this->post_model->get_posts($slug);
			$post_id = $data['post']['id'];
			$data['comments'] = $this->comment_model->get_comments($post_id);
			if(empty($data['post'])){
				show_404();
				
				
			}
			$data['title']=$data['post']['title'];
			$this->load->view('templates/header');
			$this->load->view('posts/view',$data);
			$this->load->view('templates/footer');
			
		}
		//create single post
		public function create(){
			$data['title'] ='Create a post';
			$data['categories']=$this->post_model->get_categories();
			$this->form_validation->set_rules('title', 'Title','Required');
			$this->form_validation->set_rules('body', 'Body','Required');
			if($this->form_validation->run()===FALSE){
				$this->load->view('templates/header');
				$this->load->view('posts/create',$data);
				$this->load->view('templates/footer');
				
			}
			else{
				//upload image
				$config['upload_path'] = './assets/images/posts';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';
				
				$this->load->library('upload', $config);
				
				if(!$this->upload->do_upload()){
					$errors = array('error' => $this->upload->display_errors());
					$post_image = 'noimage.jpg';
					} else {
					$data = array('upload_data' => $this->upload->data());
					$post_image = $_FILES['userfile']['name'];
				}
				
				$this->post_model->create_post($post_image);
				// Flash messages -->
				$this->session->flashdata('post_created', 'your post has been created');
				
				redirect ('posts');
				
			}
			
		}
		//delete single post
		public function delete($id){
			
			$this->post_model->delete_post($id);
			// Flash messages -->
				$this->session->flashdata('post_deleted', 'your post has been deleted');
					
			redirect('posts');
		}
		//edit post
		public function edit($slug){
			
			//get the posts
			$data['post']=$this->post_model->get_posts($slug);
			$data['categories']=$this->post_model->get_categories();
			if(empty($data['post'])){
				show_404();		
			}
			$data['title']="Edit Post";
			$this->load->view('templates/header');
			$this->load->view('posts/edit',$data);
			$this->load->view('templates/footer');
			
		}
		public function update(){
			$this->post_model->update_post();
			// Flash messages -->
				$this->session->flashdata('post_updated', 'your post has been updated');
			redirect('posts');
		}
	}
?>