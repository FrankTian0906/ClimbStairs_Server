<?php
require_once ("dbconfig.php");

$username = $_POST['username'];
$year = $_POST['date'];

$table = 'user'. $username;
$year2 = $year + 1;

$first = $year.'0101';
$sencond = $year2.'0101';

$conn = new mysqli(HOST,USER,'', DBNAME);
if($conn->connect_error) die($conn->connect_error);

$sql = "select * from $table where dates >= timestamp('$first') and dates < timestamp('$sencond')";

$rs = $conn->query($sql);
if(!$rs) die ($conn->error);

$rows = $rs->num_rows;
$arr = array();

for($i = 0; $i < $rows; ++$i){
	$rs->data_seek($i);
	$time = substr($rs->fetch_assoc()['dates'],0,6);

	$rs->data_seek($i);
	$mark = substr($rs->fetch_assoc()['dates'],5,2);
	
	$rs->data_seek($i);
	$Srecord = $rs->fetch_assoc()['records'];
	
	for($j = $i+1; $j < $rows; ++$j){
		$rs->data_seek($j);
		$time2 = substr($rs->fetch_assoc()['dates'],0,6);
		$rs->data_seek($j);
		$Srecord2 = $rs->fetch_assoc()['records'];
		
		if($time == $time2){
			$Srecord = $Srecord + $Srecord2;
			++$i;
		}
	}
	$arr['H'.$mark] = $Srecord;
};

$strr =json_encode($arr);
echo ($strr);
?>