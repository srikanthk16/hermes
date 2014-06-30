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
include('includes/db.php');
	$query="SELECT password from adminsettings where username='admin'";
	$mysqli_result=$mysqli->query($query);
	$result=$mysqli_result->fetch_assoc();
	$pswd=$result['password'];

if(!isset($_POST['submit']))
{
echo '<script type="text/javascript">
var password = "'.$pswd.'";
var string = prompt("Please enter the password", "");
if(string!=password) {
alert("Wrong password!");
window.location="index.php";
}
</script><script type="text/javascript" language="JavaScript">
<!--
function checkCheckBoxes(theForm) {
	var checkboxs=theForm.cBox;
    var chkd=false;
    for(var i=0,l=checkboxs.length;i<l;i++)
    {
        if(checkboxs[i].checked)
        {
            chkd=true;
        }
    }
    if(chkd){return true;}
    else {alert("Please check a checkbox");return false;}
}

</script> <form id= "theForm" action="'.$_SERVER['PHP_SELF'].'" method="post"
enctype="multipart/form-data" onsubmit="return checkCheckBoxes(this);">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
 <input type ="checkbox" name="cBox" value = "1">Providers</input>
    <input type ="checkbox" name="cBox" value = "2">Locations</input>
    <input type ="checkbox" name="cBox" value = "3">Special Nodes</input>
	 <input type ="checkbox" name="cBox" value = "4">Neighbor Nodes</input>
	  <input type ="checkbox" name="cBox" value = "5">Holders</input>
<input type="submit" name="submit" value="Submit">
</form>';
}
else{
$uploaddir = 'uploads/';
$uploadfile = $uploaddir . basename($_FILES['file']['name']);
if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
	echo "</br>";
} else {
    echo "Possible file upload attack!\n";
}
$parseFile= file_get_contents($uploadfile);
$rows=explode("\n",$parseFile);
if($_POST['cBox']==1)
{
include('includes/transitProvider.php');
$tp=new transitProvider();
foreach($rows as $r=> $d)
{
$data=explode(' ',$d);
$name=$data[0];
$start=$data[1];
$end=$data[2];
$num=$data[3];
$time=array_slice($data,4,4+$num);
$tp->insertProvider($name,$startstop,$endstop,$time,$mysqli);
}
}
else if($_POST['cBox']==2)
{
include('includes/transitLocation.php');
$tl=new transitLocation();
include('includes/db.php');
var_dump($mysqli);
foreach($rows as $r=> $d)
{
$data=explode(' ',$d);
$name=$data[0];
$tl->insertLocation($name,$mysqli);
}
}
else if($_POST['cBox']==3)
{
include('includes/transitLocation.php');
$tl=new transitLocation();
foreach($rows as $r=> $d)
{
$data=explode(' ',$d);
$name=$data[0];
$num=$data[1];
$sNodes=array_slice($data,2,2+$num);
$tl->insertSpecialnodes($name,$sNodes,$mysqli);
}
}
else if($_POST['cBox']==4)
{
include('includes/transitLocation.php');
$tl=new transitLocation();
foreach($rows as $r=> $d)
{
$data=explode(' ',$d);
$name=$data[0];
$num=$data[1];
$i=0;
$k=2;
while($i<$num)
{
$nValue=array();
$nNode=$data[$k];
$k=$k+1;
array_push($nValue,$data[$k]);
$k=$k+1;
array_push($nValue,$data[$k]);
$k=$k+1;
$tl->insertNeighbornodes($name,$nNode,$nValue,$mysqli);
$i=$i+1;
}
}
}
else if($_POST['cBox']==5)
{
include('includes/transitController.php');
$tc=new transitController();
foreach($rows as $r=> $d)
{
$data=explode(' ',$d);
$sname=$data[0];
$bname=$data[1];
$num=$data[2];
$times=array_slice($data,3,3+$num);
$tc->insertHolder($sname,$bname,$times,$mysqli);
}
}
else
{
echo 'invalid request / Security breach, reported to admin';
}

}

?>