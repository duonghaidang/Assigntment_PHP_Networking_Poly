<?php
	require_once 'include/DB_Functions.php';
	$db=new DB_Functions();
	$json=array();
	
	if(isset($_POST['email']) && $_POST['email']!='' &&
			isset($_POST['password']) && $_POST['password']!='' &&
			isset($_POST['newpassword']) && $_POST['newpassword']!='' )
	{
		$email=$_POST['email'];
		$password=$_POST['password'];
		$newpassword=$_POST['newpassword'];
		
		$result=$db->changePassword($email,$password,$newpassword);
		if($result)
		{
			$json["code"]=200;
			$json["message"]="Doi mat khau thanh cong";
		}else{
			$json["code"]=201;
			$json["message"]="Mat khau khong dung";
		}
	}
	else
	{
		$json["code"]=202;
		$json["message"]="khong co email hoac pass";
	}
	
	echo json_encode($json);
?>
