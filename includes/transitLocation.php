<?php
/* ****************************************** */
/* 		 BabyEgg Software@2014		   		  */
/* Authors:									  */
/*			Srikanth Kasukurthi				  */
/*			Shreya Gangishetty				  */
/*			Saivivek Therala 				  */
/* * @license 								  */
/*http://www.apache.org/licenses/LICENSE-2.0  */
/*  Apache License 2.0						  */
/*@link http://github.com/srikanthk16/hermes  */	
/* ****************************************** */
//include("db.php");
class transitLocation
{
public $i;
public $snames;
public $result;
public $id;
public $sid;
public function returnStops($mysqli)
{
$mysqli_result=$mysqli->query("SELECT s_name from transitLocation");
$snames=array();
while($row=$mysqli_result->fetch_assoc())
{
array_push($snames,$row['s_name']);
}
return $snames;
}
public function insertLocation($name,$mysqli)
{	
	$query="INSERT INTO transitLocation VALUES(null,'$name')";
	$mysqli_result=$mysqli->query($query);
	$id=$mysqli->insert_id;
	echo $id;
}
public function insertSpecialnodes($name,$sNodes,$mysqli)
{	
	$query="SELECT s_id from transitLocation where s_name='".$name."\r'";
	$mysqli_result=$mysqli->query($query);
	$result=$mysqli_result->fetch_assoc();
	$id=$result['s_id'];
	echo $id;
	foreach( $sNodes as $t)
	{	
	$query="SELECT s_id from transitLocation where s_name='".$t."\r' limit 1";
	$mysqli_result=$mysqli->query($query);
	$result=$mysqli_result->fetch_assoc();
	$sid=$result['s_id'];
	$mysqli->query("INSERT INTO transitLocation_specialnodes VALUES('$id','$sid')");
	}
}	
public function insertNeighbornodes($name,$nNodes,$nValues,$mysqli)
{
	$query="SELECT s_id from transitLocation where s_name='".$name."\r' limit 1";
	$mysqli_result=$mysqli->query($query);
	$result=$mysqli_result->fetch_assoc();
	$id=$result['s_id'];
	echo $id;
	$query="SELECT s_id from transitLocation where s_name='".$nNodes."\r' limit 1";
	$mysqli_result=$mysqli->query($query);
	$result=$mysqli_result->fetch_assoc();
	$nid=$result['s_id'];
	//echo $nid;
	$query_stat=$mysqli->query("INSERT INTO transitLocation_neighbors VALUES('$id','$nid','$nValues[0]','$nValues[1]')");
}
public function infoLocation($name,$mysqli)
{
	$query="SELECT s_id from transitLocation where s_name='".$name."\r' limit 1";
$mysqli_result=$mysqli->query($query);
	$result=$mysqli_result->fetch_assoc();
	$id=$result['s_id'];
	$bP=array();
	$bP=$this->returnBuses($id,$mysqli);
	return implode(",",$bP);
}
public function returnBuses($id,$mysqli)
{
	$query="SELECT DISTINCT b_id from transitHolder where s_id='$id'";
	$mysqli_result=$mysqli->query($query);
	$blist= array();
	while($bid=$mysqli_result->fetch_array(MYSQLI_ASSOC))
	{
	$idb=$bid['b_id'];
		$query="SELECT b_name from transitProvider where b_id='$idb'";
		$queryResult=$mysqli->query($query);
		$result=$queryResult->fetch_assoc();
		array_push($blist,$result['b_name']);
	}
	return $blist;
}
}

?>

