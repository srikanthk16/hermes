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

include_once('db.php');
class transitProvider
{
public $t_id;
public $t_name;
public $t_time;
public function __construct()
{
echo 'testing';
}
public function insertProvider($name,$time)
{	
	global $mysqli;
	$mysqli->query("INSERT INTO transitProvider VALUES(null,'$name')");
	$id=$mysqli->insert_id;
	foreach($time as $t)
	{	
		$mysqli->query("INSERT INTO transitprovider_timings VALUES('$id','$t')");
	}
}
public function returnTimings($id)
{
	global $mysqli;
	$queryResult=$mysqli->query("SELECT startTime FROM transitProvider_timings WHERE b_id=$id");
	if(!$queryResult) 
	{
		return null;
	}
	else
	{
		return $mysqli_result->fetch_array();
	}
}
public function infoProvider($name)
{
	global $mysqli;
	$query="SELECT b_id from transitProvider where b_name='$name' limit 1";
	$queryResult=$mysqli->query($query);
	$result=$mysqli_result->fetch_assoc();
	$id=$result['b_id'];
	$timings=$this->returnTimings($id);
	$stopslist= array();
	$stopslist=$this->returnStops($id);
}
public function returnStops($id)
{
	global $mysqli;
	$query="SELECT s_id from transitHolder where b_id='$id'";
	$queryResult=$mysqli->query($query);
	$sid=$mysqli_result->fetch_array();
	$stops=array();
	foreach($sid as $idb)
	{
		$query="SELECT s_name from transitLocation where s_id='$idb'";
		$queryResult=$mysqli->query($query);
		$result=$mysqli_result->fetch_assoc();
		array_push($stops,$result['s_name']);
	}
	return $stops;
}
}
?>

