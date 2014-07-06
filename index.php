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
?>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hermes</title>
    <link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="css/jquery-ui-1.10.4.css">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.js"></script>
	<script src="js/foundation.js"></script>
	<script src="js/foundation.reveal.js"></script>

 <?php 
 include('includes\\db.php');
include('includes\\transitLocation.php');
include('includes\\transitProvider.php');
$snames=array();
$tL=new transitLocation();
$snames=$tL->returnStops($mysqli);
$bnames=array();
$tP=new transitProvider();
$bnames=$tP->returnBuses($mysqli);
 ?>
<script>
  $(function() {
    var availableStops =<?php echo json_encode($snames);?>; 
	var avaiableBuses=<?php echo json_encode($bnames);?>;
    $( "#from" ).autocomplete({
      source: availableStops
    });
	 $( "#to" ).autocomplete({
      source: availableStops
    });
	$( "#stops" ).autocomplete({
      source: availableStops
    });
	$("#bus").autocomplete({
	source: avaiableBuses
	});
	$(document).ready(function() {
   $('a.reveal-modal').trigger('click');

});
  });
</script>
  </head>
  <body>  
	<div class="row">
    <div class="large-3 columns">
      <h1><img src="img/logo.jpg"/></h1><h3><small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Making you love travelling</small></h3>
    </div>
    <div class="large-9 columns">
      <ul class="inline-list right">
        <li><a href="#">Hermes</a></li>
        <li><a href="#hyd">Hyderabad</a></li>
        <li><a href="https://github.com/begg">BabyEGG</a></li>
        <li><a href="mail:admin@hermes.com">Contact</a></li>
      </ul>
    </div>
  </div>
    <?php
  if(isset($_POST['submit']))
  {
  echo '<script>$(function() 
   {
  document.getElementById("luffy").style.display="none";
  document.getElementById("goku").style.display="block";
   });
   </script>';
         echo" <script>

$(document).ready(function() {
   $('a.close-reveal-modal').trigger('click');

});

    </script>";
   include("includes\\transitController.php");
   $from=$_POST["from"];
   $to=$_POST["to"];
   $time=$_POST["time"];
   $tC=new transitController();
   $result=$tC->compute($from,$to,$time,$mysqli);
   
}
 else if(isset($_POST['submitB']))
  {
  echo '<script>$(function() 
   {
  document.getElementById("natsu").style.display="none";
  document.getElementById("goku").style.display="block";
   });
   </script>';
         echo" <script>

$(document).ready(function() {
   $('a.close-reveal-modal').trigger('click');

});
$(document).ready(function() {
   $('#goku').foundation('reveal', 'open');

});

    </script>";
$name=$_POST["bus"];
$res=$tP->infoProvider($name,$mysqli); 
$result=" Transport Number: ".$name." is available at following stops ".implode(',',$res);
}
else if(isset($_POST['submitS']))
  {
  echo '<script>$(function() 
   {
  document.getElementById("vash").style.display="none";
  document.getElementById("goku").style.display="block";
   });
   </script>';
      echo" <script>
$(document).ready(function() {
   $('#goku').foundation('reveal', 'open');

});
$(document).ready(function() {
   $('a.close-reveal-modal').trigger('click');

});

    </script>";
$name=$_POST["stops"];
$res=$tL->infoLocation($name,$mysqli);
$result="Transport Numbers available at stop: ".$name." is ".$res; 
}
else{}
?>
  <div class="row">    
    <div class="large-9 push-3 columns">
      
<div class="tabs">
    <ul class="tab-links" data-tab>
  <li class="tab-title active"><a href="#route">Route Search</a></li>
  <li class="tab-title"><a href="#bus">Bus</a></li>
  <li class="tab-title"><a href="#stop">Stop</a></li>
</ul>
<div class="tab-content">
  <div class="tab active" id="route">
     <form id="luffy" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
     <div class="large-4 medium-4 columns ui-widget">
				      <label>From:</label>
				      <input id="from" type="text" name="from" placeholder="From" />
				    </div>
				    <div class="large-4 medium-4 columns ui-widget">
				      <label>To:</label>
				      <input id="to" type="text" name="to" placeholder="To" />
					  
				    </div>
					<div class="large-4 medium-4 columns ui-widget">
					<label>Time:</label>
					<input id="time" type="time" name="time"/></div>
					<div class="large-4 medium-4 columns ui-widget">
					<input type="submit" class="small button" id="submit" name="submit"/>  </div>
    </form>
  </div>
  <div class="tab" id="bus">
  <form id="natsu" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
     <div class="large-4 medium-4 columns ui-widget">
				      <input id="bus" name="bus" type="text" placeholder="Bus" /></div>
				    <input type="submit" class="small button" id="submitB" name="submitB"/>
    </form>
  </div>
  <div class="tab" id="stop">
      <form id="vash" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
     <div class="large-4 medium-4 columns ui-widget">
	   <input id="stops" name="stops" type="text" placeholder="Stop" />
				    <input type="submit" class="small button" id="submitS" name="submitS"/> </div>
    </form>
  </div>
</div>
</div>

	  </br></br></br></br>
	        </br>
	  </br></br></br></br></br>

	  
	  <div id="goku" class="reveal-modal" data-reveal>
  <h2>Search Results</h2>
  <p class="lead"><span><?php echo $result;?></span></p>
  
  <a class="close-reveal-modal">&#215;</a>
</div>
 <div id="hyd" class="reveal-modal" data-reveal>
  <h2>Hyderabad</h2>
  <p class="lead"><span>City made of love and peace..!!</span></p>
  
  <a class="close-reveal-modal">&#215;</a>
</div>
	
    </div>
     </div>
    </div>
  <footer class="row">
    <div class="large-12 columns">
      <hr/>
      <div class="row">
        <div class="large-6 columns">
          <p><a href="http://www.apache.org/licenses/LICENSE-2.0">Apache v2 GPL License</a> @TeamBabyEGG 2014</p>
        </div>
        <div class="large-6 columns">
          <ul class="inline-list right">
            <li><a href="#">Hermes</a></li>
            <li><a href="#">Hyderabad</a></li>
            <li><a href="https://github.com/begg">About us</a></li>
            <li><a href="mailto:admin@hermes.com">Contact</a></li>
          </ul>
        </div>
      </div>
    </div> 
  </footer>
	    <script>
		
		$(document).foundation();
$(document).ready(function() {
    $('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = $(this).attr('href');
 
        // Show/Hide Tabs
        $('.tabs ' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
        $(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
});
    </script>
  </body>
  </html>