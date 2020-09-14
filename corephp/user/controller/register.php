<?php 
include("model/UserModel.php");
$postedData=angPostedData();

///all validation will apply here
if(isset($postedData['email']) && !empty($postedData['email']) 
	&& isset($postedData['password']) && !empty($postedData['password'])
	&& isset($postedData['userName']) && !empty($postedData['userName'])
	&& isset($postedData['contact']) && !empty($postedData['contact'])
){
	//
	 $email= Sanitize_input($postedData['email']);
	 $userNamePosted= Sanitize_input($postedData['userName']);
	 $contact= Sanitize_input($postedData['contact']);
     $password=Sanitize_input($postedData['password']);
	 
	 //check value in DB
	 $user =new UserModel();
	 $KeyID=$email;
	 $fields='id';
	 $tablename='user';
	 $KeyFieldName='email';
	
	 
	 //check db in if user already avaliable
	 $checkUser=$user->getInfo($KeyID,'','',$fields,$tablename,$KeyFieldName);
	 if(count($checkUser)>0){
		// echo $checkUser[0]['id'];
	     $json_data=array('status'=>false,'msg'=>'Email already available');
	 }else{
		 
		 //save data in db
		        $userName=changeOrder($userNamePosted,strlen($userNamePosted));
		        $insertData['username']=$userName;
				$insertData['password']=$password;
				$insertData['email']=$email;
				$insertData['contact']=$contact;
				$addrecord_contact				=	$user->AddInfo($insertData,$tablename);
				if($addrecord_contact)
			{
				$json_data=array('status'=>true,'msg'=>'saved sucessfull');
				
			}else{
				 $json_data=array('status'=>false,'msg'=>'Some error please try again some time');
			}
		 
	 }
	
}else{
	
	$json_data=array('status'=>false,'msg'=>'input not valid ');
}
echo json_encode($json_data);

	?>