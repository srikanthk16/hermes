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
/*@link http://github.com/srikanthk16/transit */	
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
array_push($bnames,$row['s_name']);
}
return $bnames;
}
public function insertProvider($name,$startstop,$endstop,$time,$mysqli)
{	
	$query="SELECT b_id from transitProvider where b_name='$name' limit 1";
	$mysqli_result=$mysqli->query($query);
	if($mysqli_result->num_rows()!=0)
	{
	$result=$mysqli_result->fetch_assoc();
	$id=$result['b_id'];
	}
	else{
	$mysqli->query("INSERT INTO transitProvider VALUES(null,'$name')");
	$id=$mysqli->insert_id;}
	foreach($time as $t)
	{	
		$mysqli->query("INSERT INTO transitprovider_timings VALUES('$id','$startstop','$endstop','$t')");
	}
}
public function returnTimings($id,$mysqli)
{
	$mysqli_result=$mysqli->query("SELECT startTime FROM transitProvider_timings WHERE b_id=$id");
	if(!$mysqli_result) 
	{
		return null;
	}
	else
	{
		return $mysqli_result->fetch_array();
	}
}
public function infoProvider($name,$mysqli)
{
	$query="SELECT b_id from transitProvider where b_name='$name' limit 1";
	$mysqli_result=$mysqli->query($query);
	$result=$mysqli_result->fetch_assoc();
	$id=$result['b_id'];
	$timings=$this->returnTimings($id,$mysqli);
	$stopslist= array();
	$stopslist=$this->returnStops($id,$mysqli);
	return array($stopslist,$timings);
}
public function returnStops($id,$mysqli)
{
	$query="SELECT s_id from transitHolder where b_id='$id'";
	$mysqli_result=$mysqli->query($query);
	$sid=$mysqli_result->fetch_array();
	$stops=array();
	foreach($sid as $idb)
	{
		$query="SELECT s_name from transitLocation where s_id='$idb'";
		$mysqli_result=$mysqli->query($query);
		$result=$mysqli_result->fetch_assoc();
		array_push($stops,$result['s_name']);
	}
	return $stops;
}
}
?>

