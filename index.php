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
?>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Anemoi</title>
    <link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="css/jquery-ui-1.10.4.css">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.js"></script>
	<script src="js/foundation.js"></script>
		<style>
  .ui-autocomplete {
    max-height: 100px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
 
  html .ui-autocomplete {
    height: 100px;
  }
  </style>
 <?php
include('includes\\db.php'); 
 $mysqli_result=$mysqli->query("SELECT s_name from transitLocation");
$snames=array();
while($row=$mysqli_result->fetch_assoc())
{
array_push($snames,$row['s_name']);
}
$stoplist=implode(',',$snames);
  ?>
<script>
  $(function() {
    var availableTags =<?php echo json_encode($snames);?>; 
    $( "#from" ).autocomplete({
      source: availableTags
    });
	 $( "#to" ).autocomplete({
      source: availableTags
    });
  });
</script>
  </head>
  <body>  
	<div class="row">
    <div class="large-3 columns">
      <h1><img src="img/logo.png"/></h1>
    </div>
    <div class="large-9 columns">
      <ul class="inline-list right">
        <li><a href="#">Anemoi</a></li>
        <li><a href="#">Hyderabad</a></li>
        <li><a href="https://github.com/orgs/CubeLabs/teams/babyegg">BabyEGG</a></li>
        <li><a href="mail:admin@anemoi.com">Contact</a></li>
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
}?>
  <div class="row">    
    <div class="large-9 push-3 columns">
      <h3>Anemoi<small></small></h3> 
     <form id="luffy" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
     <div class="large-4 medium-4 columns ui-widget">
				      <label>From:</label>
				      <input id="from" type="text" placeholder="From" />
				    </div>
				    <div class="large-4 medium-4 columns ui-widget">
				      <label>To:</label>
				      <input id="to" type="text" placeholder="To" />
					  
				    </div>
					</br>
					<div class="large-4 medium-6 columns">
					<input id="time" type="time" />
					<input type="submit" class="small button" id="submit" name="submit"/>
    </form>
	
        </br>
	  </br></br></br></br>
	        </br>
	  </br></br></br></br></br></br></br></br>
	        </br>
	  </br></br></br></br></br></br></br></br>
	  <div id="goku" class="large-4 medium-4 columns ui-widget">
	</div>
    </div>
     </div>
    </div>
  <footer class="row">
    <div class="large-12 columns">
      <hr/>
      <div class="row">
        <div class="large-6 columns">
          <p>© Copyright @TeamBabyEGG 2014</p>
        </div>
        <div class="large-6 columns">
          <ul class="inline-list right">
            <li><a href="#">Anemoi</a></li>
            <li><a href="#">Hyderabad</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
      </div>
    </div> 
  </footer>
    <script>
      $(document).foundation();
    </script>
  </body>
  </html>