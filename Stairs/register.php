<?php
require_once("dbconfig.php");

$account=$_POST['account'];
$password=$_POST['password'];
$priority = 2;
$name=$_POST['name'];
$height=$_POST['height'];
$weight=$_POST['weight'];
$gender=$_POST['gender'];
$age = $_POST['age'];



$table = 'user'. $account;

$conn = new mysqli(HOST,USER,'', DBNAME);
if($conn->connect_error) die($conn->connect_error);

$sql = "insert into login values(null,$priority,$account,$password)";
$rs = $conn->query($sql);
if(!$rs) die ($conn->error);

if($rs){
	
	//$sql = " insert into userinfor values((select id from login where accountID=$account),$name,$age,$height,$weight,$gender)";
	$sql = " insert into userinfor(id,name,age,height,weight,gender) values((select id from login where accountID=$account),'$name',$age,$height,$weight,'$gender')";
	$rs = $conn->query($sql);
	if(!$rs) die ($conn->error);
}
else{
	echo 'fail1!';
}
	
if($rs){
	$sql = "  create table $table (dates timestamp key, records int(10) unsigned)";
	$rs = $conn->query($sql);
	if(!$rs) die ($conn->error);
	echo ('success!');
}
else{
	echo ('fail!');
}
?>