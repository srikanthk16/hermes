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

if(!isset($_POST['submit']))
{
echo '<script type="text/javascript" language="JavaScript">
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
$uploaddir = '../uploads/';
$uploadfile = $uploaddir . basename($_FILES['file']['name']);
if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
	echo "</br>";
} else {
    echo "Possible file upload attack!\n";
}
$parseFile= file_get_contents($uploadfile);
$rows=explode('\n',$parseFile);
if($_POST['cBox']==1)
{
include('transitProvider.php');
include('transitLocation.php');
$tp=new transitProvider();
foreach($rows as $r=> $d)
{
$data=explode(' ',$d);
$name=$data[0];
$num=$data[1];
$time=array_slice($data,2,2+$num);
$tp->insertProvider($name,$time);
}
}
else if($_POST['cBox']==2)
{
include('transitProvider.php');
include('transitLocation.php');
$tl=new transitLocation();
foreach($rows as $r=> $d)
{
$data=explode(' ',$d);
$name=$data[0];
$tl->insertLocation($name);
}
}
else if($_POST['cBox']==3)
{
include('transitProvider.php');
include('transitLocation.php');
$tl=new transitLocation();
foreach($rows as $r=> $d)
{
$data=explode(' ',$d);
$name=$data[0];
$num=$data[1];
$sNodes=array_slice($data,2,2+$num);
$tl->insertSpecialnodes($name,$sNodes);
}
}
else if($_POST['cBox']==4)
{
include('transitProvider.php');
include('transitLocation.php');
$tl=new transitLocation();
foreach($rows as $r=> $d)
{
$data=explode(' ',$d);
$name=$data[0];
$num=$data[1];
$i=0;
$k=3;
$nValue=array();
while($i<$num)
{
$nNode=$data[$k];
$k=$k+1;
$nValue[0]=$data[$k];
$k=$k+1;
$nValue[1]=$data[$k];
$k=$k+1;
$tl->insertNeighbornodes($name,$nNode,$nValue);
}
}
}
else if($_POST['cBox']==5)
{
include('transitController.php');
$tc=new transitController();
foreach($rows as $r=> $d)
{
$data=explode(' ',$d);
$sname=$data[0];
$bname=$data[1];
$tc->insertHolder($sname,$bname);
}
}
else
{
echo 'invalid request , possible hacking reported to admin';
}
}

?>