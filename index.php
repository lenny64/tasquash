<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
	"http://www.w3.org/TR/html4/strict.dtd">

<html>

<head>

	<title>Test Boubacar</title>

	<!-- STYLES -->
	<link rel="stylesheet" href="./bootstrap-3.3.5/css/bootstrap.min.css"/>

	<!-- AUTRES -->
	<script type="text/javascript" src="./include/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="./include/jquery-ui-1.10.4.custom.min.js"></script>
	<script type="text/javascript" src="./include/jquery.validate.min.js"></script>
	<script src="./bootstrap-3.3.5/js/bootstrap.min.js"></script>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<script type="text/javascript" language="javascript" src="./include/enlecs.js"></script>

</head>
<body>

	<nav class="navbar navbar-inverse navbar-static-top">
		<div class="container" id="navfluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Home</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="./index.php">Test</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

	<div class="container">
		<div class="jumbotron">
			<form class="form" action="#">
				<div class="form-group">
					<label for="user_input">Enter your phrase</label>
					<input type="text" class="form-control" id="user_query"/>
				</div>
				<div class="form-group">
					<input type="submit" id="submit_query" class="btn btn-primary" value="Go!"/>
				</div>
			</form>
		</div>
		Raw result:
		<br/>
		<div id="raw_result"></div>
		<div id="first_cat"></div>
	</div>


</body>
</html>
<?php

?>
