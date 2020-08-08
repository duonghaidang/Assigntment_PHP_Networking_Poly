<?php
class DB_Functions
{
	public  $db;
	// ham tao
	function __construct()
	{
		require_once("DB_Connect.php");
		$this->db=new DB_Connect();
		$this->db->connect();
	}
	
	function __destruct()
	{
	}
	
	//luu user va database
	public function storeUser($username,$email,$password)
	{
		$sql="INSERT INTO user
			(username,email,password,create_date)VALUES 
			('$username', '$email', '$password', NOW())";
		$con=$this->db->connect();
		// thuc hien lenh sql
		$result=mysqli_query($con,$sql);
		

		if($result==true)
		{
			//chu y: phai dung chung connect thi moi lay duoc id
			$id=mysqli_insert_id($con);//id cuoi cung cung la dulieu vua them

			$result=mysqli_query($this->db->connect(),"select * from user where id='$id'");
			
			return mysqli_fetch_array($result);
		}
		else
			return false;
	}
	
	//lay thong tin user dua vao email va password
	public function getUser($email,$password)
	{
		$sql="select * from user where email='$email' and password='$password'";
		$result=mysqli_query($this->db->connect(),$sql) ;
		
		$rows=mysqli_num_rows($result);//lay so hang
		
		if($rows>0) //neu co hang tuc la co user
		{
			$result=mysqli_fetch_array($result);
			//echo "co user ne";
			return $result;
		}
		else //khong co user
		{
			//echo "khong co user ne ba";
			return false;
		}
	}
	
	//kiem tra email da co nguoi dung chua
	public function checkUser($email)
	{
		$sql="select * from user where email='$email'";
		$this->db->close();
		$con=$this->db->connect();
		//$result=mysqli_query($this->db->connect(),$sql);
		$result=mysqli_query($con,$sql);
		
		$rows=mysqli_num_rows($result);//lay so hang
	
		if($rows>0) 
		
			return true; //user da ton tai
		else
			return false; //chua co user nay
	}

			//ham ghi product vao database
			public function storeProduct($name,$price,$description)
			{
				$sql="insert into product
				(name,price,description,create_date) values
				('$name','$price','$description', NOW() )";
				$con=$this->db->connect();
				$result=mysqli_query($con,$sql);
				return $result;
			}
			
			
			//ham lay chi tiet san pham dua vao id
			public function getProductDetail($id)
			{
				$sql="select * from product
						where id='$id'";
				$con=$this->db->connect();
				$result=mysqli_query($con,$sql);
				return $result;
			}
		
		//ham lay tat ca cac san pham
			public function getAllProducts()
			{
				$sql="select * from product";
				$con=$this->db->connect();
				$result=mysqli_query($con,$sql);
				return $result;
			}
			
			public function updateProduct($id,$name,$price,$description)
			{
				$sql="update product set name='$name',
					price='$price',description='$description' where id='$id'";
				$con=$this->db->connect();
				$result=mysqli_query($con,$sql);
				return $result;
			}
			
			//ham xoa mot san pham
			public function deleteProduct($id)
			{
				$sql="delete  from product where id='$id' ";
				$con=$this->db->connect();
				$result=mysqli_query($con,$sql);
				
				//ham affected_rows tra ve so record bi
				//anh huong boi cau lenh insert, update,delete
				return mysqli_affected_rows($con);
			}
}
?>