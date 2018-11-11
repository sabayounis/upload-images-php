<?php
	
	class Comments extends CI_Controller{
		//get post_id and take slug to sent into hidden field
		public function create($post_id){
			$slug = $this->input->post('slug');
			$data['post'] = $this->post_model->get_posts($slug);
			//form validation
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			
			$this->form_validation->set_rules('body', 'Body', 'required');
			
			// if this validation dsn't run then load views
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('posts/view', $data);
				$this->load->view('templates/footer');
				//when all is okay and validate then call a model function
				} else {
				$this->comment_model->create_comment($post_id);
				redirect('posts/'.$slug);
			}
			
			
		}
		
	}		