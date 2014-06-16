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
/*@link http://github.com/srikanthk16/transit */	
/* ****************************************** */

include("db.php");
class transitLocation
{
public $t_id;
public $t_name;
public $t_time;
private $i;
public function insertLocation($name)
{	
	global $mysqli;
	$mysqli->query("INSERT INTO transitLocation VALUES(null,'$name')");
	$id=$mysqli->insert_id;
	echo $id;
}
public function insertSpecialnodes($name,$sNodes)
{	
	global $mysqli;
	$query="SELECT s_id from transitLocation where s_name='$name' limit 1";
	$queryResult=$mysqli::query($query);
	$result=$mysqli_result::fetch_assoc();
	$id=$result['s_id'];
	foreach( $sNodes as $t)
	{	
		$query="SELECT s_id from transitLocation where s_name='$t' limit 1";
	$queryResult=$mysqli::query($query);
	$result=$mysqli_result::fetch_assoc();
	$sid=$result['s_id'];
		mysqli::query("INSERT INTO transitLocation_specialnodes VALUES('$id','$sid')");
	}
}	
public function insertNeighbornodes($name,$nNodes,$nValues)
{
	global $mysqli;
	$query="SELECT s_id from transitLocation where s_name='$name' limit 1";
	$queryResult=$mysqli::query($query);
	$result=$mysqli_result::fetch_assoc();
	$id=$result['s_id'];
	$i=0;
	$query="SELECT s_id from transitLocation where s_name='$t' limit 1";
	$queryResult=$mysqli::query($query);
	$result=$mysqli_result::fetch_assoc();
	$nid=$result['s_id'];
	mysqli::query("INSERT INTO transitLocation_neighbors VALUES('$id','$nid','$nValues[0]','$nValues[1]')");
	

}
public function infoLocation($name)
{
	global $mysqli;
	$query="SELECT s_id from transitLocation where s_name='$name' limit 1";
	$queryResult=$mysqli::query($query);
	$result=$mysqli_result::fetch_assoc();
	$id=$result['s_id'];
	$bP=array();
	$bP=$this->returnBuses($id);
}
public function returnBuses($id)
{
	global $mysqli;
	$query="SELECT b_id from transitHolder where s_id='$id'";
	$queryResult=$mysqli::query($query);
	$bid=$mysqli_result::fetch_array();
	$blist= array();
	foreach($bid as $idb)
	{
		$query="SELECT b_name from transitProvider where b_id='$idb'";
		$queryResult=$mysqli::query($query);
		$result=$mysqli_result::fetch_assoc();
		array_push($blist,$result['b_name']);
	}
	return $blist;
}
}
?>

