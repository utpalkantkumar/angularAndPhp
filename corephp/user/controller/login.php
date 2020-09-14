<?php 
include("model/UserModel.php");
$postedData=angPostedData();

///all validation will apply here
if(isset($postedData['email']) && !empty($postedData['email']) && isset($postedData['password']) && !empty($postedData['password'])){
	//
	 $email= Sanitize_input($postedData['email']);
     $password=Sanitize_input($postedData['password']);
	 
	 //check value in DB
	 $user =new UserModel();
	 $KeyID=$email;
	 $fields='id';
	 $tablename='user';
	 $KeyFieldName='email';
	
	 
	 
	 $checkUser=$user->getInfo($KeyID,'','',$fields,$tablename,$KeyFieldName);
	 if(count($checkUser)>0){
		// echo $checkUser[0]['id'];
	     $json_data=array('status'=>true,'msg'=>'Success','id'=>$checkUser[0]['id']);
	 }else{
		 $json_data=array('status'=>false,'msg'=>'This email is not registred');
	 }
	
}else{
	
	$json_data=array('status'=>false,'msg'=>'input not valid ');
}
echo json_encode($json_data);

	?>