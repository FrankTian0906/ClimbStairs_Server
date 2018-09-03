<?php
require_once ("dbconfig.php");
date_default_timezone_set("America/St_Johns");

$username = $_POST['username'];
$data = $_POST['data'];
$table = 'user'. $username;

$conn = new mysqli(HOST,USER,'', DBNAME);
if($conn->connect_error) die($conn->connect_error);

$t=time();
$time = date("YmdHis",$t);

$sql = "insert into $table value($time, $data)";
echo ($sql);

$rs = $conn->query($sql);
if(!$rs) die ($conn->error);
?>
