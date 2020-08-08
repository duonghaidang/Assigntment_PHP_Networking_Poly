<?php
	require_once 'include/DB_Functions.php';
	$db=new DB_Functions();
	$json=array();
	
	if(isset($_POST['id']) && $_POST['id']!='')
	{
		$id=$_POST['id'];
		$result=$db->deleteProduct($id);
		if($result)//co san pham
		{
			$json["code"]=200;
			$json["message"]="xoa thanh cong";
		}
		else //khong co san pham
		{
			$json["code"]=201;
			$json["message"]="khong co san pham";
		}
	}
	else
	{
		$json["code"]=202;
		$json["message"]="khong co id";
	}
	
	echo json_encode($json);

?>
