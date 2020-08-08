<?php
	require_once 'include/DB_Functions.php';
	$db=new DB_Functions();
	$json=array();
	
	if(isset($_POST['id']) && $_POST['id']!='' &&
			isset($_POST['name']) && $_POST['name']!='' )
	{
		$id=$_POST['id'];
		$name=$_POST['name'];
		$price=$_POST['price'];
		$description=$_POST['description'];
		
		$result=$db->updateProduct($id,$name,$price,$description);
		if($result)
		{
			$json["code"]=200;
			$json["message"]="cap nhat san pham thanh cong";
		}else{
			$json["code"]=201;
			$json["message"]="cap nhat san pham that bai";
		}
	}
	else
	{
		$json["code"]=202;
		$json["message"]="khong co id hoac ten";
	}
	
	echo json_encode($json);
?>
