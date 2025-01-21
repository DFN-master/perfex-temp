<?php

defined('BASEPATH') or exit('No direct script access allowed');
set_time_limit(0);

Class Client extends ClientsController
{
    public function __construct()
    {
        parent::__construct();
         $this->load->model('feedbacks_model');
    }

	public function feedback_list()
    {
		$client_id=$_SESSION['contact_user_id']; 
        
		$email_array = $this->feedbacks_model->get_client_email($client_id);
		
		$email=$email_array[0]['email'];
		
		$feedback_array= $this->feedbacks_model->get_client_feedback_id($email);
		$feedbackid=$feedback_array[0]['feedbackid'];
		
		$data['questions_list']= $this->feedbacks_model->get_client_feedback_questions($feedbackid);
         
		 $data['title']='Questionnaire';
         $this->data($data);
		 $this->view('client_feedback_list', $data);
		 $this->layout();
    }
	
	
}
