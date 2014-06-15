<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Anemoi</title>
    <link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="css/jquery-ui-1.10.4.css">
	<script src="js/vendor/jquery.js"></script>
	<script src="js/jquery-ui-1.10.4.js"></script>
	<script src="js/foundation/foundation.js"></script>
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
	<script>
  $(function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
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
  <div class="row">    
    <div class="large-9 push-3 columns">
      <h3>Anemoi<small></small></h3> 
     <form action="goto.php" method="POST">
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
					<input type="submit" class="small button" name="Submit"/>
    </form>
        </br>
	  </br></br></br></br>
	        </br>
	  </br></br></br></br></br></br></br></br>
	        </br>
	  </br></br></br></br></br></br></br></br>
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