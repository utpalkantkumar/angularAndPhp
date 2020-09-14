<?php 
include("model/UserModel.php");
 $postedId=getUrlPqrqmeter();//last value from url
$id   = Sanitize_input($postedId);
///all validation will apply here
if(intval($id)>0){
	//
	 
	 //check value in DB
	 $user =new UserModel();
	 $KeyID=$id;
	 $fields='username,email,contact';
	 $tablename='user';
	 $KeyFieldName='id';
	
	 
	 
	 $checkUser=$user->getInfo($KeyID,'','',$fields,$tablename,$KeyFieldName);
	 if(count($checkUser)>0){
		// echo $checkUser[0]['id'];
		        $username=$checkUser[0]['username'];
				$strLength=-1 * abs(strlen($username));
		        $email=$checkUser[0]['email'];
		        $contact=$checkUser[0]['contact'];
	     $json_data=array('status'=>true,
				'msg'=>'id valid core php test',
				'data'=>array(
				"username"=>changeOrder($username,$strLength),
				"email"=>$email,
				"contact"=>$contact));
	 }else{
		 $json_data=array('status'=>false,'msg'=>'id not valid');
	 }
	
}else{
	
	$json_data=array('status'=>false,'msg'=>'NA');
}
echo json_encode($json_data);

	?>