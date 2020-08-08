<?php
	require_once 'include/DB_Functions.php';
	$db=new DB_Functions();

	if(isset($_POST['tag'])&& $_POST['tag']!='')
	{
		$tag=$_POST['tag'];
	
		$json=array("tag"=>$tag,"code"=>0,);	
	
		if($tag=='login')
		{
			xulydangnhap($json,$db);
		}
		else if($tag=='register')
		{
			xulydangki($json,$db);
		}
		else 
		{
			echo "yeu cau khong hop le";
		}
	}
	else
	{
		echo "truy cap khong duoc";
	}
	
	
	function xulydangnhap($json,$db)
{
	$email=$_POST['email'];
	$password=$_POST['password'];
	$user =$db -> getUser($email,$password);
	if($user!=false) // tim thay user
	{
		$json["code"]=200;
			$json["user"]["id"]=$user["id"];
			$json["user"]["username"]=$user["username"];
			$json["user"]["email"]=$user["email"];
			$json["user"]["create_date"]=$user["create_date"];
			$json["user"]["update_date"]=$user["update_date"];
		
		echo json_encode($json);
	}
	else //tim khong thay user
	{
		$json["code"]=201;
		$json["message"]="Sai email hoac password";
		
		echo json_encode($json);
	}
}

function xulydangki($json,$db)
{
	$email=$_POST['email'];
	$password=$_POST['password'];
	$username=$_POST["username"];
	
	if($db->checkUser($email))//true : da ton tai
	{
		$json["code"]=202;
		$json["message"]="Email da ton tai roi";
		
		echo json_encode($json);
	}
	else//user chua ton tai, luu du lieu
	{
		$user=$db->storeUser($username,$email,$password);
		
		if($user!=false)//neu luu thanh cong
		{
			$json["code"]=200;
			$json["user"]["username"]=$user["username"];
			$json["user"]["email"]=$user["email"];
			$json["user"]["create_date"]=$user["create_date"];
			$json["user"]["update_date"]=$user["update_date"];
			
			echo json_encode($json);
		}
		else //neu luu that bai
		{
			$json["code"]=201;
			$json["message"]="Dang ki that bai";
			
			echo json_encode($json);
		}
	}
}

	
?>
