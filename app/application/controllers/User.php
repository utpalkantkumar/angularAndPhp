<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
function __construct()
    {
        parent::__construct();
    }

	//user register method
	public function register()
	{
		$_POST=angPostedData();
      
	  
        if(!empty($_POST)){
			$this->form_validation->set_rules('userName', 'User name', 'required|max_length[150]');
	     $this->form_validation->set_rules('password', 'User Password', 'required|max_length[150]');
		 $this->form_validation->set_rules('email', 'Email', 'required|max_length[150]');
		$this->form_validation->set_rules('contact', 'Contact', 'required|max_length[11]');
			  
			  
			  if ($this->form_validation->run() == FALSE){
					 $json_data=array('status'=>false,'msg'=>'Value not valid','error'=>validation_errors()); 		
			  }else{
				$userNamePosted   = Sanitize_input($this->input->post('userName'));

				$userName=changeOrder($userNamePosted,strlen($userNamePosted));
				$password = Sanitize_input($this->input->post('password'));      
				$email = Sanitize_input($this->input->post('email'));
				$contact = Sanitize_input($this->input->post('contact'));
				
				
				
				//check in DB if record already exists by email id
				$key['email']=$email;
				
             $getUserDataFrmDb = $this->Default_model->GetInfoRow('user',$key); 				
				if(count($getUserDataFrmDb)>0){//data already avaliable
				$json_data=array('status'=>false,'msg'=>'Email already available');	
				}else{
				
				//save in db
				$insertData['username']=$userName;
				$insertData['password']=$password;
				$insertData['email']=$email;
				$insertData['contact']=$contact;
				$saveData = $this->Default_model->insert_data('user',$insertData);
				if($saveData>0){
				       $json_data=array('status'=>true,'msg'=>'saved sucessfull');
				}else{
					 $json_data=array('status'=>false,'msg'=>'Due to some reason data not saved');
				}
					
				}
				
				 
			  }
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($json_data));
	}
	
	
	//validate login
	public function login()
	{
		$_POST=angPostedData();
      
	  
        if(!empty($_POST)){
			$this->form_validation->set_rules('email', 'Email', 'required|max_length[150]');
	     $this->form_validation->set_rules('password', 'User Password', 'required|max_length[150]');
		
			  
			  
			  if ($this->form_validation->run() == FALSE){
					 $json_data=array('status'=>false,'msg'=>'Value not valid','error'=>validation_errors()); 		
			  }else{
				$email   = Sanitize_input($this->input->post('email'));

				$password = Sanitize_input($this->input->post('password'));      
				
				
				
				
				//check in DB if record already exists
				 $key['email']=$email;
				//$key['password']=
				//echo $password;
				
             $getUserDataFrmDb = $this->Default_model->GetInfoRow('user',$key); 				
				if(count($getUserDataFrmDb)>0){//data  avaliable
				//echo $getUserDataFrmDb[0]->password;
				   if($getUserDataFrmDb[0]->password==$password){
					   $json_data=array('status'=>true,'msg'=>'Success','id'=>$getUserDataFrmDb[0]->id);
				   }else{
					   $json_data=array('status'=>false,'msg'=>'Password not valid ');
				   }
				   	
				}else{
				
				$json_data=array('status'=>false,'msg'=>'This email is not registred');	
				}
				
				 
			  }
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($json_data));
	}
	
	
	//get user details by id
	//validate login
	public function profile($postedId)
	{
		
		$id   = Sanitize_input($postedId);
		 $key['id']=$id;
				
		$getUserDataFrmDb = $this->Default_model->GetInfoRow('user',$key);
		
		if(count($getUserDataFrmDb)>0){//data already avaliable
		
		         $username=$getUserDataFrmDb[0]->username;
				 $strLength=-1 * abs(strlen($username));
		        $email=$getUserDataFrmDb[0]->email;
		        $contact=$getUserDataFrmDb[0]->contact;
		
				$json_data=array('status'=>true,
				'msg'=>'id valid',
				'data'=>array(
				"username"=>changeOrder($username,$strLength),
				"email"=>$email,
				"contact"=>$contact));
				
				
				}else{
				
				$json_data=array('status'=>false,'msg'=>'id not valid');	
				}
		
        
		return $this->output->set_content_type('application/json')->set_output(json_encode($json_data));
	}
	
}
