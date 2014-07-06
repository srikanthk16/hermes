<?php
/* ****************************************** */
/* 		 BabyEgg Software 2014		   		  */
/* Authors:									  */
/*			Srikanth Kasukurthi				  */
/*			Shreya Gangishetty				  */
/*			Saivivek Therala 				  */
/* * @license 								  */
/*http://www.apache.org/licenses/LICENSE-2.0  */
/*  Apache License 2.0						  */
/*@link http://github.com/srikanthk16/hermes  */	
/* ****************************************** */
class transitProvider
{
public $t_id;
public $t_name;
public $t_time;
public function __construct()
{
}
public function returnBuses($mysqli)
{
$mysqli_result=$mysqli->query("SELECT b_name from transitProvider");
$bnames=array();
while($row=$mysqli_result->fetch_assoc())
{
array_push($bnames,$row['b_name']);
}
return $bnames;
}
public function insertProvider($name,$startstop,$endstop,$mysqli)
{	
	
	$query="SELECT b_id from transitProvider where b_name='$name' limit 1";
	$mysqli_result=$mysqli->query($query);
	if($mysqli_result->num_rows!=0)
	{
	$result=$mysqli_result->fetch_assoc();
	$id=$result['b_id'];
	}
	else{
	$mysqli->query("INSERT INTO transitProvider VALUES(null,'$name')");
	$id=$mysqli->insert_id;}
	$query="SELECT s_id from transitLocation where s_name='".$startstop."\r'";
	$mysqli_result=$mysqli->query($query);
	$result=$mysqli_result->fetch_assoc();
	$ssid=$result['s_id'];
	$query="SELECT s_id from transitLocation where s_name='".$endstop."'";
	$mysqli_result=$mysqli->query($query);
	$result=$mysqli_result->fetch_assoc();
	$eid=$result['s_id'];
	$xid=intval($ssid);
	$yid=intval($eid);
	$result1=$mysqli->query("INSERT INTO transitprovider_handler VALUES('$id','$xid','$yid')");
		}

public function infoProvider($name,$mysqli)
{
	$query="SELECT b_id from transitProvider where b_name='$name' limit 1";
	$mysqli_result=$mysqli->query($query);
	$result=$mysqli_result->fetch_assoc();
	$id=$result['b_id'];
	$stopslist= array();
	$stopslist=$this->returnStops($id,$mysqli);
	return $stopslist;
}
public function returnStops($id,$mysqli)
{
	$query="SELECT DISTINCT s_id from transitHolder where b_id='$id'";
	$mysqli_result=$mysqli->query($query);
	$stops=array();
	while($sid=$mysqli_result->fetch_array(MYSQLI_ASSOC))
	{
	$idb=$sid['s_id'];
		$query="SELECT s_name from transitLocation where s_id='$idb'";
		$queryresult=$mysqli->query($query);
		$result=$queryresult->fetch_assoc();
		array_push($stops,$result['s_name']);
	}
	return $stops;
}
}
?>

