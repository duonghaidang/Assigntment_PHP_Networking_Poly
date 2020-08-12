<?php
	require_once 'include/DB_Functions.php';
	$db=new DB_Functions();
    $json=array();
    
    $id=$_POST['id'];
	
	$result=$db->getProductDetail($id);
	if(mysqli_num_rows($result)>0)//co san pham
	{
		$json["code"]=200;
		$json["message"]="Tai san pham thanh cong";
		$json["sanpham"]=array(); //mang con
		
		//duyet tat ca san pham dua vao json
		while($row=mysqli_fetch_array($result))
		{
			$sanpham=array();
			$sanpham["id"]=$row["id"];
			$sanpham["name"]=$row["name"];
			$sanpham["price"]=$row["price"];
			$sanpham["description"]=$row["description"];
			$sanpham["create_date"]=$row["create_date"];
			
			//dua san pham vao mang
			array_push($json["sanpham"],$sanpham);
		}
	}
	else //khong co san pham
	{
		$json["code"]=201;
		$json["message"]="Khong co san pham";
	}
	echo json_encode($json);

?>
