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
class transitController
{
 public function __construct()
 {	
 }
public function insertHolder($sname,$bname,$times,$wp,$mysqli)
{
	$query="SELECT b_id from transitProvider where b_name='$bname' limit 1";
	$mysqli_result=$mysqli->query($query);
	$result=$mysqli_result->fetch_assoc();
	$bid=$result['b_id'];
	echo '</br>';
	$queryx="SELECT s_id from transitLocation where s_name='".$sname."\r'";
	$mysqli_result=$mysqli->query($queryx);
	var_dump($mysqli->error);
	$result=$mysqli_result->fetch_assoc();
	$sid=$result['s_id'];
	$mysqli->query("INSERT INTO transitHolder VALUES(null,'$sid','$bid','$wp')");
	$id=$mysqli->insert_id;
	foreach($times as $t)
	{
	$mysqli->query("INSERT INTO transitholder_timings VALUES('$id','$t')");
	}
}
/*public function compute($node1,$node2,$time,$mysqli)
{
	$query="SELECT s_id from transitLocation where s_name='".$node1."\r' limit 1";
	$mysqli_result=$mysqli->query($query);
	$result=$mysqli_result->fetch_assoc();
	$id1=$result['s_id'];
	$query="SELECT s_id from transitLocation where s_name='".$node2."\r' limit 1";
	$mysqli_result=$mysqli->query($query);
	$result=$mysqli_result->fetch_assoc();
	$id2=$result['s_id'];
	$result=$this->directBus($id1,$id2,$time,$mysqli);
	return $result;
}
public function directBus($id1,$id2,$time,$mysqli)
{
	$query="SELECT DISTINCT b_id from transitHolder where s_id='$id1' AND b_id IN(SELECT b_id from transitHolder WHERE s_id='$id2')";
	$mysqli_result=$mysqli->query($query);
	if($mysqli_result->num_rows>0)
	{
	$distm=10000;
	$timem=10000;
	$pathdm=array();
	$pathtm=array();
		while($ret=$mysqli_result->fetch_array(MYSQLI_ASSOC))
		{
		$bid=$ret['b_id'];
		list($path,$wp,$dist,$time)=$this->path($id1,$id2,$bid,$mysqli);
		var_dump($path,$wp,$dist,$time); echo '</br>';
		if($distm>$dist)
		{
		$distm=$dist;
		$pathdm=$path;
			$query="SELECT h_id from transitHolder where s_id='$id1' AND b_id='$bid' AND waypoint='$wp' LIMIT 1";
			$queryResult=$mysqli->query($query);
			$x=$queryResult->fetch_assoc();
			$hid=$x['h_id'];
			$query="SELECT time FROM `transitholder_timings` WHERE t_id='$hid' AND SUBTIME(time,'$time')=(SELECT MIN(SUBTIME(time,'$time')) from transitholder_timings where t_id='$hid') LIMIT 1";
			$query2Result=$mysqli->query($query);
			$timex=$query2Result->fetch_assoc();
			$timetosd=$timex['time'];
			$query="SELECT b_name from transitprovider where b_id='$bid'";
			$query2Result=$mysqli->query($query);
			$x=$query2Result->fetch_assoc();
			$direct=$x['b_name'];
		}
		if($timem>$time)
		{
		$timem=$time;
		$pathtm=$path;
			$query="SELECT h_id from transitHolder where s_id='$id1' AND b_id='$bid' AND waypoint='$wp' LIMIT 1";
			$queryResult=$mysqli->query($query);
			$x=$queryResult->fetch_assoc();
			$hid=$x['h_id'];
			$query="SELECT time FROM `transitholder_timings` WHERE t_id='$hid' AND  SUBTIME(time,'$time')=(SELECT MIN(SUBTIME(time,'$time')) from transitholder_timings where t_id='$hid') LIMIT 1";
			$query2Result=$mysqli->query($query);
			$timex=$query2Result->fetch_assoc();
			$timetos=$timex['time'];
			$query="SELECT b_name from transitprovider where b_id='$bid'";
			$query2Result=$mysqli->query($query);
			$x=$query2Result->fetch_assoc();
			$direct2=$x['b_name'];
		}
		}
		var_dump($direct,$direct2,$timetos,$timetosd,$pathdm,$pathtm,$distm,$timem);
		$result="Catch provider number: ".$direct." at time: ".$timetos." with optimal time".$timem." else use provider number: ".$direct2." at time: ".$timetosd." with optimal distance: ".$distm;
		//return array($direct,$direct2,$timetos,$timetosd,$pathdm,$pathtm,$distm,$timem);
		return $result;
	}
	else
	{
	//special stop algo
	}
}
public function path($id1,$id2,$bid,$mysqli)
{
$dist=0;
$time=0;
$query="SELECT start,end from transitprovider_handler where b_id='$bid'";
$result=$mysqli->query($query);
$stops=$result->fetch_assoc();
$start=$stops['start'];
$end=$stops['end'];
$stops=$result->fetch_assoc();
$start2=$stops['start'];
$end2=$stops['end'];
$temp=$start;
$temp1=$id1;
$temp3=$id2;
$path=array();
$wp=0;
$tend=$end;
if($temp==$temp3 && $start2==$temp3) {array_push($path,$temp);
$wp=1;
$tend=$start;}
$flag=0;
if($temp==$temp1 && $start2==$temp1) {array_push($path,$temp);
$wp=0;
$tend=$end;}
var_dump($temp,$temp3,$tend,$bid);
while($temp!=$tend){
$tempx=end($path);
$query="SELECT n_id from transitlocation_neighbors WHERE s_id='$temp' and n_id IN(SELECT s_id from transitHolder WHERE b_id='$bid')";
$queryResult=$mysqli->query($query);
$result=$queryResult->fetch_array(MYSQLI_ASSOC);
$temp2=$result['n_id'];
if(in_array($temp2,$path))
{
$result=$queryResult->fetch_array(MYSQLI_ASSOC);
$temp2=$result['n_id'];
}
if($temp2==$temp1&&in_array($temp3,$path))
{
array_push($path,$temp2);
$temp=$tend;
}
if($temp2==$temp3&&in_array($temp1,$path))
{
array_push($path,$temp2);
$temp=$tend;
}
if($temp2==$temp1&&!in_array($temp3,$path))
{
array_push($path,$temp2);
$wp=0;
$tend=$temp3;
}
else if($temp2==$temp3 && !in_array($temp1,$path))
{
array_push($path,$temp2);
$wp=1;
$tend=$temp1;
}
else{if(count($path)>0&&!in_array($temp2,$path)){
array_push($path,$temp2);
$query="SELECT  `distance`, `time` FROM `transitlocation_neighbors` WHERE `s_id`='$tempx' and `n_id`='$temp2' LIMIT 1";
$mysqli_result=$mysqli->query($query);
$res=$mysqli_result->fetch_assoc();
$dist+=$res['distance'];
$time+=$res['time'];
}}


$temp=$temp2;
}
return array($path,$wp,$dist,$time);
}*/

public function compute($id1,$id2,$time,$mysqli)
	{ 
		$res = $mysqli->query("SELECT s_id from transitlocation where s_name = '".$id1."\r'");
		$res1=$res->fetch_assoc();
		$to=$res1['s_id'];
			//print_r($to);
		$res = $mysqli->query("SELECT s_id from transitlocation where s_name='".$id2."\r'");
		$res1=$res->fetch_assoc();
		$from=$res1['s_id'];
		//print_r($from);
		 $result = $mysqli->query("SELECT DISTINCT b_id FROM transitholder WHERE b_id IN(select b_id from transitholder where s_id=$to)and s_id=$from\r");
		$dirb=array();
			while ($row = $result->fetch_assoc()) {
			array_push($dirb,$row['b_id']);
			}
			
			if(count($dirb)>0)
			{
			$busno=array();
			$busno=$this->display($dirb,$mysqli);
			$arr1=array();
			$arr2=array();
			$arr3=array();
			list($arr1,$arr2,$arr3)=$this->calfun($dirb,$mysqli);
			//print_r($arr1);
			//print_r($arr2);
			//print_r($arr3);
			var_dump($busno);echo '</br>';var_dump($arr1);echo '</br>';var_dump($arr2);echo '</br>';var_dump($arr3);
			return(array($busno,$arr1,$arr2,$arr3));
			}
			if(count($dirb)==0)
			{
			$result=$mysqli->query("SELECT ss_id from transitlocation_specialnodes where ss_id IN (select ss_id from transitlocation_specialnodes where s_id=$to)
									and  s_id=$from");
			$temp=array();
				while ($row = $result->fetch_assoc()) 
				{
				array_push($temp,$row['ss_id']);
				}
				foreach($temp as $spl)
				{
				$result=$mysqli->query("SELECT b_id FROM transitholder WHERE b_id IN(select b_id from transitholder where s_id=$spl)and s_id=$from");
				$inb1=array();
				while ($row = $result->fetch_assoc())
				{
				array_push($inb1,$row['b_id']);
				}
				//echo $from."to".$spl;
				$busno=array();
				$busno=$this->display($inb1,$mysqli);
				$arr1=array();
				$arr2=array();
				$arr3=array();
				list($arr1,$arr2,$arr3)=$this->calfun($inb1,$mysqli);
				}
				$result=$mysqli->query("SELECT b_id FROM transitholder WHERE b_id IN(select b_id from transitholder where s_id=$spl)and s_id=$to");
				$inb2=array();
				while ($row = $result->fetch_assoc()) 
				{
					array_push($inb2,$row['b_id']);
				}
				//echo $spl."to".$to;
				$busno1=array();
				$busno1=$this->display($inb1,$mysqli);
				$arr4=array();
				$arr5=array();
				$arr6=array();
				list($arr4,$arr5,$arr6)=$this->calfun($inb2,$mysqli);
				var_dump($busno,'</br>',$arr1,'</br>',$arr2,'</br>',$arr3,'</br>',$busno1,'</br>',$arr4,'</br>',$arr5,'</br>',$arr6);
				return(array($busno,$arr1,$arr2,$arr3,$busno1,$arr4,$arr5,$arr6));
				}
			}
	public function display($busid,$mysqli)
		{
		foreach($busid as $t)
			{ $arr=array();
			$res= $mysqli->query("SELECT b_name from transitprovider where b_id=$t");
			while($row=$res->fetch_assoc())
			{
			array_push($arr,$row['b_name']);
			}
			return $arr;
			}
		
		} 

public function calfun($arr,$mysqli)
{
	$dist=array();
	$time=array();
	for( $p=0;$p<count($arr);$p++)
	{
	$a=array();
	$a = $this->buspath($arr[$p],$mysqli);
	$i=0;
	$j=1;
	$dis=0;
	$tim=0;
	while($i<count($a)-1){
		$res = $mysqli->query("SELECT `distance` FROM `transitlocation_neighbors` WHERE s_id= $a[$i] AND n_id= $a[$j]") ;
		$result = $mysqli->query("SELECT `time` FROM `transitlocation_neighbors` WHERE s_id= $a[$i] AND n_id= $a[$j]") ;
		$res1=$res->fetch_assoc();
		$result1=$result->fetch_assoc();
		$res2=$res1['distance'];	
		$result2=$result1['time'];
		$dis=$dis+$res2;
		$tim=$tim+$result2;
		$i++;
		$j++;
	}
	$dist[$p]=$dis;
	$time[$p]=$tim;
	//print_r($dist);
	//print_r($time);
	//echo $dis;
	//echo $tim;
	}
	reset($dist);
	reset($time);
	return(array($arr,$dist,$time));

}	

public function buspath($bid,$mysqli)
{
$temp=array();
	$result=$mysqli->query("SELECT DISTINCT s_id from transitholder WHERE b_id= $bid ");
	while ($row = $result->fetch_assoc()) {
		array_push($temp,$row['s_id']);
    }
$result = $mysqli->query("SELECT start from transitprovider_handler WHERE b_id= $bid");
$d=$result->fetch_assoc();
$a=$d['start'];
$p=count($temp);
for( $i=0; $i<$p; $i++)
{
if($temp[$i]==$a)
$temp[$i]=0;
}
	$main=array();
	for($i=0;$i<$p;$i++)
	{
	$main[$i]=0;
	}
	$l=0;
	$main[$l]=$a;
	do
	{	
			$neighbor=array();
			$result= $mysqli->query("SELECT DISTINCT n_id from transitlocation_neighbors WHERE s_id = $main[$l]");
			while ($row = $result->fetch_assoc()) {
			array_push($neighbor,$row['n_id']);
			}
			$j=0;
			while($j<count($neighbor))
			{	
				$c=0;
				for($k=0;$k<count($temp);$k++)
				{	
					if($temp[$k]==$neighbor[$j])
					{	$l++;
						$c++;
						$main[$l]=$neighbor[$j];
						$temp[$k]=0;
						break;
					}
				}
				if($c==1)
				break;
				else
				$j++;
			} 
	}while($l<count($temp)-1);
	//print_r($main);
	return($main);
	}
}
?>