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
include('db.php');
class transitController
{
 public function __construct()
 {	
 }
public function insertHolder($sname,$bname)
{
global $mysqli;
	$query="SELECT b_id from transitProvider where b_name='$bname' limit 1";
	$queryResult=$mysqli->query($query);
	$result=$mysqli_result->fetch_assoc();
	$bid=$result['b_id'];
	$query="SELECT s_id from transitLocation where s_name='$sname' limit 1";
	$queryResult=$mysqli->query($query);
	$result=$mysqli_result->fetch_assoc();
	$sid=$result['s_id'];
	$mysqli->query("INSERT INTO transitHolder VALUES('$sid','$bid')");
}

public function compute($node1,$node2,$time)
{
//algo should go here
}
}
?>