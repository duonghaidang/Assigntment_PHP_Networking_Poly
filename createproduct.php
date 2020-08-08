<?php
	require_once 'include/DB_Functions.php';
	$db=new DB_Functions();
	$json=array();
	
	if(isset($_POST['name'])&& $_POST['name']!='')
	{
		$name=$_POST['name'];
		$price=$_POST['price'];
		$description=$_POST['description'];
		
		$result=$db->storeProduct($name,$price,$description);
		
		if($result)
		{
			$json["code"]=200;
			$json["message"]="tao san pham thanh cong";
		}
		else
		{
			$json["code"]=201;
			$json["message"]="tao khong thanh cong";
		}
	}
	else
	{
		$json["code"]=202;
		$json["message"]="chua nhap ten san pham";
	}
	
	echo json_encode($json);

?>
