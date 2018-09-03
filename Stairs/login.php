<?php
require_once ("dbconfig.php");
	
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	$conn = new mysqli(HOST,USER,'', DBNAME);
	if($conn->connect_error) die($conn->connect_error);
	
	$sql = "select * from login where accountID = '$username' and password='$password'";
	$rs = $conn->query($sql);
	if(!$rs) die ($conn->error);
	
	if(mysqli_num_rows($rs)==1){
		$result = true;
		$id = $rs->fetch_assoc()["id"];
		$sql = "select * from userinfor where id = $id";
		$rs = $conn->query($sql);
		if(!$rs) die ($conn->error);
		
		$rs->data_seek(0);
		$height = $rs->fetch_assoc()["height"];
		$rs->data_seek(0);
		$weight = $rs->fetch_assoc()["weight"];
		$rs->data_seek(0);
		$age = $rs->fetch_assoc()["age"];
		$rs->data_seek(0);
		$name = $rs->fetch_assoc()["name"];
		$rs->data_seek(0);
		$gender = $rs->fetch_assoc()["gender"];
		
		$arr = array(
				'Susername' => $username,
				'Sresult' => $result,
				'Sheight' => $height,
				'Sweight' => $weight,
				'Sage' => $age,
				'Sname'=> $name,
				'Sgender' => $gender
		);
		$strr =json_encode($arr);
	}
	
	else{
		$result = false;
		$arr = array(
				'Susername' => $username,
				'Sresult' => $result
		);
		$strr =json_encode($arr);
	}
	echo ($strr);
?>